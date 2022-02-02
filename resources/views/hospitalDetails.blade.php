@extends('layout.app')
@section('content')

    <div>
        <a href="{{route('index')}}"> Do your work, then step back. </a>
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Hospital Details</h3>
                </div>

                <div class="title_right">

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Hospital Report & All Activity</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view"
                                             src="{{asset('upload_file/'.$hospital->logo)}}" alt="Hospital Logo"
                                             title="Change the avatar" style="height: 220px; width: 220px">
                                    </div>
                                </div>
                                <h3>{{$hospital->name}}</h3>
                                <hr>

                                <ul class="list-unstyled user_data" style="font-size: 19px">
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$hospital->address}}
                                    </li>

                                    <li>
                                        <i class="fa fa-briefcase user-profile-icon"></i> {{$hospital->details}}
                                    </li>

                                    <li>
                                        <a href="mailto:{{$hospital->email}}">
                                            <i class="fa fa-envelope user-profile-icon"></i> {{$hospital->email}}
                                        </a>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone-square user-profile-icon"></i> {{$hospital->mobile_no}}
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <div class="profile_title">
                                    <div class="col-md-9">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#edit_hospital_details"
                                                                                      id="home-tab"
                                                                                      role="tab" data-toggle="tab"
                                                                                      aria-expanded="true">Edit</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#total_patient_count" role="tab"
                                                                                id="profile-tab" data-toggle="tab"
                                                                                aria-expanded="false">Total Patient
                                                    Count</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#doctor_patient_count" role="tab"
                                                                                id="profile-tab" data-toggle="tab"
                                                                                aria-expanded="false">Doctor & Patient
                                                    Count</a>
                                            </li>
                                            {{--                                            <li role="presentation" class=""><a href="#edit" role="tab"--}}
                                            {{--                                                                                id="profile-tab2"--}}
                                            {{--                                                                                data-toggle="tab"--}}
                                            {{--                                                                                aria-expanded="false">Recent--}}
                                            {{--                                                    Activity</a>--}}
                                            {{--                                            </li>--}}
                                        </ul>
                                    </div>
                                    <div class="col-md-3">
                                        <div id="reportrange" class="pull-right"
                                             style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                            <span>March 31 2022 - 1 April 2023</span> <b class="caret"></b>
                                        </div>
                                    </div>
                                </div>
                                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                    <div id="myTabContent" class="tab-content">
                                        <!-- start hospital details update -->
                                        <div role="tabpanel" class="tab-pane active " id="edit_hospital_details"
                                             aria-labelledby="home-tab">

                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Hospital Details Update</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br/>
                                                    <form action="{{route('hospitalDetailsUpdate')}}"
                                                          class="form-horizontal form-label-left" method="post"
                                                          enctype="multipart/form-data" id="hospitalDetailsUpdate">
                                                        @method('put')
                                                        @csrf


                                                        @if ($errors->any())
                                                            @foreach ($errors->all() as $message)
                                                                <div class="alert alert-danger alert-dismissible "
                                                                     role="alert">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                    <strong>{{ $message }}</strong>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if (session()->has('message'))
                                                            <div class="alert alert-success alert-dismissible "
                                                                 role="alert">
                                                                <button type="button" class="close"
                                                                        data-dismiss="alert" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                                <strong>{{ session('message') }}</strong>
                                                            </div>
                                                        @endif
                                                        <input type="hidden" class="form-control" name="id"
                                                               value="{{$hospital->id}}">
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Name</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="name"
                                                                       value="{{$hospital->name}}"
                                                                       placeholder="Hospital Name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Details
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="details"
                                                                      placeholder="{{$hospital->details}}">{{$hospital->details}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Register
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="register_no"
                                                                       value="{{$hospital->register_no}}"
                                                                       placeholder="Register No" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Email</label>
                                                            <div class="col-md-7 col-sm-3 ">
                                                                <input type="email" class="form-control"
                                                                       value="{{$hospital->email}}"
                                                                       placeholder="Email"
                                                                       readonly="readonly"
                                                                       name="email"
                                                                >
                                                            </div>

                                                            <a class="border-button" href="javascript:;"
                                                               onclick="getEmailPopup('{{ route('email.popup.get', $hospital->id) }}', '{{ route('check.email') }}', {{ $hospital->id }}, '{{ Session::get('userType') }}')">
                                                                <button type="button" class="btn btn-secondary">
                                                                    Change Email
                                                                </button>
                                                            </a>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Mobile
                                                                No</label>
                                                            <div class="col-md-6 col-sm-3 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$hospital->mobile_no}}"
                                                                       placeholder="Mobile No" readonly="readonly"
                                                                       name="mobile_no"
                                                                >
                                                            </div>

                                                            <a class="border-button" href="javascript:;"
                                                               onclick="getMobilePopup('{{ route('mobile.popup.get', $hospital->id) }}', '{{ route('check.mobile') }}', {{ $hospital->id }}, '{{ Session::get('userType') }}')">
                                                                <button type="button" class="btn btn-secondary">
                                                                    Change Mobile No
                                                                </button>
                                                            </a>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Fex
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$hospital->fex_no}}"
                                                                       placeholder="Fex No" name="fex_no">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Pin Cord
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$hospital->pin_code}}"
                                                                       placeholder="Pin Cord No"
                                                                       name="pin_code">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Address
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="address"
                                                                      placeholder="Address">{{$hospital->address}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Password</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <a href="javascript:;" class="border-button"
                                                                   data-toggle="modal"
                                                                   data-target="#change_password"
                                                                   onclick="changePasswordClick('{{ route('check.password') }}')">
                                                                    <button type="button"
                                                                            class="btn btn-sm btn-secondary">
                                                                        Change Password
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 ">Hospital
                                                                Logo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="file" value="" name="logo"
                                                                       accept="image/*"
                                                                       oninput="logo.src=window.URL.createObjectURL(this.files[0])"/>
                                                                <img id="logo" width="130px"/>
                                                            </div>
                                                        </div>

                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                                <a href="{{route('index')}}">
                                                                    <button type="button" class="btn btn-primary">Cancel
                                                                    </button>
                                                                </a>
                                                                <button type="reset" class="btn btn-primary">Reset
                                                                </button>
                                                                <button class="btn btn-success">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Change password pop-up -->
                                            <x-change-password id="{{$hospital->id}}" user-type="hospital"/>
                                            <!-- Change password pop-up -->
                                            <!-- Change emails pop-up -->
                                            <div id="updateEmailPopup"></div>
                                            <!-- /Change emails pop-up -->
                                            <!-- Change mobile pop-up -->
                                            <div id="update_mobile_popup"></div>
                                            <!-- /Change mobile pop-up -->
                                        </div>
                                        <!-- end hospital details update -->
                                        <!-- start patient count -->
                                        <div role="tabpanel" class="tab-pane fade" id="total_patient_count"
                                             aria-labelledby="profile-tab">
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Mouth & Year</th>
                                                    <th>New Patient</th>
                                                    <th>Old Patient</th>
                                                    <th>Totle Patient</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end patient count -->
                                        <!-- start doctor and patient count -->
                                        <div role="tabpanel" class="tab-pane fade" id="doctor_patient_count"
                                             aria-labelledby="profile-tab">
                                            <table class="data table table-striped no-margin">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Doctor Name</th>
                                                    <th>Mouth & Year</th>
                                                    <th>New Patient</th>
                                                    <th>Old Patient</th>
                                                    <th>Totle Patient</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end doctor and  patient count -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
