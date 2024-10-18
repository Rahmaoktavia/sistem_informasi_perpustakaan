<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-wvfXpqpZZVQl3u03N7mR6J04lO39jccz5l5fNs4Z9HAZJ7eZbOWF6wY1X6cZ56d5" crossorigin="anonymous">

    <!-- Feather Icons -->
    <link rel="stylesheet" href="https://unpkg.com/feather-icons/dist/feather.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link href="path/to/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha384-GLhlTQ8iKu1rHNve6Zl/FQF1fQIXJpFOvZeZEeDbEm5uHvHA5G1t4E76dUHM9L"
        crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="path/to/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <style>
        .list-card {
            background-color: #ffffff;
        }

        .card.custom-card {
            background-color: #ffffff;
        }

        .form-column {
            background-color: #eeebe3;
        }

        #main-content {
            margin-top: 80px;
            /* Sesuaikan dengan tinggi navbar Anda */
            padding: 20px;
            /* Sesuaikan sesuai kebutuhan Anda */
        }

        /* Gaya untuk tombol "Tambah Buku" */
        .btn-tambah-buku {
            background-color: #eeebe3;
            color: #333;
            width: 100px;
            margin-right: 10px;
            margin-left: 10px;
        }

        /* Gaya untuk tombol icon cetak */
        .btn-cetak {
            background-color: #007bff;
            color: #ffffff;
            margin-right: 10px;
            margin-left: 5px; /* Perubahan di sini */
            transition: background-color 0.3s ease-in-out;
        }

        /* Change color on hover or focus */
        .btn-cetak:hover,
        .btn-cetak:focus {
            background-color: #007bff;
        }

        /* Gaya untuk tabel data buku */
        .table-data-buku_tamu {
            margin-top: 20px;
            /* Sesuaikan dengan kebutuhan Anda */
        }

        .modal-dialog-centered {
            margin-top: 5rem !important;
            /* Sesuaikan dengan kebutuhan Anda */
        }
    </style>
</head>

<body>

    <?php include 'koneksi.php'; ?>

    <!-- MAIN CONTENT -->
    <div class="p-4 active-main-content" id="main-content">
        <div class="row">
            <!-- Kolom Formulir -->
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="text-center">
                            <h4>BUKU TAMU</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <button type="button"
                                    class="btn btn-primary button-custom btn-tambah-buku_tamu float-left"
                                    data-toggle="modal" data-target="#tambahBukuTamuModal">
                                    Tambah Kunjungan
                                </button>
                                
                                    <a href="http://localhost/kelompok1perpus/kunjungan/cetakbukutamu.php" class="btn btn-primary text-light ms-2" style="margin-left: 5px;">
                                        <i class="fas fa-print"></i> 
                                    </a>
                                <!-- <button class="btn btn-primary btn-sm mb-2 btn-cetak" 
                                    data-target="#cetak">
                                    <form action='http://localhost/kelompok1perpus/kunjungan/cetakbukutamu.php' method="post">
                                    <i class="fas fa-print"></i>
                                </button> -->
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-data-buku_tamu" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tanggal kunjungan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Isi tabel -->
                                    <?php
                                    $nomor = 1;
                                    $query = mysqli_query($db, "SELECT * FROM buku_tamu ORDER BY buku_tamu.id");

                                    while ($row = mysqli_fetch_array($query)) : ?>
                                    <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['tgl_kunjungan'] ?></td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Awal Modal Tambah Buku tamu -->
                        <div class="modal fade" id="tambahBukuTamuModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Buku tamu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form tambah user -->
                                        <form
                                            action="http://localhost/kelompok1perpus/kunjungan/proses-bukutamu.php"
                                            method="post">
                                            <div class="mb-3 row">
                                                <label for="nama" class="col-sm-2 col-form-label">Nama </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="nama" name="nama"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                    class="btn btn-primary button-custom float-left"
                                                    style="width: 100px; margin-right: 10px; margin-left: 10px;"
                                                    name="simpanBukuTamu">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal Tambah Buku tamu -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTables Initialization -->
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "pageLength": 10,
                "dom": '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>tp',
            });
        });
    </script>
</body>

</html>
<!--====== FOOTER PART START ======-->
<footer class="bg-steelblue text-white p-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>PERPUSTAKAAN</h5>
        <address style="color: black; display: block;">
          Jl.Kampus Politeknik Negeri Padang<br>
          Limau Manis, Kecamatan Pauh Kota Padang<br>
          Provinsi Sumatera Barat<br>
          25164<br>
          <strong>Telepon:</strong> 0751865<br>
          <strong>Email:</strong> perpustakaan@pnp.ac.id
        </address>
      </div>
      <div class="col-md-4">
        <h5 style="color: black;">Tim Kami</h5>
        <ul class="list-unstyled" style="color: black;">
          <li>Rahma Oktavia</li>
          <p>NIM: 2201091011</p>
          <li>Gitta Hutari Dewinzha</li>
          <p>NIM: 2201092009 </p>
          <li>Orry Frasetyo</li>
          <p>NIM:2201092025 </p>
          <li>Yuni Sartika</li>
          <p>NIM: 2201092056 </p>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Lokasi Kami</h5>
        <!-- Embed Google Maps -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3100492018316!2d100.46357607424709!3d-0.9145625353313178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b7be9e52a171%3A0x609ef1cc57a38e32!2sPoliteknik%20Negeri%20Padang!5e0!3m2!1sen!2sid!4v1704787825452!5m2!1sen!2sid" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p>Temukan kami di peta di atas.</p>
      </div>
    </div>
    <hr class="bg-light">
    <p class="text-center mb-0">&copy; 2024 Perpustakaan@pnp.ac.id </p>
  </div>
</footer>



<!--====== FOOTER PART ENDS ======-->
