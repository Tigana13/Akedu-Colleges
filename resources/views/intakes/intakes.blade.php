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
                    <h4 class="page-title">Intakes</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            @include('common.session_messages')

            <div class="row mb-lg-4">
                <div class="col">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#CreateIntakeModal">
                        <i class="fa fa-plus"></i> Add an intake
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
                        <h3 class="box-title">Intakes Listing</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Intake Alias</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->intakes as $intake)
                                    <tr>
                                        <td>{{$intake->intake_alias}}</td>
                                        <td>{{$intake->intake_description}}</td>
                                        <td>{{$intake->intake_start}}</td>
                                        <td>{{$intake->intake_finish}}</td>
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
    <div class="modal fade bd-example-modal-lg" id="CreateIntakeModal" tabindex="-1" role="dialog" aria-labelledby="CreateIntakeModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create a Intake</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('intakes.create.post')}}" method="post" id="intakeCreateModalForm">
                        @csrf
                        <div class="form-group">
                            <label for="inputIntakeAlias">Intake Alias</label>
                            <input type="text" class="form-control" required id="inputIntakeAlias" aria-describedby="intakeAlias" placeholder="Intake Alias" name="intake_alias">
                            {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                        </div>
                        <div class="form-group">
                            <label for="inputIntakeDesc">Intake Description</label>
                            <textarea rows="3" class="form-control" required id="inputIntakeDesc" aria-describedby="IntakeDesc" placeholder="Intake Description" name="intake_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputIntakeStart">Intake Start</label>
                            <input type="date" class="form-control" required id="inputIntakeStart" aria-describedby="intakeStart" placeholder="Intake Start" name="intake_start">
                            <small id="intakeStartHelp" class="form-text text-muted">Please input the number of the month in which the intake starts.</small>
                        </div>
                        <div class="form-group">
                            <label for="inputIntakeFinish">Intake Finish</label>
                            <input type="date" class="form-control" required id="inputIntakeFinish" aria-describedby="intakeFinish" placeholder="Intake Finish" name="intake_finish">
                            <small id="intakeStartHelp" class="form-text text-muted">Please input the number of the month in which the intake ends.</small>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('intakeCreateModalForm').submit();">Save changes</button>
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
