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
                    <h6 class="m-0 font-weight-bold text-dark">Buat Surat / Dokumen</h6>
                </div>
                <div class="card-body">
                    <div class="col-lg">

                        <form action="<?= BASEURL; ?>/postdocument" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="jenis">Jenis Surat</label>
                                <select name="jenis" class="form-control" id="jenis" required onchange="getNomorSurat()">
                                    <option value=""></option>
                                    <?php 
                                        foreach($data['jenis'] as $h): ?>
                                            <option value="<?= $h['kd_jenis'] ?>"><?= $h['jenis'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="nosurat">No Surat</label>
                                <input type="text" name="nosurat" id="nosurat" class="form-control" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="header">Header Surat</label>
                                <select name="header" class="form-control" id="header" required>
                                    <option value=""></option>
                                    <?php 
                                        foreach($data['header'] as $h): ?>
                                            <option value="<?= $h['id'] ?>"><?= $h['nama_perusahaan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="lokasi">Lokasi</label>
                                <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="tanggal">Tanggal Surat</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="perihal">Perihal Surat</label>
                                <input type="text" name="perihal" id="perihal" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="lampiran">Lampiran 1</label>
                                <input type="text" name="lampiran[]" id="lampiran" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lampiran">Lampiran 2</label>
                                <input type="text" name="lampiran[]" id="lampiran" class="form-control">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lampiran">Lampiran 3</label>
                                <input type="text" name="lampiran[]" id="lampiran" class="form-control">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="salam">Salam Pembuka</label>
                                <input type="text" name="salam" id="salam" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="body">Isi Surat</label>
                            <textarea name="body" id="body" rows="20" cols="100" class="form-control">
                                
                            </textarea>
                        </div>

                        <div class="form-group text-center mt-5">
                            <input type="submit" name="simpan" value="BUAT DOKUMEN BARU" class="btn btn-primary btn-block py-3 font-weight-bold">
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

    function getNomorSurat()
    {
        const url = window.location.origin + '/';
        // const url = window.location.origin + '/dokumenkontrol/';
        const jenis = $('#jenis').val();
        // console.log(jenis);

        $.ajax({
            url: url + 'postdocument/getnomorsurat',
            data: {
                jenis: jenis
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
                if(data){
                    // console.log(data);
                    $('#nosurat').val(data)
                }
            }
        });
    }

</script>