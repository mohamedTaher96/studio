@extends('admin/layout/adminLayout')
@section('style')
    <style>
        .social
        {
            padding: 10px;
        }
        td
        {
            word-break: break-word;
            padding: 12px;
        }
    </style>
@endsection
@section('content')
@if (Request::get('edit')==="true")
<div class='alert alert-success'><strong></strong>  تم تعديل اللينك بنجاح. </div>
@endif
<section class="content-header">
        <h1>
         تعديل اللينكات
        <small> </small>
        </h1>
</section>
<section class="content">
        <div class="box box-primary">
        <div class="table-responsive"> 
    <table class="table  table-hover table-condensed table-striped">
        <thead>
            <tr>
                <th>الاسم</th>
                <th>الرابط</th>
                <th>التعديل</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($links as $link)
        <tr>
            <td class="td">{{$link->name}}</td>
            <td class="td"><a target='_blank' rel='noopener noreferrer' href="{{$link->url}}"> {{$link->url}} </a></td>
            <td class="td"><a href="links/edit?id={{$link->id}}" class="btn btn-primary">تعديل</a></td>
        </tr>    
    @endforeach
        </tbody>
    </table>
        </div>
                </div>
        </div>
</section>
@endsection
@section('script')
    <script>
            if($(".alert"))
            {
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                    });
                    }, 1000);
            }
    </script>
@endsection