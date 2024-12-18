<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$title?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 20px;
    }

    .header {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin-bottom: 10px;
    }

    .header img {
        width: 70px;
        /* Atur ukuran logo */
        margin-right: 10px;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
    }

    .header p {
        margin: 0;
        font-size: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th,
    table td {
        border: 1px solid black;
        padding: 5px;
        text-align: center;
        font-size: 12px;
    }

    table th {
        background-color: #f2f2f2;
    }

    .footer {
        font-size: 12px;
        margin-top: 10px;
        text-align: left;
        font-style: italic;
    }

    @media print {
        body {
            margin: 0;
            padding: 0;
        }
    }
    </style>

    <!-- Auto Print Script -->
    <script>
    window.onload = function() {
        window.print();
    };
    </script>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <!-- Logo -->
        <img src="<?=base_url('assets/img/logo-sni.png')?>" alt="Logo Perusahaan">
        <div>
            <h1>PT. Sinergra Nusantara Indonesia</h1>
            <p>Jl. Dirgantara IX No. 5 Bumi Asri Cijahe Telp. 022-6124933 Bandung - Jawa Barat</p>
            <p><i>Your Preferred Water Waste Solution</i></p>
        </div>
    </div>

    <hr>
    <h3 style="text-align: center;">TANDA TERIMA DOKUMEN MANIFEST</h3>
    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>TGL</th>
                <th>NO. MANIFEST</th>
                <th>TRANSPORTER</th>
                <th>PERUSAHAAN PENGHASIL</th>
            </tr>
        </thead>
        <tbody>
            <?php
$no = 1;
foreach ($surat_masuk as $row) {?>
            <tr>
                <td><?=$no++?></td>
                <td><?=$row->tgl?></td>
                <td><?=$row->no_manifest?></td>
                <td><?=$row->transporter?></td>
                <td><?=$row->perusahaan_penghasil?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>

</body>

</html>