@extends('admin/layout/adminLayout')
@section('style')
    <style>
        .social
        {
            padding: 10px;
        }
    </style>
@endsection
@section('content')
@if (session('sent'))
<div class="alert alert-success">تم إارسال الرساله بنجاح</div>
@endif
<section class="content">
        <div class="">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                  <h1>
                    إرسال بريد 
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="https://studio-20.herokuapp.com/admin"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
                    <li class="active">البريد</li>
                  </ol>
                </section>
        
                <!-- Main content -->
                <section class="content">
                  <div class="row">
                    <div class="col-md-3">
                      <div class="box box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">الملفات</h3>
                          <div class="box-tools">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                          </div>
                        </div>
                        <div class="box-body no-padding">
                          <ul class="nav nav-pills nav-stacked">
                            <li><a href="https://studio-20.herokuapp.com/admin/messages/"><i class="fa fa-inbox"></i> الوارد <span class="label label-primary pull-right">{{$unread}}</span></a></li>
                            <li><a href="https://studio-20.herokuapp.com/admin/messages/exports"><i class="fa fa-envelope-o"></i> الصادر</a></li>
                            <li><a onclick="return confirm('Are you sure you want to delete message?')" href="/admin/messages/order/delete?id={{Request::get('id')}}"><i class="fa fa-trash-o"></i> مسح</a></li>
                          </ul>
                        </div><!-- /.box-body -->
                      </div><!-- /. box -->
                    </div><!-- /.col -->
                    <div class="col-md-9">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">إرسال بريد </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                          <div class="mailbox-read-info">
                            <h3>{{$message->company_name}}</h3>
                            <h5>From: {{$message->email}}<span class="mailbox-read-time pull-right">{{$message->created_at}}</span></h5>
                          </div><!-- /.mailbox-read-info -->
                          <div class="mailbox-read-message">
                            <form action="sendMessage" method="POST" enctype="multipart/form-data" >
                                @csrf
                                    <textarea class="form-control" id="editor" placeholder="ادخل الرساله ......." name="content" rows="6" cols="80">
                                    </textarea>
                                    <input type="file" class="form-control" name="file">
                                    <input type="hidden" class="hidden" name="email" value="{{$message->email}}"><br>
                                    <input type="hidden" class="hidden" name="name" value="{{$message->company_name}}"><br>
                                    <input type="hidden" class="hidden" name="id" value="{{ Request::get('id') }}"><br>
                                    <input type="submit" class="btn btn-primary" value="ارسل" id="send">
                                    <img id="img" class="hide" src="{{asset('images/ajax-loader.gif')}}">
                                </form>
                          </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                      </div><!-- /. box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </section><!-- /.content -->
              </div>
</section>
@endsection
@section('script')
    <script>
        $("#send").click(function(){
        $(this).addClass("hide");
        $("#img").removeClass("hide");
        })
        $("#send").click(function(){
        $(this).addClass("hide");
        $("#img").removeClass("hide");
        })
        $("#editor").val("");
        if(".alert")
        {
            window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
            });
            }, 1500);
        }
    </script>
@endsection