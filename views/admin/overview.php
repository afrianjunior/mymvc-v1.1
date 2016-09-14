<?php require 'header.php'; ?>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="title">Overview</h1>
				<p class="desc">
					Welcome, <strong><?php echo $currentUser->email ?></strong> to page administrator.
				</p>
				<p class="desc">
					<a href="<?php echo $router->generate('auth-logout') ?>">logout</a>
				</p>
			</div>
		</div>
	</div>

<?php require 'footer.php'; ?>