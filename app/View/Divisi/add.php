<?php

use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Divisi</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/divisi" class="btn btn-warning btn-sm mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-angle-double-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="row mb-5 mt-3">
        <div class="col-lg-6">
            <div class="card mb-0">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Tambah Divisi</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg">

                        <form action="<?= BASEURL; ?>/divisi" method="post" class="needs-validation" novalidate>
                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">

                        <div class="form-group">
                            <label for="kd_divisi">Kode Divisi</label>
                            <input type="text" name="kd_divisi" class="form-control" required autofocus>
                        </div>
                        
                        <div class="form-group">
                            <label for="nama_divisi">Nama Divisi</label>
                            <input type="text" name="nama_divisi" id="nama_divisi" class="form-control" required maxLength="50" minLength="3" pattern="^[a-zA-Z ]*$">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Panjang karakter : 6 ~ 50 & menggunakan huruf semua !!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control" required maxLength="3" minLength="2" pattern="^[A-Z ]*$">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Panjang karakter : 2-3 & menggunakan huruf kapital !!
                            </div>
                        </div>

                        <div class="form-group text-center mt-5">
                            <input type="submit" name="simpan" value="SIMPAN" class="btn btn-dark btn-block py-3 font-weight-bold">
                        </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>