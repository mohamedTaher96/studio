@extends('admin/layout/adminLayout')
@section('style')
    <style>

    </style>
@endsection
@section('content')
<section class="content-header">
        <h1>
        تعديل لينك {{$link->name}}  
        <small> </small>
        </h1>
</section>
<section class="content">
    <form >
        @csrf
        <div class="form-group">
            <input class="form-control" id="link" link_id={{$link->id}} value="{{$link->url}}"> 
        </div>
        <div class="form-group">
            <input id="submit"  class="btn btn-primary" value="تعديل">
        </div>
    </form>
</section>
@endsection
@section('script')
    <script>
        $("#submit").click(function(e){
            e.preventDefault();
            var link = $("#link").val();
            var link_id = $("#link").attr('link_id');
            console.log(link_id)
            $.ajax({
                url:"new",
                type:"POST",
                data:{id:link_id,link:link},
                headers:
		        {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data)
                {
                    location.assign("/admin/editPages/others/links/?edit=true");
                }
            })
        })
    </script>
@endsection