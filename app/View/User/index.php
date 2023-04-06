<?php

use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-3 text-gray-800">User</h1>
    

        <div class="card mb-2">
            <div class="card-header d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Data User</h6>
                <div class="d-inline">
                    <a href="<?= BASEURL ?>/user/add" class="btn btn-dark text-right"><i class="fas fa-plus"></i></a>
                    <a href="<?= BASEURL ?>/user" class="btn btn-warning text-right"><i class="fas fa-sync-alt"></i></a>
                </div>
            </div>
            <div class="card-body">
                <div class="col-lg-8">
                    <?php Flasher::flash(); ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tbluser">
                        <thead class="thead-light">
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
                            <tr>
                                <th class="judul">No.</th>
                                <th>Nama User</th>
                                <th>Username</th>
                                <th>Alias</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Register</th>
                                <th>Divisi</th>
                                <th class="judul"><i class="fas fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $text = '';
                        foreach ($data['user'] as $r) : 
                        ?>
                            <tr>
                                <td class="judul"><?= $no++ ?></td>
                                <td><?= $r['nama_user'] ?></td>
                                <td><?= $r['username'] ?></td>
                                <td><?= $r['alias'] ?></td>
                                <td><?= $r['role'] ?></td>
                                <td><?= ($r['is_active'] == 1) ? "Aktif" : "Tidak Aktif" ?></td>
                                <td><?= date('d M y', strtotime($r['tgl_register'])) ?></td>
                                <td><?= $r['nama_divisi'] ?></td>
                                <td class="judul">
                                    <?php
                                    if($r['role'] == 'admin'){ ?>
                                        <button class="btn btn-sm btn-primary"><i class="fas fa-user-shield"></i></button>
                                    <?php } else { ?>
                                    <a href="<?= BASEURL ?>/user/edit/<?= $r['id_user'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                    <a href="#" class="btn btn-primary btn-sm ttdUserModal" data-toggle="modal" data-target="#ttdUserModal" data-user="<?= $r['id_user']; ?>"><i class="fas fa-fw fa-signature"></i></a>
                                    <form action="<?= BASEURL ?>/user" method="POST" class="d-inline">
                                        <input type="hidden" value="DELETE" name="_method">
                                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                                        <input type="hidden" value="<?= $r['id_user']; ?>" name="id_user">
                                        <button class="btn btn-sm btn-danger tombol-hapus-form"><i class="fas fa-fw fa-trash"></i></button>
                                    </form>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
<!-- /.container-fluid -->

</div>


<!-- Modal Share Dokument-->
<div class="modal fade" id="ttdUserModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"><span class="text-sm-left">Update TTD User : </span>  <span class="badge badge-primary" id="judul"></span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/user/ttd" method="post" enctype="multipart/form-data">
            <input type="hidden" value="PUT" name="_method">
            <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
            <input type="hidden" value="" name="id_user" id="id_user">
            <label for="file_upload">Pilih file ttd yang akan diupload</label>
            <div class="custom-file">
                <input type="file" class="ttd-file-input" id="file_upload" name="file_upload" required> 
                <label class="custom-file-label" for="file_upload">Format file harus gambar</label>
            </div>
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Upload TTD</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
$('.ttdUserModal').on('click',function(){

  const id = $(this).data('user');
  $('#id_user').val(id);

});

//fungsi untuk menampilka nama file ynag di upload
$('.ttd-file-input').on('change', function () {

    var size =(this.files[0].size);
    var inputFile = document.getElementById('file_upload');
    var pathFile = inputFile.value;
    var ekstensiOk = /(\.jpg|\.png)$/i;

    if(size > 2000000) {
        //disabled tomol submit
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        $(':input[type="submit"]').prop('disabled', true);
        //menampilkan sweet alert jika file terlalu besar
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'File yang Anda upload lebih dari 2Mb !!',
        })
    } else if(!ekstensiOk.exec(pathFile)){
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
        $(':input[type="submit"]').prop('disabled', true);
        //menampilkan sweet alert file extensi Tidak Sesuai
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Extensi File yang Anda upload tidak sesuai !!',
        })
    } else {
        //merubah value field dengan nama file
        $(':input[type="submit"]').prop('disabled', false);
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    }


});
</script>