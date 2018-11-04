<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course\Course;
use App\Models\Course\Profile\CourseProfile;
use App\Models\Intakes\Intakes;
use App\Models\Locations\Locatable;
use App\Models\Locations\Locations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('courses.courses');
    }

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


}
