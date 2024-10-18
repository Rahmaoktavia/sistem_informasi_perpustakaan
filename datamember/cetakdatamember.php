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
            <h4 class="title">LAPORAN DATA MEMBER</h4>
        </header>
        <section>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Member</th>
                                <th scope="col">NIP/NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Status</th>
                                <th scope="col">Level</th>
                                <th scope="col">Prodi</th>
                                <th scope="col">Email</th>
                                <th scope="col">No Telepon</th>
                                <th scope="col">Tanggal Terdaftar</th>
                                <th scope="col">Tanggal Akhir Member</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM member JOIN prodi ON member.prodi_id = prodi.id_prodi";
                        $result = $c->query($query);

                        $i = 1;

                        while ($p = mysqli_fetch_array($result)) {
                            $id_member = $p['id_member'];
                            $nim = $p['nim'];
                            $nama = $p['nama'];
                            $jenis_kelamin = $p['jenis_kelamin'];
                            $status = $p['status'];
                            $level = $p['level'];
                            $nama_prodi = $p['nama_prodi'];
                            $email = $p['email'];
                            $no_tlp = $p['no_tlp'];
                            $tgl_daftar = $p['tgl_daftar'];
                            $tgl_berakhir = $p['tgl_berakhir'];
                            ?>
                            <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $id_member; ?></td>
                                    <td><?= $nim; ?></td>
                                    <td><?= $nama; ?></td>
                                    <td><?= $jenis_kelamin; ?></td>
                                    <td><?= $status; ?></td>
                                    <td><?= $level; ?></td>
                                    <td><?= $nama_prodi; ?></td>
                                    <td><?= $email; ?></td>
                                    <td><?= $no_tlp; ?></td>
                                    <td><?= $tgl_daftar; ?></td>
                                    <td><?= $tgl_berakhir; ?></td>
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