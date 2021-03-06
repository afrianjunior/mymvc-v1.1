<?php require BASE_VIEW . 'header.php';  ?>
	
	<div class="container">
		<div class="rowlogin row">
			<div class="col-md-4 col-md-offset-4">
				<h1 class="headlogin">REGISTER | <small>site</small></h1>
				<form action="<?php echo $router->generate('auth-store') ?>" method="POST">
					<input type="hidden" name="token" value="<?php echo Token::generate() ?>">
					<div class="form-group">
						<label>EMAIL</label>
						<input type="email" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>PASSWORD</label>
						<input type="password" name="password" class="form-control">
					</div>
					<div class="form-group">
						<label>PASSWORD CONFIRMATION</label>
						<input type="password" name="password_confirmation" class="form-control">
					</div>
					<button type="submit" class="btn-login">REGISTER</button>
				</form>
			</div>
		</div>
	</div>

<?php require BASE_VIEW . 'footer.php';  ?>