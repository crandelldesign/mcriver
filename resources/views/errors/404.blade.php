<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        @include('layouts.head')
    </head>
    <body style="background-image: url({{url('/')}}/img/default-background{{rand(1,4)}}.jpg)">
        <div class="site-container">
            <header class="header">
                <div class="container-fluid logo-container hidden-xs">
                    <a href="{{url('/')}}"><img class="img-responsive center-block" src="{{url('/')}}/img/logo-default-gold.png" alt="McRiver"></a>
                </div>
            </header>
            <div class="page container-fluid">
                <h1>404 - Page Not Found</h1>

                <p>This page does not exist.</p>
            </div> <!--.page-->
            <footer class="footer">
                <p>Copyright &copy; {{date("Y")}} McRiver Raid. All Rights Reserved.</p>
                <p>Designated trademarks and brands are the property of their respective owners.</p>
                <p>Website and graphics are created by Cap'n Matt Crandell. Check out his other great work at <a href="http://www.crandelldesign.com" target="_blank">Crandell Design</a>.</p>
            </footer>
        </div> <!--.site-container-->
        <script type="text/javascript" src="{{ elixir('js/master.js') }}"></script>
    </body>
</html>