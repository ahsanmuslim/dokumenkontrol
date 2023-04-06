<?php

use Teckindo\DokumenKontrol\Helper\Flasher;
use Teckindo\DokumenKontrol\Services\Security;

$csrftoken = Security::csrfToken();

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h4 mb-4 text-gray-800">Menu Management</h1>
    
    <div class="row">
        <div class="col-lg-12">


            <div class="card mb-2">
                <div class="card-header d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Data Controller</h6>
                    <div class="d-inline">
                        <a href="<?= BASEURL ?>/controller/add" class="btn btn-dark text-right"><i class="fas fa-plus"></i></a>
                        <a href="<?= BASEURL ?>/controller" class="btn btn-warning text-right"><i class="fas fa-sync-alt"></i></a>
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
                                    <th>Title Menu</th>
                                    <th>Controller</th>
                                    <th>Icon</th>
                                    <th>Sidemenu</th>
                                    <th>Status</th>
                                    <th class="judul"><i class="fas fa-cog"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $no = 1;
                            $text = '';
                            foreach ($data['allmenu'] as $r) : 
                            ?>
                                <tr>
                                    <td class="judul"><?= $no++ ?></td>
                                    <td><?= $r['title'] ?></td>
                                    <td><?= $r['url'] ?></td>
                                    <td><?= $r['icon'] ?></td>
                                    <td><?= ($r['is_menu'] == 1) ? "Ya" : "Tidak" ?></td>
                                    <td><?= ($r['is_active'] == 1) ? "Aktif" : "Tidak Aktif" ?></td>
                                    <td class="judul">
                                        <a href="<?= BASEURL ?>/controller/edit/<?= $r['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-fw fa-pen"></i></a>
                                        <form action="<?= BASEURL ?>/controller" method="POST" class="d-inline">
                                            <input type="hidden" value="DELETE" name="_method">
                                            <input type="hidden" value="<?= $csrftoken ?>" name="csrftoken">
                                            <input type="hidden" value="<?= $r['id']; ?>" name="id">
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