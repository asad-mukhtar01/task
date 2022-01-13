<!DOCTYPE html>
<html>
<head>
	<title>Please Create Account</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row justify-content-center" style="margin-top:5%;">
			<div class="col-lg-4">
				<form action="{{ route('create.user') }}" method="post">
					@csrf
						<input type="hidden" value="{{ $check->invitation_token }}" name="token">
						<div class="card">
							<div class="card-header">
								Please Sign Up Here
							</div>
							<div class="card-body">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control" name="name">
									@error('name')
			                            <font color="red"><b>{{ $message }}</b></font>
			                           @enderror
								</div>
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email">
									@error('email')
                            <font color="red"><b>{{ $message }}</b></font>
                           @enderror
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" class="form-control" name="password">
									@error('password')
                            <font color="red"><b>{{ $message }}</b></font>
                           @enderror
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-danger btn-block">Sign Up</button>
							</div>
						</div>	
				</form>
			</div>
		</div>
	</div>
</body>
</html>