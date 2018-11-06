<?php

namespace App\Http\Controllers\Courses;

use App\Models\College\College;
use App\Models\Course\Course;
use App\Models\Course\Courseable;
use App\Models\Course\Profile\CourseProfile;
use App\Models\Intakes\Intakes;
use App\Models\Locations\Locatable;
use App\Models\Locations\Locations;
use App\Traits\BuildCharts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    use BuildCharts;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('courses.courses');
    }

    /**
     * Add a course to storage
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_name' => 'required|string|max:200',
            'course_description' => 'required|string|max:255',
            'course_credits' => 'required|integer',
            'course_qualifications' => 'required|string|max:255',
            'course_duration' => 'required|integer',
            'branches.*' => 'nullable|integer',
            'intakes.*' => 'required|integer'
        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->with('error', 'Input Validation failed: '.$validator->errors());
        }

        foreach ($request->intakes as $intake_id){
            $intake = Intakes::where('college_id', Auth::id())->findOrFail($intake_id);
        }

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->course_intake = $intake->id;
        $course->active = 0;
        $course->certified = 0;
        auth()->user()->courses()->save($course);


        foreach ($request->branches as $branch){
            $location = Locations::findOrFail($branch);

            //Create course locatables for the location
            Locatable::create([
                'locations_id' => $location->id,
                'locatable_type' => Course::class,
                'locatable_id' => $course->id
            ]);

        }

        $course_profile = new CourseProfile();
        $course_profile->course_description = $request->course_description;
        $course_profile->course_credits = $request->course_credits;
        $course_profile->course_qualifications = $request->course_qualifications;
        $course_profile->course_duration = $request->course_duration;

        $course->profile()->save($course_profile);

        return back()->with('success', 'Course was successfully added. Please await approval by Administrator');

    }

    /**
     * Show the profile of a particular course
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function courseProfile($id)
    {
        //Check if college has a coursable instance of the course
        $coursable_count = Courseable::where('courseables_type', College::class)->where('courseables_id', Auth::id())->where('course_id', $id)->count();

        if ($coursable_count < 1){
            return redirect(route('courses.index'))->with('error', 'That course could not be found or does not belong to you!');
        }

        $course = Course::findOrFail($id);
        $course_comments = $course->comments()->paginate(10);

        $exit_surveys = $course->exitSurveys;

        $labels1 = [
            'Professional Ethics',
            'Communication Skills',
            'Practical Application of theory',
            'Exposure to current Trends',
            'Written Communication',
            'Critical Thinking',
            'Team member functionality',
            'Learner Independence',
        ];

        $labels2 = [
            'Further studies and career mentoring',
            'Strong leadership skills',
            'General student acceptance',
            'Support from faculty',
            'Social Activities',
            'Preparation for employment'
        ];

        if ($exit_surveys->count() > 0){
            $metrics_analytics1 = $this->buildChart('line', 'Sentiment analysis based on '.$exit_surveys->count().' alumni.', '% positivity/negativity', $labels1, [
                round(($exit_surveys->sum('professional_ethics_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('communication_skills_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('theory_prac_application_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('current_field_trends_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('written_communication_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('critical_thinking_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('team_member_functionality_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('independent_learner_rating_score') / $exit_surveys->count()) * 100, 4),
            ], 'orange-material');

            $metrics_analytics2 = $this->buildChart('line', 'Sentiment analysis based on '.$exit_surveys->count().' alumni.', '% positivity/negativity', $labels2, [
                round(($exit_surveys->sum('further_education_career_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('strong_leadership_skills_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('acceptance_at_institution_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('faculty_support_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('return_for_social_activities_rating_score') / $exit_surveys->count()) * 100, 4),
                round(($exit_surveys->sum('employment_preparation_rating_score') / $exit_surveys->count()) * 100, 4),
            ],'green-material');

        }

        return view('courses.course_profile', compact('course', 'metrics_analytics1', 'metrics_analytics2', 'course_comments'));
    }

}
