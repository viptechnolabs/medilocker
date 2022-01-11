@extends('layout.app')
@section('content')

    <style>
        th, td {
            font-size: 14px;
        }
    </style>
    <div class="page-title">
        <div class="title_left">
            <h3>Staff</h3>
        </div>

        <div class="title_right">
            <div class="pull-right">
                <a href="{{route('staff.addStaff')}}">
                    <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-user-plus"></i> &ensp; Add User
                    </button>
                </a>
                <a href="{{route('staff.deletedStaff')}}">
                    <button type="button" class="btn btn-danger btn-sm">
                        <i class="fa fa-user"></i> &ensp; Deleted User
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Staff List</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th style="padding: 15px; text-align: center;">Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile No</th>
                                        <th style="padding: 15px; text-align: center;">Status</th>
                                        <th style="padding: 15px; text-align: center;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($staffs as $no => $staff)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td style="padding: 15px; text-align: center;">
                                                <img
                                                    src='{{$staff->avatar ? asset('upload_file/staff/'.$staff->avatar) : asset('upload_file/default.png')}}'
                                                    width='40px'/>
                                            </td>
                                            <td>{{ $staff->name }}</td>
                                            <td>{{ $staff->email }}</td>
                                            <td>{{ $staff->mobile_no }}</td>
                                            <td style="padding: 15px; text-align: center;">
                                                {{--                                                <a class="border-button" href="javascript:;"--}}
                                                {{--                                                   onclick="StatusChange('{{ route('change_status_popup') }}','{{ route('change_status', $user->id) }}', 'Are You Sure to change Status...?', 'user')">--}}
                                                <button type="button"
                                                        class="{{$staff->status === 'active' ? 'btn btn-success btn-sm' : 'btn btn-secondary btn-sm'}}">
                                                    {{ucfirst($staff->status)}}
                                                </button>
                                                {{--                                                </a>--}}
                                            </td>
                                            <td style="padding: 15px; text-align: center;">
                                                <a href="{{route('staff.staffDetails', $staff->id)}}">
                                                    <button type="button" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-user"> </i> View Profile
                                                    </button>
                                                </a>
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
        </div>
    </div>
@stop

