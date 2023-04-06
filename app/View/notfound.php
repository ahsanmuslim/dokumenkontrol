<!DOCTYPE html>
<html>
<head>
	<title><?= $data['title'] ?></title>
	<link rel="stylesheet" type="text/css" href="<?= BASEURL ?>/css/bootstrap.css">
</head>
<body>

<div class="d-flex align-items-center" style="min-height: 80vh;">
	<div class="container mt-4">
		<div class="error-box">
			<div class="error-body text-center p-4">
				<h3><strong>HTTP ERROR 404</strong></h3>
				<h5><small>No webpage was found for the web address: <b><?= $data['link'] ?></b></small></h5><br>
				<a href="<?= BASEURL ?>" class="btn btn-dark">Back to home</a> 
			</div>
		</div>
	</div>
</div>

<script src="<?= BASEURL ?>/js/jquery-3.3.1.js"></script>

<script src="<?= BASEURL ?>/js/bootstrap.js"></script>
<script src="<?= BASEURL ?>/js/script.js"></script>

</body>
</html>