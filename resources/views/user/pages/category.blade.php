@extends('user/layout/arabicLayout')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('js/user/jquery.fancybox.css?v=2.1.5')}}" media="screen">
    <link rel="stylesheet" type="text/css" href="{{asset('js/user/helpers/jquery.fancybox-buttons.css?v=1.0.5')}}">
    <style>
        img
        {
            height: 180px;
        }
    </style>
@endsection
@section('content')
    <div class="fixed-bg">
        <img src="{{asset('images/covers/'.$cover->src)}}">
    </div>
    <div class="main-content">
            <div class="container-fluid">
            <h1 class="main-heading"> {{$category->name}}</h1>
                <div class="row">
                    @foreach ($images as $image)
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <a class="fancybox-buttons img-holder small-img" rel="gallery" title="" data-fancybox-group="button" href="{{asset("images/category_images/".$image->src."")}}">
                            <img class="thisImage" id="{{$image->id}}" src="{{asset("images/category_images/".$image->src."")}}" alt="img">
                            </a>
                        </div>
                    @endforeach

                </div>
        
                
        
            </div>
        </div>
        @isset($imageId)
            <input type="hidden"  id="{{$imageId}}">
        @endisset
@endsection
@section('script')
    <script>
        $(document).ready(function (){
            showImage();
        });
            function showImage()
            {
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
                    // this.title ='<div id="share"></div>';


                    this.title = '<a role="button" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::fullUrl()) }}" class=" social-share btn btn-fb btn-small"><i class="fa fa-facebook right-fa"></i> Share</a>' +
                            '<a role="button" target="_blank" href="https://twitter.com/intent/tweet?url={{ urlencode(Request::fullUrl()) }}" class="social-share btn btn-tw btn-small"><i class="fa fa-twitter right-fa"></i> Share</a>' +
                            '<a role="button" target="_blank" href="https://plus.google.com/share?url={{ urlencode(Request::fullUrl()) }}" class="social-share btn btn-inst btn-small"><i class="fa fa-instagram right-fa"></i> Share</a>';
                }
            });
            }


    

var popupMeta = {
    width: 400,
    height: 400
}
                
$(document).on('click', '.social-share', function(event){
    event.preventDefault();
 
    var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
        hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);
 
    var url = $(this).attr('href');
    var popup = window.open(url, 'Social Share',
        'width='+popupMeta.width+',height='+popupMeta.height+
        ',left='+vPosition+',top='+hPosition+
        ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');
 
    if (popup) {
        popup.focus();
        return false;
    }
});
    
    </script>
@endsection