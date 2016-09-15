<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MYMVC-V.1.1</title>
	<link href="https://fonts.googleapis.com/css?family=Lato:300i" rel="stylesheet">
	<style>
		body {
			font-family: 'Lato', sans-serif;
		}
		.welcome {
			margin-top:20%; 
			text-align:center;
		}
		.desc {
			text-align:center;
		}
	</style>
</head>
<body>
	<h1 class="welcome">MYMVC-V.1.1</h1>
	<p class="desc">Please <a href="<?php echo $router->generate('auth-register') ?>">register</a> | <a href="<?php echo $router->generate('auth-login') ?>">login</a></p>
</body>
</html>