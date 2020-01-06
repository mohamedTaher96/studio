@extends('admin/layout/adminLayout')
@section('style')
    <style>
        img
        {
            width: 100%;
            height: 150px;
        }
    </style>
@endsection
@section('content')
    @if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم حذف الصوره بنجاح. </div>
    @endif
    @if (session('add'))
    <div class='alert alert-success'><strong></strong>  تم إضافة الصور بنجاح. </div>
    @endif
    <section class="content-header">
        <h1>
            التصنيف :<span style="color:red">{{$category->name}}</span>
        <small> </small>
        </h1>
        
        <br>
        <a class="btn btn-primary" href="http://localhost:8000/admin/gallery/images/new/">إضافة صور</a>
        <a href="/admin/gallery/images">كل الصور</a>
        {{-- <a href="http://localhost:8000/admin/gallery/images/"> كل الصور</a> --}}
    </section>
    <section class="content">
        <div class="row">
            @foreach ($images as $image)
                <div class="col-xs-6 col-sm-4 col-md-3 ">
                    
                    <img src="{{asset('images/category_images/'.$image->src."")}}" alt="...">
                    <a role="button" class="btn btn-link" onclick="return confirm('are you sure you want to delete the image')" href="http://localhost:8000/admin/gallery/images/delete?id={{$image->id}}">delete</a>
                    
                </div>
            
            @endforeach
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

