<?php

use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Jenis Surat</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/jenis" class="btn btn-warning btn-sm mb-3">
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
                    <h6 class="m-0 font-weight-bold text-dark">Edit jenis surat</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg">

                        <form action="<?= BASEURL; ?>/jenis" method="post">
                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                        <input type="hidden" value="PUT" name="_method">
                        
                        <div class="form-group">
                            <label for="kd_jenis">Kode Jenis</label>
                            <input type="text" name="kd_jenis" id="kd_jenis" value="<?= $data['jenis']['kd_jenis'] ?>" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Surat / Dokumen</label>
                            <input type="text" name="jenis" id="jenis" class="form-control" required maxLength="50" minLength="3" pattern="^[a-zA-Z ]*$" value="<?= $data['jenis']['jenis'] ?>" onkeyup="createFlagUrl()">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Panjang karakter : 6 ~ 50 & menggunakan huruf semua !!
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="flag_url">Flag URL</label>
                            <input type="text" name="flag_url" class="form-control" id="flag-url" value="<?= $data['jenis']['url_menu'] ?>" readonly>
                        </div>

                        <div class="form-group text-center mt-5">
                            <input type="submit" name="update" value="UPDATE" class="btn btn-warning btn-block py-3 font-weight-bold">
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

    function createFlagUrl()
    {
        const flag = document.getElementById('flag-url');
        let jenis = document.getElementById('jenis').value.toLocaleLowerCase();
        let flagUrl = jenis.replace(" ", "-");

        flag.value = flagUrl;
    }
</script>