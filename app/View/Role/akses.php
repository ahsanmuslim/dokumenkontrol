<?php
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Role Management</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/role" class="btn btn-warning btn-sm mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-angle-double-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="card mb-2 shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Role Access : <?= $data['role']['role']; ?></h6>
        </div>
        <div class="card-body">
            <style>
                th.judul,
                td.judul {
                    text-align: center;
                }
                /* //css untuk horizantal scroll */
                th, td { white-space: nowrap; }
                div.dataTables_wrapper {
                    width: 100%;
                    margin: 0 auto;
                }
            </style>
            <form name="form_akses" method="post">
                <input type="hidden" value="PUT" name="_method" id="request">
                <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                <input type="hidden" name="id_role" value="<?= $data['role']['id']; ?>" class="form-control">
                <input type="hidden" name="role" value="<?= $data['role']['role']; ?>" class="form-control">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-hover" id="tblrole">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="judul">#</th>
                                        <th>Title Menu</th>
                                        <th>Controller</th>
                                        <th class="judul">Akses</th>
                                        <th class="judul">Create</th>
                                        <th class="judul">Update</th>
                                        <th class="judul">Delete</th>
                                        <th class="judul">Print</th>
                                        <th class="judul">Import</th>
                                    </tr>
                                </thead>
                                <?php $no = 1;
                                foreach ($data['akses'] as $akses) : ?>
                                    <tr>
                                        <td class="judul"><?= $no++; ?></td>
                                        <td><?= $akses['title']; ?></td>
                                        <td><?= $akses['url']; ?></td>
                                        <td class="judul">
                                            <input type="checkbox" name="akseslist[]" value="<?= $akses['controller'] ?>" class="akseslist" <?= ($akses['akses'] == 1) ? 'checked' : '' ?>>
                                        </td>
                                        <td class="judul">
                                            <input type="checkbox" name="createlist[]" value="<?= $akses['controller'] ?>" class="createlist" <?= ($akses['create'] == 1) ? 'checked' : '' ?>>
                                        </td>
                                        <td class="judul">
                                            <input type="checkbox" name="updatelist[]" value="<?= $akses['controller'] ?>" class="updatelist" <?= ($akses['update'] == 1) ? 'checked' : '' ?>>
                                        </td>
                                        <td class="judul">
                                            <input type="checkbox" name="deletelist[]" value="<?= $akses['controller'] ?>" class="deletelist" <?= ($akses['delete'] == 1) ? 'checked' : '' ?>>
                                        </td>
                                        <td class="judul">
                                            <input type="checkbox" name="printlist[]" value="<?= $akses['controller'] ?>" class="printlist" <?= ($akses['print'] == 1) ? 'checked' : '' ?>>
                                        </td>
                                        <td class="judul">
                                            <input type="checkbox" name="importlist[]" value="<?= $akses['controller'] ?>" class="importlist" <?= ($akses['import'] == 1) ? 'checked' : '' ?>>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

            <div class="dropdown-divider"></div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group text-center">
                        <input type="submit" name="updateakses" value="UPDATE AKSES" onclick="updateAccess()" class="btn btn-danger mt-3 py-2 px-5">
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>


<!-- scrip javascript untuk menjalankan validasi check box role akses  -->
<script>
    function updateAccess() {

        if ($('.akseslist:checked').length > 0) {
            document.form_akses.action = '<?= BASEURL; ?>/role/akses';
            document.form_akses.submit();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Pilih MINIMAL 1 Role Access !!'
            })
        }

    }
</script>