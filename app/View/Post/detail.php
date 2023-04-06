<?php
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Teckindo\DokumenKontrol\Helper\FormatTanggal;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>

    <style>
        /* * {
            border: 1px solid red;
        } */

        body {
            background: white;
        }

        @font-face {
            font-family: "Font Digital";
            src: url('font/fontscorecomttwcenmt.ttf');
        }

        page[size="A4"] {
        background: white;
        width: 21cm;
        height: 30cm;
        display: block;
        margin: 0 auto;
        }

        @media print {
        body, page[size="A4"] {
            margin: 0;
            box-shadow: 0;
        }
        }

        .container {
            padding: 15px;
        }

        .kopsurat {
            display: flex;
            justify-content:space-between;
            align-items: center;
        }

        img.logo {
            width: 15rem;
            opacity: .5;
        }
        
        img.qrcode {
            width: 5rem;
            margin-right: 10px;
            opacity: .5;
        }

        img.approval_ttd {
            width: 8rem;
            /* border: solid 1px black; */
        }

        .info-perusahaan {
            text-align: right;
            padding: 0;
            margin: 0;
            opacity: .7;
            font-family:'Font Digital', Courier, monospace;
        }

        ul>li {
            list-style: none;
            font-family: 'Times New Roman', Times, serif;
        }

        li.nama-pt {
            font-size: 10pt;
            font-weight: 800;           
        }

        li.keterangan {
            font-weight: 100;
            font-size: 9pt;
        }

        .content {
            margin-top: 120px;
            padding-left: 50px;
            padding-right: 50px;
            font-size: 12pt;
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.5;
        }
        
        .salam {
            margin-top: 20px;
        }

        .isisurat {
            text-align: justify;
            margin-top: 20px;
        }

        .ttd {
            margin-top: 60px;
        }

        .ttd table td {
            text-align: center;
        }

        .ttd table tr.paraf {
            height: 50px;
        }

        .logo-pt {
            height: 50px;
        }

        img {
            max-height: 100%;
        }
    </style>

</head>
<body id="printbody">
    
<page size="A4">
    <div class="container">

        <div class="kopsurat">
            <div class="logo-pt">
                <img src="<?= BASEURL ?>/img/header/<?= $data['surat']['logo'] ?>" alt="logo" class="logo">
            </div>
            <div class="info-perusahaan">
                <ul>
                    <li class="nama-pt"><?= $data['surat']['nama_perusahaan'] ?></li>
                    <li class="keterangan">Kawasan Pergudangan & Industri Balajaya Mas (Bajamas)</li>
                    <li class="keterangan">Jl. Raya Serang Km. 24 Talagasari, Balaraja</li>
                    <li class="keterangan">Tangerang, 15610 Banten</li>
                    <li class="keterangan">Telp : +62 21 5945 0999, 5945 0009 (hunting)</li>
                </ul>
            </div>
            <?php
            
            $options = new QROptions(
                [
                    'eccLevel' => QRCode::ECC_L,
                    'outputType' => QRCode::OUTPUT_MARKUP_SVG,
                    'version' => 5,
                ]
                );
        
                $qrcode = (new QRCode($options))->render(BASEURL . '/postdocument/detail/' . $data['surat']['no_surat']);
            
            ?>
            <img src="<?= $qrcode ?>" alt="logo" class="qrcode">
            <!-- <img src="<?= BASEURL ?>/img/qrcode/qrcode.png" alt="logo" class="qrcode"> -->
        </div>

        <div class="content">

            <div class="tanggal">
                <p><?= $data['surat']['lokasi'] ?>, <?=  FormatTanggal::tanggal_indo(date('Y-m-d',strtotime($data['surat']['tanggal_surat']))) ?></p>
            </div>

            <div class="nosurat">
                <table>
                    <tr>
                        <td style="width:150px;">No Surat</td>
                        <td style="width:20px;">:</td>
                        <td><?= $data['surat']['no_surat'] ?></td>
                    </tr>
                    <?php 
                    if(empty($data['lampiran'])) { ?>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>-</td>
                    </tr>
                    <?php } else { 
                        $no = 1;
                        foreach ($data['lampiran'] as $l): ?>
                        <tr>
                            <td><?= $no == 1 ? 'Lampiran' : '' ?></td>
                            <td><?= $no == 1 ? ':' : '' ?></td>
                            <td><?= $no ?>. <?= $l['nama_lampiran'] ?></td>
                        </tr>
                    <?php 
                        $no++;
                        endforeach;
                    } ?>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td><?= $data['surat']['perihal'] ?></td>
                    </tr>
                </table>
            </div>

            <div class="salam">
                <p><?= $data['surat']['salam'] ?></p>
            </div>

            <div class="isisurat">
                <?= $data['surat']['isi_surat'] ?>
            </div>

            <div class="ttd">
                <table>
                    <tr>
                        <td>Hormat Saya</td>
                    </tr>
                    <tr class="paraf">
                        <td>
                            <?php 
                            if(! empty($data['surat']['approval_ttd'])){ ?>
                                <img src="data:image/png;base64,<?= base64_encode($data['surat']['approval_ttd']); ?>" alt="ttd" class="approval_ttd">
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;   ">( <?= $data['surat']['nama_user'] ?> )<br>HRD</td>
                    </tr>
                </table>              
            </div>
        </div>



    </div>

</page>

<script>
    window.print()
</script>

</body>

</html>