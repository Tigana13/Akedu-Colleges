<?php

namespace App\Http\Controllers\Courses;

use App\Models\Course\Course;
use App\Models\Course\Profile\CourseProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        ]);

        if ($validator->fails()){
            return back()->withInput()->withErrors($validator)->with('error', 'Input Validation failed');
        }

        $course = new Course();
        $course->course_name = $request->course_name;
        $course->active = 0;
        $course->certified = 0;
        $course->save();

        $course_profile = new CourseProfile();
        $course->course_description = $request->course_description;
        $course->course_credits = $request->course_credits;
        $course->course_qualifications = $request->course_qualifications;
        $course->course_duration = $request->course_duration;

        $course->profile()->save($course_profile);

        return back()->with('success', 'Course was successfully added. Please await approval by Administrator');

    }


}
