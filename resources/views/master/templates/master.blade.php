<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @include('master.templates.header')
    </head>
    <body style="background-image: url({{url('/')}}/img/default-background{{rand(1,4)}}.jpg)">
        @include('master.templates.nav')
        @yield('body')
        @include('master.templates.footer')

        <script type="text/javascript" src="{{ elixir('js/master.js') }}"></script>
        <script type="text/javascript">
            //$(document).foundation();
        </script>
        
        @yield('footercode')
    </body>
    
</html>