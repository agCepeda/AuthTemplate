@extends('auth._layout-auth')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-14">
			<form action="{{ url('auth/login') }}" method="post">
				<div class="form-group">
					<label for="">Username:</label>
					<input class="form-control" type="text" name="username">
				</div>
				<div class="form-group">
					<label for="">Password:</label>
					<input class="form-control" type="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Login</button>
			</form>
		</div>
	</div>
</div>
@stop