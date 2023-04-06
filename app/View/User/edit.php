<?php
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/user" class="btn btn-warning btn-sm mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-angle-double-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-0">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Edit User</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg">

                        <form action="<?= BASEURL; ?>/user" method="post" class="needs-validation" novalidate>
                        <input type="hidden" value="PUT" name="_method">
                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                        
                        <div class="form-group">
                            <label for="namauser">Nama User</label>
                            <input type="hidden" value="<?= $data['user']['id_user'] ?>" name="id_user">
                            <input type="text" name="namauser" id="namauser" class="form-control" required maxLength="50" minLength="3" pattern="^[a-zA-Z ]*$" value="<?= $data['user']['nama_user'] ?>">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Panjang karakter : 6 ~ 50 & menggunakan huruf semua !!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" maxLength="15" minLength="3" pattern="^[a-z0-9_.-]*$"  value="<?= $data['user']['username'] ?>" readonly>
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Gunakan kombinasi huruf kecil & angka !!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alias">Alias</label>
                            <input type="text" name="alias" id="alias" class="form-control" required maxLength="3" minLength="2" pattern="^[A-Z]*$" value="<?= $data['user']['alias'] ?>">
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">
                                Panjang karakter : 2-3 & menggunakan huruf kapital semua !!
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="level">Level User</label>
                            <div>
                                <div class="form-check">
                                    <?php foreach ($data['role'] as $role) : ?>
                                        <?php
                                            if ($role['id'] != "ADM") { ?>
                                                <input class="form-check-input" type="radio" name="role" id="<?= $role['role']; ?>" value="<?= $role['id']; ?>" <?= ($role['id'] == $data['user']['role']) ? 'checked' : '' ?> required>
                                                <label class="form-check-label mr-5" for="<?= $role['role']; ?>">
                                                    <?= $role['role']; ?>
                                                </label>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                    <div class="invalid-feedback">Pilih level user !</div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kd_divisi">Divisi</label>
                            <select name="kd_divisi" id="kd_divisi" class="form-control" required>
                                <?php foreach ($data['divisi'] as $val): ?>
                                <option value=<?= $val['kd_divisi'] ?> <?= $val['kd_divisi'] == $data['user']['kd_divisi'] ? 'selected' : '' ?>><?= $val['nama_divisi'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value=1 <?= ($data['user']['is_active'] == 1) ? 'selected' : '' ?>>Aktif</option>
                                <option value=0 <?= ($data['user']['is_active'] == 0) ? 'selected' : '' ?>>Tidak Aktif</option>
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