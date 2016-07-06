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
                <form class="form" role="form" method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="control-label">E-Mail Address</label>
                        <input type="email" class="form-control" name="email" value="{{ $email or old('email') }}">

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label class="control-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation">

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-refresh"></i> Reset Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript" src="{{ elixir('js/admin.js') }}"></script>
    </body>
</html>
