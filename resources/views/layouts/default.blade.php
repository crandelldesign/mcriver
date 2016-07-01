<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @include('layouts.head')
    </head>
    <body style="background-image: url({{url('/')}}/img/default-background{{rand(1,4)}}.jpg)">
        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')

        <script type="text/javascript" src="{{ elixir('js/master.js') }}"></script>
        
        @yield('scripts')
    </body>
    
</html>