<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @include('home.templates.header')
    </head>
    <body style="background-image: url({{url('/')}}/img/default-background{{rand(1,4)}}.jpg)">
        @include('home.templates.nav')
        @yield('body')
        @include('home.templates.footer')

        <script src="{{url('/')}}/js/jquery-1.11.2.min.js"></script>
        <script src="{{url('/')}}/js/bootstrap.min.js"></script>

        @yield('footercode')
    </body>
    
</html>