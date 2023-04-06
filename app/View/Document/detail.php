<div class="row m-2">
    <div class="col-lg-12">
    <!-- <?= var_dump($data['share']) ?> -->
    <table style="width:120%">
        <tr>
            <td style="width:30%" class="text-black">No Dokumen</td>
            <td  class="text-primary"><?= $data['detail']['jenis'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Divisi</td>
            <td  class="text-primary"><?= $data['detail']['nama_divisi'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Type</td>
            <td  class="text-primary"><?= $data['detail']['type'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Jenis Dokumen</td>
            <td  class="text-primary"><?= $data['detail']['jenis'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Tanggal Dokumen</td>
            <td  class="text-primary"><?= $data['detail']['tanggal_surat'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">No Surat</td>
            <td  class="text-primary"><?= $data['detail']['no_surat'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Perihal</td>
            <td  class="text-primary"><?= $data['detail']['perihal'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Asal Dokumen</td>
            <td  class="text-primary"><?= $data['detail']['asal_surat'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Kepada</td>
            <td  class="text-primary"><?= $data['detail']['kepada'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Lampiran</td>
            <td  class="text-primary"><?= $data['detail']['lampiran'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Keterangan</td>
            <td  class="text-primary"><?= $data['detail']['keterangan'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Nama File</td>
            <td  class="text-primary"><?= $data['detail']['nama_file'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Ukuran File</td>
            <td  class="text-primary"><?= round($data['detail']['size']/1000000, 3) ?> Mb</td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Revisi</td>
            <td  class="text-primary"><?= $data['detail']['revisi'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Share Divisi</td>
            <td  class="text-primary">
                <div class="text-wrap w-75">
                <?php 
                    foreach ($data['share'] as $sh) {
                        echo '<span class="badge badge-dark mr-1">' . $sh['nama_divisi'] . '</span>';
                    }
                ?>
                </div>
            </td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Tanggal Upload</td>
            <td  class="text-primary"><?= $data['detail']['created_at'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">User Upload</td>
            <td  class="text-primary"><?= $data['detail']['create_by'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">Tanggal Update</td>
            <td  class="text-primary"><?= $data['detail']['updated_at'] ?></td>
        </tr>
        <tr>
            <td style="width:30%" class="text-black">User Update</td>
            <td  class="text-primary"><?= $data['detail']['update_by'] ?></td>
        </tr>
        <?php 
        $no = 1;
        $judul = '';
        foreach($data['detail_doc'] as $det): 
        if($no == 1){
            $judul = 'History Dokumen';
        } else {
            $judul = '';
        }

        $url_nama = str_replace('.pdf', '', $det['nama_file']);
        ?>
        <tr>
            <td style="width:30%" class="text-black"><?= $judul ?></td>
            <td  class="text-primary"><a href="<?= BASEURL ?>/document/viewer/<?= $url_nama ?>" class="text-danger text-decoration-none" target="_blank"><i class="fas fa-file-pdf text-danger mr-2"></i><?= $det['nama_file'] ?></a></td>
        </tr>
        <?php 
        $no++;
        endforeach; ?>
    </table>

    </div>
</div>