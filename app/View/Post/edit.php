<?php

use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Post Document</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/postdocument" class="btn btn-warning btn-sm mb-3">
            <span class="icon text-white-50">
                <i class="fas fa-angle-double-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="row mb-5 mt-3">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Edit Surat / Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg">

                        <form action="<?= BASEURL; ?>/postdocument" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                        <input type="hidden" value="PUT" name="_method">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="header">Header Surat</label>
                                <select name="header" class="form-control" id="header" required>
                                    <?php 
                                        foreach($data['header'] as $h): ?>
                                            <option value="<?= $h['id'] ?>" <?= $h['id'] == $data['postdokumen']['header'] ? 'selected' : '' ?>><?= $h['nama_perusahaan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nosurat">No Surat</label>
                                <input type="text" name="nosurat" id="nosurat" class="form-control" value="<?= $data['postdokumen']['no_surat'] ?>"  readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" value="<?= $data['postdokumen']['lokasi'] ?>" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tanggal">Tanggal Surat</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['postdokumen']['tanggal_surat'] ?>" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="perihal">Perihal Surat</label>
                                <input type="text" name="perihal" id="perihal" class="form-control" value="<?= $data['postdokumen']['perihal'] ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="salam">Salam Pembuka</label>
                                <input type="text" name="salam" id="salam" class="form-control" value="<?= $data['postdokumen']['salam'] ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body">Isi Surat</label>
                            <!-- <input id="body" name="body" value="" type="hidden" name="content">
                            <trix-editor input="body"></trix-editor> -->
                            <textarea name="body" id="body" rows="10" cols="80" class="form-control">
                                <?= $data['postdokumen']['isi_surat'] ?>
                            </textarea>
                        </div>

                        <div class="form-group text-center mt-5">
                            <input type="submit" name="update" value="UPDATE DOKUMEN" class="btn btn-warning btn-block py-3 font-weight-bold">
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
    CKEDITOR.replace( 'body' );

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