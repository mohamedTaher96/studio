@extends('user/layout/arabicLayout')
@section('style')
    <style>
        img
        {
            height: 250px;
        }
    </style>
@endsection
@section('content')
    <div class="fixed-bg">
        <img src="{{asset('images/covers/'.$covers->src)}}">
    </div>
    <div class="main-content">
            <div class="container-fluid">

                <h1 class="main-heading">{{$language['work']}}</h1>    
                <div class="row">
                @foreach ($categories as $category)       
                    <div class="col-xs-12 col-sm-6 col-md-4 no-padding">
                        <a href="/gallery/category?category_id={{$category->id}}&category_name={{$category->name}}" class="img-holder">
                            <img src="{{asset('images/categories/'.$category->category_img."")}}" alt="...">
                            <div class="hover-content">
                                <h1> {{$category->name}}</h1>
                            </div>
                        </a>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
@endsection
@section('script')
    <script>
        active();
        function active()
        {
            $(".gallery").addClass("active");
        }
    </script>
@endsection