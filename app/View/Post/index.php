<?php

use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Post Dokumen</h1>
    
    <div class="row">
        <div class="col-lg-12">


            <div class="card mb-2">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-dark">All Post Document</h6>
                    <div class="d-inline">
                        <a href="<?= BASEURL ?>/postdocument/add" class="btn btn-primary text-right"><i class="fas fa-pen-alt"></i></a>
                        <a href="" class="btn btn-warning text-right"><i class="fas fa-sync-alt"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-8">
                        <?php Flasher::flash(); ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" id="tblpost">
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
                                    <th>No Surat</th>
                                    <th>Perihal</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Arsip</th>
                                    <th>Lampiran</th>
                                    <th>Kop Surat</th>
                                    <th>Create at</th>
                                    <th class="judul"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $text = '';
                            foreach ($data['post'] as $r) : 
                                $color =  $r['arsip'] == 1 ? 'success' : 'danger';
                            ?>
                                <tr>
                                    <td class="judul"><?= $no++ ?></td>
                                    <td><?= $r['no_surat'] ?></td>
                                    <td><?= $r['perihal'] ?></td>
                                    <td><?= $r['tanggal_surat'] ?></td>
                                    <td><?= $r['status'] ?></td>
                                    <td><span class="badge badge-pill badge-<?= $color ?>"><?= $r['arsip'] == 1 ? 'Archieved' : 'Not yet' ?></span></td>
                                    <td>
                                        <?php
                                        foreach ($data['lampiran'] as $lp):
                                            if($r['no_surat'] == $lp['no_surat']){
                                                echo $lp['nama_lampiran'];
                                                echo '<br>';
                                            }
                                        endforeach;
                                        ?>
                                    </td>
                                    <td><?= $r['nama_perusahaan'] ?></td>
                                    <td><?= $r['create_at'] ?></td>
                                    <td class="judul">
                                        <a href="<?= BASEURL ?>/postdocument/detail/<?= $r['no_surat'] ?>" class="btn btn-dark btn-sm" target="_blank"><i class="fas fa-print"></i></a>
                                        <!-- <a href="<?= BASEURL ?>/postdocument/archive/<?= $r['no_surat'] ?>" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-archive"></i></a> -->
                                        <a href="<?= BASEURL ?>/postdocument/edit/<?= $r['no_surat'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                        <form action="<?= BASEURL ?>/postdocument" method="POST" class="d-inline">
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
