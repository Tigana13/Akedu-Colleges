@extends('layouts.akedu_college')

@include('common.sidebar')

@section('content')
    <!-- ============================================================== -->
    <!-- Page Content -->
    <!-- ============================================================== -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">{{$course->course_name}}</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="{{route('home')}}">Dashboard</a></li>
                            <li><a href="{{route('courses.index')}}">Courses</a></li>
                            <li><a href="#">{{$course->course_name}}</a></li>
                        </ol>
                    </div>
                </div>

            @include('common.session_messages')

            <!-- /.row -->
            <!-- .row -->
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="white-box">
                        <div class="user-bg">
                            <div class="overlay-box">
                                <div class="user-content">
                                    <br><br>
                                    <h4 class="text-white">{{$course->course_name}}</h4>
                                    <h5 class="text-white">{{$course->profile->course_description}}</h5> </div>
                            </div>
                        </div>
                        <div class="user-btm-box">
                            <div class="col-md-4 col-sm-4 text-center">
                                <p class="text-blue"><i class="fas fa-graduation-cap"></i> Alumni</p>
                                <h1>{{$course->exitSurveys->count()}}</h1> </div>
                            <div class="col-md-4 col-sm-4 text-center">
                                <p class="text-danger"><i class="fas fa-eye"></i> Views</p>
                                <h1>{{$course->views->count()}}</h1> </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="white-box">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="course_analytics-tab" data-toggle="tab" href="#course_analytics" role="tab" aria-controls="course_analytics" aria-selected="true">Analytics</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="course_comments-tab" data-toggle="tab" href="#course_comments" role="tab" aria-controls="course_comments" aria-selected="false">Comments</a>
                            </li>
                            {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>--}}
                            {{--</li>--}}
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane show active" id="course_analytics" role="tabpanel" aria-labelledby="course_analytics-tab">
                                <div class="row">
                                    @if(isset($metrics_analytics1))
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <div class="card-body">
                                                    <div class="chart-container">
                                                        {!! $metrics_analytics1->html() !!}
                                                    </div>
                                                    <chart :chart="{{json_encode($metrics_analytics1)}}"></chart>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if(isset($metrics_analytics1))
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-header"></div>
                                                <div class="card-body">
                                                    <div class="chart-container">
                                                        {!! $metrics_analytics2->html() !!}
                                                    </div>
                                                    <chart :chart="{{json_encode($metrics_analytics2)}}"></chart>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="course_comments" role="tabpanel" aria-labelledby="course_comments-tab">
                                @foreach($course_comments as $comment)
                                    <p>{{$comment->body}}</p>
                                    <span class="label label-info pull-right mb-5">{{$comment->created_at->diffForHumans()}}</span>
                                    <br>
                                    <hr>
                                @endforeach
                                {{$course_comments->links()}}
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            c<footer class="footer text-center"> </footer>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>
