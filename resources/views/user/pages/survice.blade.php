@extends('user/layout/arabicLayout')
@section('content')
    <div class="fixed-bg">
        <img src="{{asset('images/covers/'.$cover->src)}}">
    </div>
    <div class="main-content">
            <div class="container">
                <h1 class="main-heading">{{$language['service']}}</h1>
                {!!$content!!}

            </div>
        </div>
@endsection
@section('script')
    <script>
        active();
        function active()
        {
            $(".service").addClass("active");
        }

    </script>
@endsection