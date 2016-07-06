<!DOCTYPE html>
<html>
    <head>
        @include('layouts.admin-head')
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                McRiver Admin
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Reset Password</p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form" role="form" method="POST" action="{{ url('/password/email') }}">
                    {!! csrf_field() !!}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label">E-Mail Address</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="{{ elixir('js/admin.js') }}"></script>
    </body>
</html>