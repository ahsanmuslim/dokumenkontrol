<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Share Dokumen</h1>
    
    <div class="row">
        <div class="col-lg-12">


            <div class="card mb-2">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <?php if(isset($data['judul'])){ ?>
                        <h6 class="m-0 font-weight-bold text-dark">Dokumen : <span class="text-warning"><?= $data['judul']['jenis'] ?></span></h6>
                    <?php } else { ?>
                        <h6 class="m-0 font-weight-bold text-dark">All Share Document</h6>
                    <?php } ?>
                    <div class="d-inline">
                        <a href="" class="btn btn-warning text-right"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
                <div class="card-body">
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
                                    <th>Dari Divisi</th>
                                    <th>No Surat</th>
                                    <th>Jenis Surat</th>
                                    <th>Asal Surat</th>
                                    <th>Tanggal</th>
                                    <th>Perihal</th>
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
                                    <td><?= $r['jenis'] ?></td>
                                    <td><?= $r['asal_surat'] ?></td>
                                    <td><?= $r['tanggal_surat'] ?></td>
                                    <td><?= $r['perihal'] ?></td>
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
