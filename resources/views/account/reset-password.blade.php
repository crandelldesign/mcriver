@extends('layouts.default')
@section('content')
<h1>McRiver Raid 2018</h1>

<div class="modal fade" tabindex="-1" role="dialog" id="reset-password-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reset Password</h4>
            </div>
            <div class="modal-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop

@section('scripts')
<script>
    $(document).ready(function()
    {
        $('#reset-password-modal').modal('show')
    });
</script>
@stop
