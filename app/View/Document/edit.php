<?php

use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Dokumen Kontrol</h1>

    <div class="text-left">
        <a href="<?= BASEURL; ?>/document" class="btn btn-warning btn-sm mb-3">
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
                    <h6 class="m-0 font-weight-bold text-dark">Edit Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg">

                        <form action="<?= BASEURL; ?>/document" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                        <input type="hidden" value="PUT" name="_method">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nosurat">No Surat</label>
                                <input type="text" name="nosurat" id="nosurat" class="form-control" value="<?= $data['dokumen']['no_surat'] ?>" required readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="divisi">Divisi</label>
                                <select name="divisi" class="form-control" id="divisi" required>
                                    <option value=""></option>
                                    <?php 
                                        foreach($data['divisi'] as $div): ?>
                                            <option value="<?= $div['kd_divisi'] ?>" <?= ($data['dokumen']['kd_divisi'] == $div['kd_divisi']) ? 'selected' : '' ?> ><?= $div['nama_divisi'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="type">Type</label>
                                <select name="type" class="form-control" id="type" required>
                                    <option value="Surat Keluar">Surat Keluar</option>
                                    <option value="Surat Masuk">Surat Masuk</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tanggal">Tanggal Surat</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['dokumen']['tanggal_surat'] ?>"  required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jenis">Jenis Surat</label>
                                <select name="jenis" class="form-control" id="jenis" required>
                                    <option value=""></option>
                                    <?php 
                                        foreach($data['jenis'] as $div): ?>
                                            <option value="<?= $div['kd_jenis'] ?>" <?= ($data['dokumen']['jenis_surat'] == $div['kd_jenis']) ? 'selected' : '' ?> ><?= $div['jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="asalsurat">Asal Surat</label>
                                <input type="text" name="asalsurat" id="asalsurat" class="form-control" value="<?= $data['dokumen']['asal_surat'] ?>"  required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="kepada">Kepada</label>
                                <input type="text" name="kepada" id="kepada" class="form-control" value="<?= $data['dokumen']['kepada'] ?>"  required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="perihal">Perihal</label>
                                <input type="text" name="perihal" id="perihal" class="form-control" value="<?= $data['dokumen']['perihal'] ?>"  required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lampiran">Lampiran</label>
                                <input type="text" name="lampiran" id="lampiran" class="form-control" value="<?= $data['dokumen']['lampiran'] ?>"  required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ket">Keterangan</label>
                            <textarea name="ket" id="ket" cols="10" rows="3" class="form-control"><?= $data['dokumen']['keterangan'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="file_upload">Pilih file yang akan diupload</label>
                            <div class="custom-file">
                                <input type="hidden" name="revisi" class="form-control" value="<?= $data['dokumen']['revisi'] ?>">
                                <input type="file" class="custom-file-input" id="file_upload" name="file_upload"> 
                                <label class="custom-file-label" for="file_upload">Format file harus .pdf</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="akses">Share ke Divisi</label>
                            <select name="akses[]" id="akses" class="form-control" multiple="multiple" required>
                                <?php 
                                    foreach($data['divisi'] as $div): 
                                        $akses = '';
                                        foreach ($data['akses'] as $ak): ?>
                                            <?php
                                            if($div['kd_divisi'] == $ak['kd_divisi']){
                                                $akses = 'selected';
                                                break;
                                            }
                                            ?>
                                        <?php endforeach; ?>
                                        <?php if($data['userlogin']['kd_divisi'] != $div['kd_divisi']){  ?>
                                            <option value="<?= $div['kd_divisi'] ?>" <?= $akses ?>><?= $div['nama_divisi'] ?></option>
                                        <?php } ?>    
                                        <?php endforeach; ?>
                            </select>
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
    $(document).ready(function() {
        $('#akses').select2();
    });
</script>