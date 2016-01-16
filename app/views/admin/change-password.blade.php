@extends('home.templates.master', array('var1'=>'', 'var2'=>''))
@section('body')
<form id="change-password-form" action="{{url('/')}}/admin/change-password" method="post" role="form">
  	<!--<div class="form-group">
    	<label for="username">Username</label>
    	<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username">
  	</div>-->
  	<div class="form-group">
    	<label for="password">Old Password</label>
    	<input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Old Password">
    </div>
    <div class="form-group">
      <label for="password">New Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
    </div>
    <div class="form-group">
      <label for="password">Confirm New Password</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm New Password">
    </div>
    <div class="alert alert-danger alert-dismissible fade in hidden" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4>Your passwords do not match.</h4>
    </div>
	<button type="submit" class="btn btn-lg btn-default pull-right">Change Password</button>
	<div class="clearfix"></div>
</form>
@stop

@section('footercode')
<script>
    $('#change-password-form'.submit(event)
    {
        event.preventDefault();
        if(($('#password').val() != '') && ($('#password_confirmation').val() != '') && ($('#current_password').val() != ''))
        {
            if($('#password').val() == $('#password_confirmation').val())
            {
                $('#change-password-form').submit();
            } else {
                $('.alert-danger').removeClass('hidden');
            }
        }
        
    });
</script>
@stop