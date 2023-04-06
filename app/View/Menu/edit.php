<?php

use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-3 text-gray-800">Menu Management</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/controller" class="btn btn-warning btn-sm mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-angle-double-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-0">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Edit Controller</h6>
                </div>
                <div class="card-body">
                    <style>
                        form label:not(.form-check-label) {font-weight:bold;}
                    </style>
                    <div class="col-lg">
                    <form action="<?= BASEURL; ?>/controller" method="post" class="needs-validation" novalidate>
                    <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                    <input type="hidden" value="PUT" name="_method">
                        <div class="form-group">
                            <label for="title">Nama Menu</label>
                            <input type="hidden" name="id" value="<?= $data['controller']['id'] ?>">
                            <input type="text" name="title" id="title" class="form-control" value="<?= $data['controller']['title'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control" required maxLength="15" minLength="3" pattern="^[a-z]*$" value="<?= $data['controller']['url'] ?>" readonly>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Gunakan huruf kecil saja !!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <input type="text" name="icon" id="icon" class="form-control" value="<?= $data['controller']['icon'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="admin">Sidemenu ?</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_menu" id="ya" value=1 <?= ($data['controller']['is_menu'] == 1) ? 'checked' : '' ?>> 
                                    <label class="form-check-label" for="ya">
                                        Ya
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="is_menu" id="tidak" value=0 <?= ($data['controller']['is_menu'] == 0) ? 'checked' : '' ?>> 
                                    <label class="form-check-label" for="tidak">
                                        Tidak
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <select name="is_active" id="is_active" class="form-control" required>
                                <option value=1 <?= ($data['controller']['is_active'] == 1) ? 'selected' : '' ?>>Aktif</option>
                                <option value=0 <?= ($data['controller']['is_active'] == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
                            </select>
                        </div><br>

                        <div class="form-group text-center">
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
</script>