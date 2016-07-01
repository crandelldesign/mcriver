<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @include('master.templates.head')
    </head>
    <body style="background-image: url({{url('/')}}/img/default-background{{rand(1,4)}}.jpg)">
        @include('master.templates.nav')
        @yield('content')
        @include('master.templates.footer')

        <script type="text/javascript" src="{{ elixir('js/master.js') }}"></script>
        
        @yield('scripts')
    </body>
    
</html>