<div class="site-container">
    <header class="header">
        <div class="container-fluid logo-container hidden-xs">
            <a href="{{url('/')}}"><img class="img-responsive center-block" src="{{url('/')}}/img/logo-default-gold.png" alt="McRiver"></a>
        </div>
        <nav class="navbar">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainNav">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand visible-xs-block" href="{{url('/')}}"><img src="{{url('/')}}/img/logo-default.png" alt="McRiver"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul id="menu-menu" class="nav navbar-nav">
                        <li class="{{(!isset($active_page)) || $active_page=='home'?'active':''}}"><a href="{{url('/')}}">Home</a></li>
                        <li class="{{(!isset($active_page)) || $active_page=='signup'?'active':''}}"><a href="{{url('/')}}/sign-up">Sign Up to Party</a></li>
                        <li class="{{(!isset($active_page)) || $active_page=='orderStatus'?'active':''}}"><a href="{{url('/')}}/order-status">Order Status</a></li>
                        <li class="{{(!isset($active_page)) || $active_page=='rookies'?'active':''}}"><a href="{{url('/')}}/rookies">Rookie Requirements</a></li>
                        @if(!\Auth::check())
                        <li><a href="#" data-toggle="modal" data-target="#loginModal">Log In</a></li>
                        @endif
                    </ul>        
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>
    <div class="page container-fluid">