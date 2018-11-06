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
                    <h4 class="page-title">Facilities</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="{{route('home')}}">Dashboard</a></li>
                    </ol>
                </div>
            </div>

            @include('common.session_messages')

            <div class="row mb-lg-4">
                <div class="col">
                    <button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#CreateFacilityModal">
                        <i class="fa fa-plus"></i> Add a Facility
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
                        <h3 class="box-title">Facilites Listing</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>FACILITY NAME</th>
                                    <th>DESCRIPTION</th>
                                    <th>CREDITS</th>
                                    <th>VIEWS</th>
                                    <th>ACTIVE</th>
                                    <th>CERTIFIED</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(auth()->user()->facilities as $facility)
                                    <tr>
                                        <td>{{$facility->facility_name}}</td>
                                        <td>{{$facility->facility_description}}</td>
                                        <td>{{$facility->credits}}</td>
                                        <td>{{($facility->views != null) ? $facility->views->count() : ''}}</td>
                                        <td>
                                            @if($facility->active)
                                                <span class="label label-success">Active</span>
                                            @else
                                                <span class="label label-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($facility->certified)
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
    <div class="modal fade bd-example-modal-lg" id="CreateFacilityModal" tabindex="-1" role="dialog" aria-labelledby="CreateFacilityModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create a Facility</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('facilities.create.post')}}" method="post" id="facilityCreateModalForm">
                        @csrf
                        <div class="form-group">
                            <label for="inputFacilityName">Facility Name</label>
                            <input type="text" class="form-control" required id="inputFacilityName" aria-describedby="facilityName" placeholder="Facility Name" name="facility_name">
                            {{--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                        </div>
                        <div class="form-group">
                            <label for="inputFaciilityDhomeesc">Facility Description</label>
                            <textarea rows="3" class="form-control" required id="inputFaciilityDesc" aria-describedby="facilityDesc" placeholder="Facility Description" name="facility_description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputFacilityBranches">Location</label>
                            <select id="inputFacilityBranches" required class="form-control" name="branches">
                                @foreach(auth()->user()->locations as $branch)
                                    <option value="{{$branch->id}}">{{$branch->city}} Campus</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('facilityCreateModalForm').submit();">Save changes</button>
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
