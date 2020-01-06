@extends('user/layout/arabicLayout')
@section('header')
    {{-- <div id="owl-demo" class="owl-carousel owl-theme">
        @foreach ($covers as $cover)
            <div class="item"><img src="{{asset('images/covers/'.$cover->src)}}" alt="..."></div>
        @endforeach
    </div> --}}
        
    <div class="hidden">
        <a class="btn owl-btn next"><span class="fa fa-angle-right"></span></a>
        <a class="btn owl-btn prev"><span class="fa fa-angle-left"></span></a>
    </div>
@endsection
@section('script')
<script>
        active();
        function active()
        {
            $(".home").addClass("active");
        }

    </script>
@endsection