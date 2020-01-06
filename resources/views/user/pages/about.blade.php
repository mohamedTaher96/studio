@extends('user/layout/arabicLayout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('js/user/jquery.fancybox.css?v=2.1.5')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('js/user/helpers/jquery.fancybox-buttons.css?v=1.0.5')}}">
@endsection
@section('content')
    <div class="fixed-bg">
        <img src="{{asset('images/covers/'.$cover->src)}}">
    </div>
    
    <div class="main-content">
        <div class="container">


                    <h1 class="main-heading">{{$language['about']}} </h1>
                    <div class="text-center div-padding">
                        {!!$content!!}
                        <a href="profileDownload" target="_blank" class="btn btn-white margin"><span>  {{$language['profile']}}</span></a>
                        <a href="/gallery" class="btn btn-white margin"><span> {{$language['work']}}</span></a>
                    </div>
            
            
                    <div class="div-small-padding">
                        <h1 class="main-heading">{{$language['client']}}</h1>
            
            
    

    
                <div class="row">
                    <div class="col-xs-2 col-sm-1 no-padding text-center">
                        <a class="owl-btn prev-pro margin"><span class="fa fa-angle-right"></span></a>
                    </div>
    
                    <div class="col-xs-8 col-sm-10 no-padding">
                        <div id="owl-demo-products" class="owl-carousel-clients">
                            @foreach ($clients as $client)
                                <div class="item">
                                    <a class="fancybox-buttons" data-fancybox-group="button" href="{{asset('images/clients/'.$client->client_logo."")}}">
                                        <img src="{{asset('images/clients/'.$client->client_logo."")}}" alt="img">
                                    </a>
                                </div>        
                            @endforeach
                        </div>
                    </div>
    
                    <div class="col-xs-2 col-sm-1 no-padding text-center">
                        <a class="owl-btn next-pro margin"><span class="fa fa-angle-left"></span></a>
                    </div>
                </div>
            </div>
    
        </div>
    </div>
    
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/user/helpers/jquery.fancybox-buttons.js?v=1.0.5')}}"></script>
    <script>
        active();
        function active()
        {
            $(".about").addClass("active");
        }
        $(document).ready(function (){
        /*Button helper. Disable animations, hide close button, change title type and content*/

        $('.fancybox-buttons').fancybox({
            openEffect  : 'none',
            closeEffect : 'none',

            prevEffect : 'none',
            nextEffect : 'none',

            closeBtn  : false,

            helpers : {
                title : {
                    type : 'inside'
                },
                buttons	: {}
            },

            afterLoad : function() {
                this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
            }
        });
    });
    </script>
@endsection