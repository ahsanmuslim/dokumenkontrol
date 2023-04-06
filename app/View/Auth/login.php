<?php
use Teckindo\DokumenKontrol\Helper\Flasher;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $data['title'] ?></title>
  <link rel="shortcut icon" href="<?= BASEURL ?>/icon/favicon-96x96.png" type="image/x-icon">
  <link href="<?= BASEURL ?>/css/sb-dark-themes.css" rel="stylesheet">
</head>

<body class="bg-gray-900">

<div class="container">

    <!-- Outer Row -->
    <div align="center" style="margin-top:80px;" class="row justify-content-center">
      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
<!--          <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                <div class="col-lg-12">
                    <div class="px-5 py-5">

                        <div class="text-center mb-4">
                            <img src="<?= BASEURL ?>/img/logo/logo-medium.png" alt="logo-firman" height="50px" class="d-md-inline mr-3">
                            <h4 class="text-dark mb-2 mt-2 d-md-inline font-weight-bold">FIRMAN INDONESIA</h4>
                        </div>
                        <div class="row">
                          <div class="col-lg-12">
                            <?= Flasher::loginFailed() ?>
                          </div>		
                        </div>

                        <form action="<?= BASEURL; ?>/login" method="post" class="user">
                            <div class="dropdown-divider mb-4"></div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-user" id="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password" required>
                            </div>
                            <div class="dropdown-divider mt-4"></div>
                            <input type="submit" name="login" value="LOGIN" class="btn btn-lg btn-warning btn-user font-weight-bold btn-block mt-4">
                        </form>

                    </div>
                </div>

            </div>
            <!-- end row  -->
          </div>
        </div>


      </div>
    </div>
    <!-- outer row  -->

</div>
<!-- container end  -->

  
  <!-- Bootstrap core JavaScript-->
  <script src="<?= BASEURL; ?>/js/jquery-3.5.1.min.js"></script>
  <script src="<?= BASEURL; ?>/js/bootstrap.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= BASEURL; ?>/js/sb-dark-themes.js"></script>

</body>

</html>
