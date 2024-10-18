<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Registrasi Siperpus</title>

    <!-- Icons font CSS-->
    <link href="../assets/vendor/mdi-font/css/material-design-iconic-font.min.css" media="all">
    <link href="../assets/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../assets/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../assets/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../assets/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-03 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
            <?php
            if (isset($_SESSION['error'])) {
            ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $_SESSION['error'] ?>
                </div>
            <?php
            }
            ?>
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['message'] ?>
                </div>
            <?php
            }
            ?>
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title"> Registrasi </h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses-registrasi.php">

                        <!-- Input Nama -->
                        <div class="form-row">
                            <div class="name">Nama Lengkap</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="text" name="nama" required>
                                </div>
                            </div>
                        </div>
                        <!-- Input NIP/NIM -->
                        <div class="form-row">
                            <div class="name">NIP/NIM</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="nim" required>
                                </div>
                            </div>
                        </div>
                        <!-- Input jenis kelamin -->
                        <div class="form-row">
                            <div class="name">Jenis Kelamin</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="jenis_kelamin" required>
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="laki-laki">Laki - Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Input Status -->
                        <div class="form-row">
                            <div class="name">Status</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="status" required>
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="mahasiswa">Mahasiswa</option>
                                            <option value="dosen">Dosen</option>
                                            <option value="tendik">Tendik</option>
                                            <option value="admpustakawan">Admin/Pustakawan</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Input Level -->
                        <div class="form-row">
                            <div class="name">Level</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="level" required>
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option value="admin">Admin</option>
                                            <option value="pustakawan">Pustakawan</option>
                                            <option value="anggota">Member</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Input Prodi -->
                        <div class="form-row">
                            <div class="name">Prodi</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="prodi_id" required>
                                            <option disabled="disabled" selected="selected">Choose option</option>
                                            <option>-</option>
                                            <option>-</option>
                                            <option>-</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Input no_tlpl -->
                        <div class="form-row">
                            <div class="name">No Telepon</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="number" name="no_tlp">
                                </div>
                            </div>
                        </div>
                        <!-- Input email -->
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        <!-- Input password -->
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password" required>
                                </div>
                            </div>
                        </div>
                        <!-- Input tgl_daftar -->
                        <div class="form-row">
                            <div class="name" hidden>Tanggal Daftar</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="tgl_daftar" hidden>
                                </div>
                            </div>
                        </div>
                        <!-- Input tgl_berakhir -->
                        <div class="form-row">
                            <div class="name" hidden>Tanggal Berakhir</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="date" name="tgl_berakhir" hidden>
                                </div>
                            </div>
                        </div>


                        <div>
                            <button class="btn btn--radius-2 btn--blue" type="submit" style="margin-left: 28rem;">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../assets/vendor/select2/select2.min.js"></script>
    <script src="../assets/vendor/datepicker/moment.min.js"></script>
    <script src="../assets/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../assets/js/global.js"></script>

    <?php
    session_destroy();
    ?>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->