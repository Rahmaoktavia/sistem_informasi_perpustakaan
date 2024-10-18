<?php
$c = mysqli_connect('localhost', 'root', '', 'db_perpustakaan');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/atlantis.min.css">

    <style>
        body {
            font-size: 14px;
            color: #333;
        }

        #content {
            margin: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .table-bordered {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
        }

        .table-bordered th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .print-btn {
            text-align: center;
            margin-top: 20px;
        }

        .print-btn button {
            display: block;
            margin: 0 auto;
        }

        @media print {
            .print-btn {
                display: none !important;
            }
        }

        .signature {
            text-align: right;
            margin-top: 20px;
        }

        #signature-canvas {
            border: 1px solid #000;
        }

        .signature-text {
            text-align: right;
            margin-top: 20px; /* Sesuaikan margin top sesuai kebutuhan */
        }

    </style>
</head>

<body>
    <div id="content">
        <header>
            <img src="../logo/kop.jpg" alt="Header Image">
            <h4 class="title">LAPORAN DATA BUKU TAMU</h4>
        </header>
        <section>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tanggal kunjungan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM buku_tamu";
                        $result = $c->query($query);

                        $i = 1;

                        while ($p = mysqli_fetch_array($result)) {
                            $nama = $p['nama'];
                            $tgl_kunjungan = $p['tgl_kunjungan'];
                            ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $nama; ?></td>
                                <td><?= $tgl_kunjungan; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <form id="signature-form" class="signature">
            <?php
            // Mendapatkan tanggal saat ini
            $tanggal_sekarang = date("d F Y");

            // Menampilkan tanggal di HTML
            echo '<label for="signature" style="margin-bottom: 50px;">Padang, ' . $tanggal_sekarang . '</label>';
            ?>
            <div class="col-12">
                <canvas id="signature-canvas" width="300" height="100"></canvas>
                <div class="signature-text">
                    <br>
                    <label for="signature">Admin atau Pustakawan</label>
                    <br>
                    <label for="signature">ID User</label>
                </div>
            </div>
        </form>
    </div>
</div>

            <script>
                window.print()
            </script>
        </section>
    </div>
</body>

</html>