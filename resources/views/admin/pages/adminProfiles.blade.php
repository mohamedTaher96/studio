@extends('admin/layout/adminLayout')
@section('style')
    <style>
        .profile-user-img
        {
            width: 200px;
            height: 200px;
            margin-right: 41%;
        }
        @media  screen and (max-width: 1000px) 
        { 
        .profile-user-img
        {
            width: 150px;
            height: 150px;
            margin-right: 40%;
        }
        }
        @media  screen and (max-width: 700px) 
        { 
        .profile-user-img
        {
            width: 110px;
            height: 110px;
            margin-right: 35%;
        }
        }
    </style>
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-body box-profile container">
        <img class="profile-user-img img-responsive img-circle" src='{{asset("images/admin/$admin_profile->photo")}}' alt="User profile picture">
        <h3 class="profile-username text-center"> {{$admin_profile->first_name}} {{$admin_profile->last_name}}</h3>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>البريد الالكتروني</b> <a class="pull-left">{{$admin_profile->email}}</a>
            </li>
            <li class="list-group-item">
              <b>الهاتف</b> <a class="pull-left">{{$admin_profile->phone}}</a>
            </li>
            <li class="list-group-item">
              <b>الإقامه</b> <a class="pull-left">{{$admin_profile->state}}</a>
            </li>
            <li class="list-group-item">
                <b>الميلاد</b> <a class="pull-left">{{$admin_profile->birth}}</a>
            </li>
            <li class="list-group-item">
                <b>الوظيفة</b> <a class="pull-left">{{$admin_profile->job}}</a>
            </li>
            <li class="list-group-item">
                <b>عضو منذ</b> <a class="pull-left">{{ \Carbon\Carbon::parse($admin_profile->created_at)->format(' M Y')}}</a>
            </li>
            <li class="list-group-item">
                    <b> الصلاحيات</b>
                    <ul >
                    @foreach ($admin_permisions as $admin_permision)
                    <li ><a>{{$admin_permision->name}}</a></li>
                    @endforeach
                    </ul>
                   
            </li>
          </ul>
        </div>
        <!-- /.box-body -->
      </div>
@endsection