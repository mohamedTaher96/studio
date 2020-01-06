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
                    قرائة البريد 
                  </h1>
                  <ol class="breadcrumb">
                    <li><a href="http://localhost:8000/admin"><i class="fa fa-dashboard"></i> الرئيسيه</a></li>
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
                            <li><a href="http://localhost:8000/admin/messages/"><i class="fa fa-inbox"></i> الوارد <span class="label label-primary pull-right">{{$unread}}</span></a></li>
                            <li><a href="http://localhost:8000/admin/messages/exports"><i class="fa fa-envelope-o"></i> الصادر</a></li>
                            <li><a onclick="return confirm('Are you sure you want to delete message?')" href="/admin/messages/export/delete?id={{Request::get('id')}}"><i class="fa fa-trash-o"></i> مسح</a></li>
                          </ul>
                        </div><!-- /.box-body -->
                      </div><!-- /. box -->
                    </div><!-- /.col -->
                    <div class="col-md-9">
                      <div class="box box-primary">
                        <div class="box-header with-border">
                          <h3 class="box-title">قرائة الصادر </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                          <div class="mailbox-read-info">
                            <h3>{{$export->company_name}}</h3>
                            <h5>to: {{$export->email}}<span class="mailbox-read-time pull-right">{{$export->created_at}}</span></h5>
                          </div><!-- /.mailbox-read-info -->
                          <div class="mailbox-read-message">
                                {!!$export->content!!}
                          </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                          <ul class="mailbox-attachments clearfix">
                              @if($export->file!='none')
                                <li>
                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                    <div class="mailbox-attachment-info">
                                        <a href="export/download?id={{$export->id}}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> download file</a>
                                    </div>
                                </li>                                  
                              @endif
                          </ul>
                        </div><!-- /.box-footer -->
                      </div><!-- /. box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </section><!-- /.content -->
              </div>
</section>
@endsection
@section('script')
    <script>
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