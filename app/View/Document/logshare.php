<div class="table-responsive">
    <table class="table table-hover" id="tbllogshare">
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
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Email / No</th>
                <th>Via</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $text = '';
        foreach ($data['logshare'] as $r) : 
        ?>
            <tr>
                <td class="judul"><?= $no++ ?></td>
                <td><?= $r['jenis'] === NULL ? '-' : $r['jenis'] ?></td>
                <td><?= $r['tanggal'] ?></td>
                <td><?= $r['nama_user'] ?></td>
                <td><?= $r['penerima'] ?></td>
                <td><?= $r['keterangan'] ?></td>
                <td><?= $r['via'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


<script>
//fungsi untuk memanggil datatable Library dengan metode Client Side PRocessing
$(document).ready(function(){

    $('#tbllogshare').DataTable({
        columnDefs: [{
            "searchable": false,
            "orderable": false,
            "targets": [6]
        }],
        "order": [0, "asc"],

        "lengthMenu": [50, 75, 100],

        dom: 'Bfrtip',
        dom: 
            "<'row mb-2'<'col-lg-6'B><'col-lg-6'f>>" +
            "<'row'<'col-lg-12'tr>>" +
            "<'row mb-3 mt-t'<'col-lg-6'i><'col-lg-6'p>>",
        buttons: [{
                extend: 'pdf',
                orientation: 'landscape',
                pageSize: 'A4',
                title: 'Data Log Share Document',
                download: 'open'
            },
            'excel', 'print', 'copy'
        ]

    });

});

</script>