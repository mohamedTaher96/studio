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
        <section >
            <div class="alert alert-success hide">تم إارسال الرساله بنجاح</div>
        </section>
        <section class="content-header">
                <h1>
                إرسال رسالة
                <small> </small>
                </h1>
        </section>
        <section class="content">
                <div class="box content"> 
                        <div class="box-header with-border">
      
                        <form action="send" method="POST" enctype="multipart/form-data" >
                        @csrf
                            <textarea class="form-control" id="editor" placeholder="ادخل الرساله ......." name="content" rows="6" cols="80">
                            </textarea>
                            <input type="file" class="form-control" name="file">
                            <br>
                            <input type="submit" class="btn btn-primary" value="ارسل" id="send">
                        <img id="img" class="hide" src="{{asset('images/ajax-loader.gif')}}">
                        </form>
                        <hr>
                        
                        
                        </div>  
                </div>
        </section>
</section>
@endsection
@section('script')
    <script>
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