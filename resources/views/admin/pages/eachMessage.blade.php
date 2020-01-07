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
                          <h3 class="box-title">قرائة البريد </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                          <div class="mailbox-read-info">
                            <h3>{{$messages->company_name}}</h3>
                            <h5>From: {{$messages->email}}<span class="mailbox-read-time pull-right">{{$messages->created_at}}</span></h5>
                          </div><!-- /.mailbox-read-info -->
                          <div class="mailbox-controls with-border text-center">
                            <div class="btn-group">
                                <a onclick="return confirm('Are you sure you want to delete message?')" href="order/delete?id={{$messages->id}}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></a>
                                <a href="arder/reply?id={{$messages->id}}" class="btn btn-default btn-sm" data-toggle="tooltip" title="Reply"><i class="fa fa-reply"></i></a>
                            </div><!-- /.btn-group -->
                          </div><!-- /.mailbox-controls -->
                          <div class="mailbox-read-message">
                                {!!$messages->order!!}
                                <br/>
                                <a class="btn btn-primary" href="{{ route('pdfview',['download'=>'pdf',"id"=>Request::get('id')]) }}"> PDF</a>
                          </div><!-- /.mailbox-read-message -->
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                          <ul class="mailbox-attachments clearfix">
                              @if($messages->file!='none')
                                <li>
                                    <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                    <div class="mailbox-attachment-info">
                                      <a href="download?id={{$messages->id}}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> download file</a>
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
        {{-- <div class="box box-primary content">
            <div >
            <h4>الاسم : {{$messages->company_name}}</h4>
            <h4>البريد الإلكتروني : {{$messages->email}}</h4>
            <h4>رقم التواصل : {{$messages->contact_number}}</h4>
            </div>
            <hr>
            <div class="container">
                    {!!$messages->order!!}
                    <br>
                    @if($messages->file!="none")
                        <h4> الملف المرفق: <a target="_blanck" href="download?id={{$messages->id}}">download</a></h4>
                    @endif
            </div> 
            <hr>
            <section >
                    <div class="alert alert-success hide">تم إارسال الرساله بنجاح</div>
                </section>
            <h4>إرسال رسالة</h4>
            <div class="box">
                
                    <form action="sendMessage" method="POST" enctype="multipart/form-data" >
                    @csrf
                        <textarea class="form-control" id="editor" placeholder="ادخل الرساله ......." name="content" rows="6" cols="80">
                        </textarea>
                        <input type="file" class="form-control" name="files[]" accept="file_extension|image/*|media_type" multiple>
                        <input type="hidden" class="hidden" name="email" value="{{$messages->email}}"><br>
                        <input type="submit" class="btn btn-primary" value="ارسل" id="send">
                        <img id="img" class="hide" src="{{asset('images/ajax-loader.gif')}}">
                    </form>
                    <hr>
                    
                    
                  
            </div>
        </div> --}}
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