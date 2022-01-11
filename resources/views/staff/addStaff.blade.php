@extends('layout.app')
@section('content')
    <!-- page content -->
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <a href="{{route('staff.index')}}"> Do your work, then step back. </a>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add User</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form action="{{route('staff.storeStaff')}}" method="POST" enctype="multipart/form-data"
                          id="addStaff">
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
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Email</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="email" class="form-control" type="text" name="email" placeholder="Email">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Mobile
                                No</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="mobile_no" class="form-control" type="text" name="mobile_no"
                                       placeholder="Mobile no">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name"
                                   class="col-form-label col-md-3 col-sm-3 label-align">Address</label>
                            <div class="col-md-6 col-sm-6 ">
                                <textarea class="form-control" rows="3"
                                          name="address"
                                          placeholder="Address"></textarea>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">State</label>
                            <div class="col-md-6 col-sm-6 ">
                                <x-state select-state=""/>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">City</label>
                            <div class="col-md-6 col-sm-6 ">
                                <x-city/>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pin
                                Code</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="pin_code" class="form-control" type="text" name="pin_code"
                                       placeholder="Pin Code">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Aadhar
                                No</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="aadhaar_no" class="form-control" type="text" name="aadhaar_no"
                                       placeholder="Aadhaar No">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Role</label>
                            <div class="col-md-6 col-sm-6 ">
                                <select id="role" name="role" class="form-control">
                                    <option value="">Choose..</option>
                                    @foreach(App\Models\Hospital::ROLE as $key => $value)
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="routine_checkup"
                                   class="col-form-label col-md-3 col-sm-3 label-align">Gender</label>
                            <div class="col-md-6 col-sm-6 ">
                                <div class="radio-group mt-2">
                                    <div class="radio">
                                        @foreach(App\Models\Hospital::GENDER as $key => $value )
                                            <label>
                                                <input type="radio" value="{{ $key }}" id="routine_checkup"
                                                       name="gender"> {{ $value }} &nbsp;&nbsp;
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Date Of Birth
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                                <input id="dob" name="dob" class="date-picker form-control" placeholder="dd-mm-yyyy"
                                       type="text" onfocus="this.type='date'" onmouseover="this.type='date'"
                                       onclick="this.type='date'" onblur="this.type='text'"
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
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Profile
                                Photo</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" id="avatar" name="avatar" accept="image/*"
                                       oninput="profile_preview.src=window.URL.createObjectURL(this.files[0])"/>
                                <img id="profile_preview" width="100px"/>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Document
                                Photo</label>
                            <div class="col-md-6 col-sm-6 ">
                                <input type="file" id="document_pic" name="document_pic" accept="image/*"
                                       oninput="document_preview.src=window.URL.createObjectURL(this.files[0])">
                                <img id="document_preview" width="100px"/>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="item form-group">
                            <div class="col-md-6 col-sm-6 offset-md-3">
                                <a href="{{route('staff.index')}}">
                                    <button class="btn btn-primary" type="button">Cancel</button>
                                </a>
                                <button class="btn btn-primary" type="reset">Reset</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <script>
        // $("#getStatesList").html(data);
        $('#state').change(function () {
            var stateId = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('fetchCities') }}',
                data: {
                    stateId: stateId,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (data) {
                    // alert("success");
                    $("#getCityList").html(data);
                }
            });
        });
    </script>
@stop
