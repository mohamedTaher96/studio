@extends('admin/layout/adminLayout')
@section('style')
    <!-- iCheck -->
    <link rel="stylesheet" href='{{asset("css/admin/blue.css")}}'>
    <style>
        .check
        {
            margin: 20px;
        }
    </style>
@endsection
@section('content')
    @if (session('error'))
    <div class='alert alert-danger '><strong></strong>    جميع الفراغات مطلوبة ونوع الملف يجب ان يكون صوره </div>
    @endif
    @if (session('password_error'))
    <div class='alert alert-danger '><strong></strong> كلمة السر يجب ان تكون متطابقة </div>
    @endif
    @if (session('email_error'))
    <div class='alert alert-danger '><strong></strong>هذاالبريد الإلكتروني مسجل بالبيانات  </div>
    @endif
    @if (session('success'))
    <div class='alert alert-success '><strong></strong>     تمت إضافة المشرف بنجاح </div>
    @endif
    <section class="content-header">
            <h1>
            إضافة مشرف
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">مشرف جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="update" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" value="{{$old_data->id}}">
                            <label for="exampleInputEmail1"> اسم المشرف </label>
                            <input type="text" class="form-control" name="first_name" value="{{$old_data->first_name}}">
                            <label for="exampleInputEmail1"> اسم العائلة </label>
                            <input type="text" class="form-control" name="last_name" value=" {{$old_data->last_name}}">
                            <label for="exampleInputEmail1">  البريد الالكتروني </label>
                            <input type="email" class="form-control" name="email" value="{{$old_data->email}} ">
                            <label for="exampleInputEmail1">  الرقم السري </label>
                            <input type="password" class="form-control" name="password" >
                            <label for="exampleInputEmail1"> تكرارالرقم السري </label>
                            <input type="password" class="form-control" name="rePassword"  >
                            <label for="exampleInputEmail1"> رقم الهاتف  </label>
                            <input type="text" class="form-control" name="phone" value="{{$old_data->phone}} ">
                            <label for="exampleInputEmail1">  الوظيفة  </label>
                            <input type="text" class="form-control" name="job" value=" {{$old_data->job}}">
                            <label for="exampleInputEmail1">  السكن  </label>
                            <input type="text" class="form-control" name="state" value=" {{$old_data->state}}">
                            <label for="exampleInputEmail1">  الميلاد  </label>
                            <input type="date" class="form-control" name="birth" value="{{$old_data->birth}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile">الصوره الشخصيه  </label>
                          <input type="file"  name="photo">
                        </div>
                      </div><!-- /.box-body -->
                      <hr>
                      <div class="form-group content">
                            <label for="exampleInputFile"><b><u>الصلاحيات </u></b>  </label><br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="9"> المشتركون<br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="10"> العملاء<br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="11"> الرسائل<br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="12"> الصفحات<br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="13"> الصور والتصنيفات<br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="14"> الرزم والخيارات<br><br>
                            <input type="checkBox" class="check"  name="roles[]" value="15"> المشرفون
                      </div>
    
                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                      </div>
                    </form>
                  </div>
    </section>        
    @section('script')
      <!-- iCheck -->
      <script src="{{asset('js/admin/icheck.min.js')}}"></script>
        <script>
            $(function () {
                $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
                });
            });
        </script>

    @endsection
@endsection