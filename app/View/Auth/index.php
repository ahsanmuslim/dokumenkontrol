<?php

use Teckindo\DokumenKontrol\Helper\Flasher;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Ahsan">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title><?= $data['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="<?= BASEURL ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= BASEURL ?>/css/my-login.css">
	<link rel="shortcut icon" href="<?= BASEURL ?>/icon/favicon-96x96.png" type="image/x-icon">
</head>

<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper py-5">
					<div class="card fat border-primary mt-5">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<div class="row">
								<div class="col-lg-12">
									<?= Flasher::loginFailed() ?>
								</div>		
							</div>
							<form action="<?= BASEURL ?>/login" method="POST" class="my-login-validation" novalidate="">
								<div class="form-group">
									<label for="username">Username</label>
									<input id="username" type="text" class="form-control" name="username" value="" required autofocus>
									<div class="invalid-feedback">
                                        Username is required
									</div>
								</div>

								<div class="form-group">
									<label for="password">Password
									</label>
									<input id="password" type="password" class="form-control" name="password" required>
                                    <div class="invalid-feedback">
                                        Password is required
                                    </div>
								</div>

								<div class="form-group mt-5">
									<button type="submit" class="btn btn-warning btn-block">
										Login
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2022 &mdash; Teckindo
					</div>
				</div>
			</div>
		</div>
	</section>

    <script src="<?= BASEURL ?>/js/jquery-3.3.1.js"></script>
    <script src="<?= BASEURL ?>/js/popper.js"></script>
    <script src="<?= BASEURL ?>/js/bootstrap.js"></script>
    <script src="<?= BASEURL ?>/js/my-login.js"></script>
</body>
</html>
