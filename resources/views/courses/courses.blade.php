@extends('layouts.akedu_college')

@include('common.sidebar')

@section('content')
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Courses</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            @include('common.session_messages')

            <div class="row mb-lg-4">
                <div class="col">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#CreateCourseModal">
                        <i class="fa fa-plus"></i> Create Course
                    </button>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- table -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12">
                    <div class="white-box">
                        <div class="col-md-3 col-sm-4 col-xs-6 pull-right">
                            <select class="form-control pull-right row b-none">
                                <option>March 2017</option>
                                <option>April 2017</option>
                                <option>May 2017</option>
                                <option>June 2017</option>
                                <option>July 2017</option>
                            </select>
                        </div>
                        <h3 class="box-title">Courses Listing</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>CREDITS</th>
                                    <th>DURATION</th>
                                    <th>VIEWS</th>
                                    <th>ACTIVE</th>
                                    <th>CERTIFIED</th>
                                    <th>APPROVAL RATING</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->courses as $course)
                                    <tr>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{($course->profile != null) ? $course->profile->course_description : ''}}</td>
                                        <td>{{($course->profile != null) ? $course->profile->credits : ''}}</td>
                                        <td>{{($course->profile != null) ? $course->profile->course_duration : ''}}</td>
                                        <td>{{$course->views->count()}}</td>
                                        <td>
                                            @if($course->active)
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($course->certified)
                                                <span class="label label-success">Certified</span>
                                            @else
                                                <span class="label label-danger">Not certified</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="CreateCourseModal" tabindex="-1" role="dialog" aria-labelledby="CreateCourseModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create a course</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('courses.create.post')}}" method="post" id="courseCreateModalForm">
                        @csrf
                        <div class="form-group">
                            <label for="inputCourseName">Course Name</label>
                            <input type="text" class="form-control" required id="inputCourseName" aria-describedby="courseName" placeholder="Course Name" name="course_name">
                            {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                        </div>
                        <div class="form-group">
                            <label for="inputCourseDesc">Course Description</label>
                            <textarea rows="3" class="form-control" required id="inputCourseDesc" aria-describedby="courseDesc" placeholder="Course Name" name="course_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputCourseCredits">Credits</label>
                            <input type="number" class="form-control" required id="inputCourseCredits" aria-describedby="courseCredits" placeholder="Course Credits" name="course_credits">
                        </div>
                        <div class="form-group">
                            <label for="inputCourseQualifications">Qualifications</label>
                            <textarea rows="3" class="form-control" required id="inputCourseQualifications" aria-describedby="courseQualifications" placeholder="Course Qualifications" name="course_qualifications"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputCourseDuration">Duration (years)</label>
                            <input type="number" class="form-control" required id="inputCourseDuration" aria-describedby="courseDuration" placeholder="Course Duration" name="course_duration">
                        </div>

                        <div class="form-group">
                            <label for="inputCourseBranches">Offering Branches</label>
                            <select id="inputCourseBranches" required class="form-control" name="branches[]" multiple="multiple">
                                @foreach(auth()->user()->locations as $branch)
                                    <option value="{{$branch->id}}">{{$branch->city}} Campus</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="inputCourseIntakes">Intakes</label>
                            <select required name="intakes[]" size="3" id="inputCourseIntakes" class="form-control selectpicker" multiple data-live-search="true">
                                @foreach(auth()->user()->intakes as $intake)
                                    <option value="{{$intake->id}}">{{$intake->intake_alias}}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('courseCreateModalForm').submit();">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
