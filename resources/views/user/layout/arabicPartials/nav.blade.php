

<div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="fa fa-bars"></span>
                </button>
                <a href="/home" class="navbar-brand hidden-sm hidden-md hidden-lg"><img src="{{asset('images/user/logo.png')}}" alt="LOGO"></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right text-align-left">
                    <li class="home"><a href="/">{{$language['home']}}</a></li>
                        <li class="about"><a href="/about"> {{$language['about']}}</a></li>
                        <li class="service"><a href="/services">{{$language['service']}}</a></li>
                    </ul>
                    <a href="/home" class="navbar-brand hidden-xs text-center"><img src="{{asset('images/user/logo.png')}}" alt="LOGO"></a>   
                    <ul class="nav navbar-nav navbar-left text-align-right">
                        <li class="gallery"><a href="/gallery">{{$language['gallery']}} </a></li>
                        <li class="contact"><a href="/contact"> {{$language['contact']}}</a></li>
                        <li class="language" ><a >{{$language['language']}}</a></li>
                    </ul>
                    {{-- @endif --}}
            </div>
        </div>
</div>