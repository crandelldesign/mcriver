@extends('master.templates.master')
@section('body')
<h1>Check Out</h1>

<div class="row">
	<div class="col-md-4">
		<p>Select an option to continue.</p>
		<button class="btn btn-lg btn-success" data-toggle="modal" data-target="#loginModal">Log In to Your Account</button>
		
		<hr>
		<button class="btn btn-lg btn-primary" data-toggle="modal" data-target="#registerModal">Register a New Account</button>
		<hr>
		<h2>Continue as a Guest</h2>
	</div>
	<div class="col-md-8">
		<h2>Review Your Order</h2>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="loginModal">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Login</h4>
      		</div>
      		<div class="modal-body">
        		<form class="form-horizontal" role="form" method="POST" action="">
					<div class="form-group">
						<label class="col-md-4 control-label">Email</label>
                        <div class="col-md-6">
			            	<input type="email" class="form-control" name="email" placeholder="Email">
			            </div>
			        </div>
			        <div class="form-group">
			        	<label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
			            	<input type="password" class="form-control" name="password" placeholder="Password">
			            </div>
			        </div>
			        <div class="form-group">
			        	{!! csrf_field() !!}
			        	<div class="col-md-6 col-md-offset-4">
				        	<button type="submit" class="btn btn-primary btn-block">
				                Continue
				            </button>
				        </div>
			        </div>
	    		</form>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="registerModal">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title">Register</h4>
      		</div>
      		<div class="modal-body">
        		<form class="form-horizontal" role="form" method="POST" action="">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label class="col-md-4 control-label">Name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">E-Mail Address</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-btn fa-user"></i> Register
                            </button>
                        </div>
                    </div>
                </form>
      		</div>
    	</div><!-- /.modal-content -->
  	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@stop