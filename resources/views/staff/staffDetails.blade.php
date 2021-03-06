@extends('layout.app')
@section('content')
    <div>
        <a href="{{ route('staff.index') }}"> Do your work, then step
            back. </a>
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Update Details</h3>
                </div>

                <div class="title_right">
                </div>

            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Staff Update Details</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-md-3 col-sm-3  profile_left">
                                <div class="profile_img">
                                    <div id="crop-avatar">
                                        <!-- Current avatar -->
                                        <img class="img-responsive avatar-view"
                                             src="{{$staff->avatar ? asset('upload_file/'.$staff->avatar) : asset('upload_file/default.png')}}"
                                             alt="{{$staff->name}}"
                                             title="Change the avatar" style="height: 220px; width: 220px">
                                    </div>
                                </div>
                                <h3>{{$staff->name}}</h3>
                                <hr>

                                <ul class="list-unstyled user_data" style="font-size: 19px">
                                    <li>
                                        <a href="mailto:{{$staff->email}}">
                                            <i class="fa fa-envelope user-profile-icon"></i> {{$staff->email}}
                                        </a>
                                    </li>

                                    <li>
                                        <i class="fa fa-phone-square user-profile-icon"></i> {{$staff->mobile_no}}
                                    </li>
                                    <li><i class="fa fa-map-marker user-profile-icon"></i> {{$staff->address}}
                                    </li>


                                </ul>


                            </div>
                            <div class="col-md-9 col-sm-9 ">

                                <div class="profile_title">
                                    <div class="col-md-9">
                                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                            <li role="presentation" class="active"><a href="#edit_staff_details"
                                                                                      id="home-tab"
                                                                                      role="tab" data-toggle="tab"
                                                                                      aria-expanded="true">Edit
                                                    staff</a>
                                            </li>
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
                                        <!-- start staff details update -->
                                        <div role="tabpanel" class="tab-pane active " id="edit_staff_details"
                                             aria-labelledby="home-tab">

                                            <div class="x_panel">
                                                <div class="x_title">
                                                    <h2>Staff Details Update</h2>

                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content">
                                                    <br/>
                                                    <form action="{{route('staff.staffDetailsUpdate')}}"
                                                          class="form-horizontal form-label-left" method="post"
                                                          enctype="multipart/form-data" id="staffDetailsUpdate">
                                                        @method('put')
                                                        @csrf

                                                        @if ($errors->any())
                                                            @foreach ($errors->all() as $message)
                                                                <div class="alert alert-danger alert-dismissible "
                                                                     role="alert">
                                                                    <button type="button" class="close"
                                                                            data-dismiss="alert" aria-label="Close">
                                                                        <span aria-hidden="true">??</span>
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
                                                                    <span aria-hidden="true">??</span>
                                                                </button>
                                                                <strong>{{ session('message') }}</strong>
                                                            </div>
                                                        @endif
                                                        <input type="hidden" class="form-control" name="id"
                                                               value="{{$staff->id}}">
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Staff
                                                                Id</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="staff_id"
                                                                       value="{{$staff->staff->staff_id}}"
                                                                       placeholder="Staff Id" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Role</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <select id="role" name="role"
                                                                        class="form-control" {{Session::get('userType') === "staff" ? "disabled" : ""}}>
                                                                    <option value="" disabled selected>Choose..</option>
                                                                    @foreach(App\Models\Hospital::ROLE as $key => $value)
                                                                        <option
                                                                            value="{{ $key }}" {{($key == $staff->staff->role) ? "selected" : ""}}> {{$value}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row ">
                                                            <label class="control-label col-md-3 col-sm-3 ">Name</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       name="name"
                                                                       value="{{$staff->name}}"
                                                                       placeholder="Name" {{Session::get('userType') === "staff" ? "readonly" : ""}}>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Email</label>
                                                            <div
                                                                class="{{Session::get('userType') === "staff" ? "col-md-7 col-sm-3" : "col-md-9 col-sm-9"}}">
                                                                <input type="email" class="form-control"
                                                                       value="{{$staff->email}}"
                                                                       placeholder="Email"
                                                                       name="email" {{Session::get('userType') === "staff" ? "readonly" : ""}}>
                                                            </div>
                                                            @if(Session::get('userType') === "staff" )
                                                                <a class="border-button" href="javascript:;"
                                                                   onclick="getEmailPopup('{{ route('email.popup.get', $staff->id) }}', '{{ route('check.email') }}', {{ $staff->id }}, '{{ Session::get('userType') }}')">
                                                                    <button type="button" class="btn btn-secondary">
                                                                        Change Email
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Mobile
                                                                No</label>
                                                            <div
                                                                class="{{Session::get('userType') === "staff" ? "col-md-6 col-sm-3" : "col-md-9 col-sm-9"}}">
                                                                <input type="text" class="form-control"
                                                                       value="{{$staff->mobile_no}}"
                                                                       placeholder="Mobile No"
                                                                       name="mobile_no" {{Session::get('userType') === "staff" ? "readonly" : ""}}>
                                                            </div>
                                                            @if(Session::get('userType') === "staff" )
                                                                <a class="border-button" href="javascript:;"
                                                                   onclick="getMobilePopup('{{ route('mobile.popup.get', $staff->id) }}', '{{ route('check.mobile') }}', {{ $staff->id }}, '{{ Session::get('userType') }}')">
                                                                    <button type="button" class="btn btn-secondary">
                                                                        Change Mobile No
                                                                    </button>
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="control-label col-md-3 col-sm-3 "> Address
                                                            </label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                            <textarea class="form-control" rows="3"
                                                                      name="address"
                                                                      placeholder="Address">{{$staff->address}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">State</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <x-state select-state="{{$staff->state_id}}"/>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">City</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <x-city selected="{{$staff->city_id}}"/>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Pin
                                                                Code</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$staff->pin_code}}"
                                                                       placeholder="Pin Code" name="pin_code">
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Aadhaar
                                                                No</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="text" class="form-control"
                                                                       value="{{$staff->aadhaar_no}}"
                                                                       placeholder="Aadhaar No"
                                                                       name="aadhaar_no" {{Session::get('userType') === "staff" ? "readonly" : ""}}>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Gender</label>
                                                            <div class="col-md-6 col-sm-6 ">
                                                                <div class="radio-group mt-2">
                                                                    <div class="radio">
                                                                        @foreach(App\Models\Hospital::GENDER as $key => $value )
                                                                            <label>
                                                                                <input type="radio" value="{{ $key }}"
                                                                                       id="routine_checkup"
                                                                                       name="gender" {{ ($key === $staff->gender) ? 'checked' : '' }}> {{ $value }}
                                                                                &nbsp;&nbsp;
                                                                            </label>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Date Of
                                                                Birth</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input id="dob" name="dob" value="{{$staff->dob}}"
                                                                       class="date-picker form-control"
                                                                       placeholder="dd-mm-yyyy" type="text"
                                                                       onfocus="this.type='date'"
                                                                       onmouseover="this.type='date'"
                                                                       onclick="this.type='date'"
                                                                       onblur="this.type='text'"
                                                                       onmouseout="timeFunctionLong(this)">
                                                                <script>
                                                                    function timeFunctionLong(input) {
                                                                        setTimeout(function () {
                                                                            input.type = 'text';
                                                                        }, 60000);
                                                                    }
                                                                </script>
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
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Profile
                                                                Photo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <input type="file" id="profile_photo"
                                                                       name="avatar" accept="image/*"
                                                                       oninput="profile_preview.src=window.URL.createObjectURL(this.files[0])"/>
                                                                <img id="profile_preview" width="100px"/>
                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="form-group row">
                                                            <label
                                                                class="control-label col-md-3 col-sm-3 ">Document
                                                                Photo</label>
                                                            <div class="col-md-9 col-sm-9 ">
                                                                <div class="col-md-55">
                                                                    <div class="thumbnail">
                                                                        <div class="image view view-first">
                                                                            <a href="{{$staff->document_pic ? asset('upload_file/staff/staff_document/'.$staff->document_pic) : asset('upload_file/default.png')}}"
                                                                               target="_blank">
                                                                                <img
                                                                                    style="width: 100%; display: block;"
                                                                                    src="{{$staff->document_pic ? asset('upload_file/staff/staff_document/'.$staff->document_pic) : asset('upload_file/default.png')}}"
                                                                                    alt="image">
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if(Session::get('userType') !== "staff" )
                                                                    <input type="file" id="document_pic"
                                                                           name="document_pic" accept="image/*"
                                                                           alt="{{$staff->name}}"
                                                                           oninput="document_preview.src=window.URL.createObjectURL(this.files[0])">
                                                                    <img id="document_preview" width="100px"/>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="ln_solid"></div>
                                                        <div class="form-group">
                                                            <div class="col-md-9 col-sm-9  offset-md-3">
                                                                <a href="{{route('staff.index')}}">
                                                                    <button type="button" class="btn btn-primary">Cancel
                                                                    </button>
                                                                </a>
                                                                <button type="reset" class="btn btn-primary">Reset
                                                                </button>
                                                                @if(Session::get('userType') !== "user" )
                                                                    <a href="{{route('staff.staffDelete', $staff->id)}}">
                                                                        <button type="button" class="btn btn-danger">
                                                                            Delete
                                                                        </button>
                                                                    </a>
                                                                @endif
                                                                <button class="btn btn-success">Submit
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <x-change-password id="{{$staff->id}}" user-type="staffOrDoctor"/>
                                            <!-- Change E-mails Pop-Up -->
                                            <div id="updateEmailPopup"></div>
                                            <!-- /Change E-mails Pop-Up -->
                                            <!-- Change Mobile Pop-Up -->
                                            <div id="update_mobile_popup"></div>
                                            <!-- /Change Mobile Pop-Up -->
                                        </div>
                                        <!-- end staff details update -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <script>
        // $("#getStatesList").html(data);
        $(document).ready(function () {
            getCity("{{ $staff->state_id }}", "{{ $staff->city_id }}")

            $('#state').change(function () {
                getCity(this.value);
            });
        });

        function getCity(stateId, cityId = null) {
            $.ajax({
                type: 'POST',
                url: '{{ route('fetchCities') }}',
                data: {
                    stateId: stateId,
                    selected: cityId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    // alert("success");
                    $("#getCityList").html(data);
                }
            });
        }
    </script>
@stop


