<div class="container">
        <p> {{$language['footer']}}   &copy; 2005-2015 </p>
        @foreach ($links as $link)
            <a target='_blank' rel='noopener noreferrer' href="{{$link->url}}"><i class="fa fa-{{$link->name}}"></i></a>            
        @endforeach
    </div>