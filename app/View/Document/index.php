<?php

use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Arsip Dokumen</h1>
    
    <div class="row">
        <div class="col-lg-12">


            <div class="card mb-2">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <?php if(isset($data['judul'])){ ?>
                        <h6 class="m-0 font-weight-bold text-dark">Dokumen : <span class="text-warning"><?= $data['judul']['jenis'] ?></span></h6>
                    <?php } else { ?>
                        <h6 class="m-0 font-weight-bold text-dark">All Document</h6>
                    <?php } ?>
                    <div class="d-inline">
                        <a href="<?= BASEURL ?>/postdocument/add" class="btn btn-primary text-right"><i class="fas fa-pen-alt"></i></a>
                        <a href="<?= BASEURL ?>/document/add" class="btn btn-dark text-right"><i class="fas fa-upload"></i></a>
                        <a href="" class="btn btn-warning text-right"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-8">
                        <?php Flasher::flash(); ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tblsurat">
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
                                    <th>No.</th>
                                    <th>Divisi</th>
                                    <th>No Surat</th>
                                    <th>Type</th>
                                    <th>Jenis Surat</th>
                                    <th>Asal Surat</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
                                    <th>Lampiran</th>
                                    <th>Kepada</th>
                                    <th>Keterangan</th>
                                    <th class="judul"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $text = '';
                            foreach ($data['surat'] as $r) : 
                            ?>
                                <tr>
                                    <td class="judul"><?= $no++ ?></td>
                                    <td><?= $r['nama_divisi'] ?></td>
                                    <td><a href="#"  class="detailModal" data-toggle="modal" data-target="#modalDokumen" data-surat="<?= $r['no_surat']; ?>"><?= $r['no_surat'] ?></a></td>
                                    <td><?= $r['type'] ?></td>
                                    <td><?= $r['jenis'] ?></td>
                                    <td><?= $r['asal_surat'] ?></td>
                                    <td><?= $r['tanggal_surat'] ?></td>
                                    <td><?= $r['perihal'] ?></td>
                                    <td><?= $r['lampiran'] ?></td>
                                    <td><?= $r['kepada'] ?></td>
                                    <td><?= $r['keterangan'] ?></td>
                                    <td class="judul">

                                        <a href="#" class="btn btn-dark btn-sm shareModal" data-toggle="modal" data-target="#shareModal" data-surat="<?= $r['no_surat']; ?>"><i class="fas fa-fw fa-share-alt"></i></a>

                                        <a href="#"  class="btn btn-success btn-sm shareWAModal" data-toggle="modal" data-target="#shareWAModal" data-surat="<?= $r['no_surat']; ?>"><i class="fab fa-whatsapp"></i></a>
                                        <!-- <a href="<?= BASEURL ?>/document/sharewa/<?= $r['no_surat'] ?>"  target="_blank" class="btn btn-primary btn-sm"><i class="fab fa-whatsapp"></i></a> -->
                                        <a href="#" class="btn btn-primary btn-sm emailModal"  data-toggle="modal" data-target="#emailModal" data-file="<?= $r['nama_file']; ?>" data-surat="<?= $r['no_surat']; ?>"><i class="fas fa-fw fa-envelope-open-text"></i></a>

                                        <a href="#" class="btn btn-info btn-sm logShareModal"  data-toggle="modal" data-target="#logShareModal" data-nomor="<?= $r['no_surat']; ?>"><i class="fas fa-fw fa-history"></i></a>

                                        <a href="<?= BASEURL ?>/document/edit/<?= $r['no_surat'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-edit"></i></a>

                                        <form action="<?= BASEURL ?>/document" method="POST" class="d-inline">
                                            <input type="hidden" value="DELETE" name="_method">
                                            <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                                            <input type="hidden" value="<?= $r['no_surat']; ?>" name="no_surat">
                                            <button class="btn btn-sm btn-danger tombol-hapus-form"><i class="fas fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>


<!-- Modal -->
<div class="modal fade" id="modalDokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-folder-open fa-fw text-warning mr-2"></i><span class="text-sm-left">Detail Dokumen :</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body overflow-auto" id="modal-content">
        ... 
        <!-- //generate detail Dokumen -->
      </div>
    </div>
  </div>
</div>

<!-- Modal Share Dokument-->
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-share-alt fa-fw text-dark mr-2"></i><span class="text-sm-left">Share Document : </span>  <span class="badge badge-primary" id="judul"></span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/document/share" method="post">
            <input type="hidden" value="PUT" name="_method">
            <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
            <div id="share">

            </div>
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-dark">Share</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Small Modal for Share to Whatapps  -->
<div class="modal fade" id="shareWAModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h6 class="modal-title" id="exampleModalLongTitle"><i class="fab fa-whatsapp text-success mr-2"></i><span class="text-sm-left">Share to WhatApps </span></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL; ?>/document/sharewapost" method="post" id="washareform">
            <input type="hidden" name="nosurat" id="nosurat">
            <div class="form-group">
              <label>Ukuran Kertas</label>
              <select class="form-control mb-3" name="pagesize">
                  <option value="A4-P">A4 Portrait</option>
                  <option value="A4-L">A4 Landscape</option>
                  <option value="Legal-P">Legal Portrait</option>
                  <option value="Legal-L">Legal Landscape</option>
              </select>
            </div>
            <div class="form-group">
              <label for="password">Password File</label>
              <input type="text" name="password" id="password" value="firmanindo" class="form-control">
            </div>
            <div class="form-group d-inline-block">
              <label for="password">Share ke</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="jenis" id="internal" value="internal" required>
                <label class="form-check-label mr-5" for="internal">Internal</label>
                <input class="form-check-input" type="radio" name="jenis" id="eksternal" value="eksternal" required>
                <label class="form-check-label mr-5" for="eksternal">Eksternal</label>
              </div>
            </div>
            <div id="div-internal" class="d-none">
              <div class="form-group">
                <label>Nama Penerima</label>
                <select class="form-control mb-3" name="namapenerima1" id="namapenerima1" onchange="getNomorHP()">
                  <option></option>
                  <?php foreach ($data['nomorhp'] as $k) : ?>
                  <option value="<?= $k['nama'] ?>"><?= $k['nama'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>No Handphone</label>
                <input type="text" name="nomorhp1" id="nomorhp1" class="form-control" readonly>
              </div>
            </div>
            <div id="div-eksternal" class="d-none">
              <div class="form-group">
                <label>Nama Penerima</label>
                <input type="text" name="namapenerima2" class="form-control">
              </div>
              <div class="form-group">
                <label>No Handphone</label>
                <input type="text" name="nomorhp2" id="nomorhp2" class="form-control" pattern="[0]{1}[8]{1}[0-9]{8,10}" onkeyup="checkTelp();">
              </div>
            </div>        
      </div>
      <div class="modal-footer">
            <button type="submit" class="btn btn-success" target="_blank"><i class="fab fa-whatsapp mr-2"></i>Share To WhatApps</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="emailModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-envelope-open-text text-primary mr-2"></i>Kirim Email</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body px-4">

        <form method="post" action="<?= BASEURL ?>/document/sendemail">
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient :</label>
              <!-- <input type="email" class="form-control" id="recipient-name" name="penerima" required> -->
              <select name="penerima[]" id="recipient-name" class="form-control" multiple="multiple">
                <option></option>
              </select>
            </div>
            <div class="form-group">
              <label for="subject" class="col-form-label">Subject :</label>
              <input type="text" class="form-control" id="subject" name="subject" required>
            </div>
            <div class="form-group">
              <label for="body" class="col-form-label">Body :</label>
              <textarea name="body" id="body" style="height:200px;" class="form-control" required></textarea>
            </div>
            <div class="form-group mt-2 mb-1">
              <label for="lampiran" class="col-form-label">Lampiran :</label><br>
              <input type="hidden" name="lampiran" id="lampiran">
              <input type="hidden" name="nomor" id="nomor">
              <a href="<?= BASEURL ?>/document/viewer/" class="text-danger text-decoration-none" id="filelampiran" target="_blank"></a>
            </div>

      </div>
          
          <!-- Modal footer -->
      <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send Email</button>
          </form>
      </div>
      
    </div>
  </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="logShareModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h6 class="modal-title"><i class="fas fa-history text-info mr-2"></i>Log Share Document : <span class="badge badge-info" id="judullog"></h6> 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body px-4" id="dataLogShare">
          <!-- Data log Share  -->

      </div>
      
    </div>
  </div>
</div>

<script>
CKEDITOR.replace( 'body' );

const url = window.location.origin + '/';
    // const url = window.location.origin + '/dokumenkontrol/';

$(document).ready(function() {
      $('#namapenerima1').select2({
        width: "100%"
      });
      $('#recipient-name').select2({
        width: "100%",
        tags: "true"
      });
});

$('.shareWAModal').on('click',function(){

  const id = $(this).data('surat');
  $('#nosurat').val(id);

});

$('.emailModal').on('click',function(){

  const id = $(this).data('file');
  const no = $(this).data('surat');

  var hrefValue = $('#filelampiran').attr('href');
  var filename = id.replace(/\.pdf$/, '');
  hrefValue = hrefValue + filename

  $('#lampiran').val(id);
  $('#nomor').val(no);
  $('#filelampiran').html('<i class="fas fa-paperclip mr-2"></i>' + id);
  $('#filelampiran').attr('href', hrefValue);

});

$('.logShareModal').on('click', function(){
  const nomor = $(this).data('nomor');

  $.ajax({
        
        url: url + 'document/getlogshare',
        data: {nomor : nomor},
        method: 'post',
        success: function(data) {
            $('#judullog').html(nomor);
            $('#dataLogShare').html(data);
        }

  });

});

function getNomorHP()
{
    const nama = $('#namapenerima1').val();

    $.ajax({
        
        url: url + 'document/getnomor',
        data: {nama : nama},
        method: 'post',
        dataType: 'json',
        success: function(data) {
            $('#nomorhp1').val(data.no_telp);
        }

    });
}

function checkTelp()
{
    var regTelp = new RegExp("[0]{1}[8]{1}[0-9]{9,10}");
    var no_telp  = document.getElementById('nomorhp2');

    var good_color = "#D0F8FF";
    var bad_color  = "#FFD0C6";

    if( regTelp.test(no_telp.value) ){
        no_telp.style.backgroundColor = good_color;
    }else{
        no_telp.style.backgroundColor = bad_color;
    }
}

$(document).ready(function() {
  $('input[name="jenis"]').on('change', function() {
    if ($(this).val() === 'internal') {

      $('#div-internal').removeClass('d-none');
      $('#div-eksternal').addClass('d-none');

    } else if ($(this).val() === 'eksternal') {

      $('#div-internal').addClass('d-none');
      $('#div-eksternal').removeClass('d-none');;

    }
  });

  // $('#washareform').submit(function(e){
  //   console.log('Submit');
  //   e.preventDefault();
  //   $(this).unbind('submit').submit();
  //   $('.modal').hide();
  // });
});

</script>