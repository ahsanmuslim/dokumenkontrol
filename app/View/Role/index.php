<?php
use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Role Access Management</h1>

    <div class="row">
        <div class="col-lg-6">

            <div class="card mb-2 shadow">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Data Role</h6>
                    <div class="d-inline">
                        <a href="#" class="btn btn-dark text-right modalAddRole" data-toggle="modal" data-target="#modalRole"><i class="fas fa-plus"></i></a>
                        <a href="<?= BASEURL ?>/role" class="btn btn-warning text-right"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg">
                        <?php Flasher::flash(); ?>
                    </div>
                    <div class="col-lg">
                        <ul class="list-group">
                            <?php foreach ($data['role'] as $role) : ?>
                                <?php if ($role['id'] == 1) { ?>
                                    <li class="list-group-item">
                                        <?= $role['role']; ?>
                                        <a href="<?= BASEURL; ?>/role/akses/<?= $role['id']; ?>" class="badge badge-primary float-right ml-2">access</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="list-group-item">
                                        <?= $role['role']; ?>
                                        <a href="<?= BASEURL; ?>/role/akses/<?= $role['id']; ?>" class="badge badge-primary float-right ml-2">access</a>
                                        <form action="<?= BASEURL ?>/role" method="POST" class="d-inline">
                                            <input type="hidden" value="DELETE" name="_method">
                                            <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                                            <input type="hidden" value="<?= $role['id']; ?>" name="id">
                                            <button class="badge badge-danger float-right ml-2 border-0 tombol-hapus-form">delete</button>
                                        </form>
                                        <a href="" class="badge badge-warning float-right ml-2 modalEditRole" data-toggle="modal" data-target="#modalRole" data-id="<?= $role['id']; ?>">edit</a>
                            <?php
                                }
                            endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>


<!-- Modal -->
<div class="modal fade" id="modalRole" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="judulModal">Tambah Role</h4>
            </div>
            <div class="modal-body">
                <form action="<?= BASEURL; ?>/role" method="post" class="needs-validation" novalidate>
                    <input type="hidden" value="PUT" name="_method" id="request">
                    <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                    <div class="form-group">
                        <label for="role">ID role</label>
                        <input type="text" name="id" value="" class="form-control" id="id">
                    </div>
                    <div class="form-group">
                        <label for="role">Nama role</label>
                        <input type="text" name="role" class="form-control" id="role" required maxLength="15" minLength="3" pattern="^[a-z]*$">
                        <div class="valid-feedback">Looks good!</div>
                        <div class="invalid-feedback">
                            Gunakan huruf kecil saja !!
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-dark">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
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