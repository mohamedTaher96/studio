<!DOCTYPE html>
<html lang="en">
<head>
    @include('user/layout/arabicPartials.head')
    @yield('style')
</head>
<body>
    <nav class="navbar navbar-fixed-top"> @include('user/layout/arabicPartials.nav') </nav>
    <header> @yield('header') </header>
    @yield('content')
    <footer class="navbar-fixed-bottom text-center"> @include('user/layout/arabicPartials.footer') </footer>
    
    @include('user/layout/arabicPartials.script')
    @yield('script')
    
    
</body>
</html>