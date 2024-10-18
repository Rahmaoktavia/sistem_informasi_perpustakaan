<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-wvfXpqpZZVQl3u03N7mR6J04lO39jccz5l5fNs4Z9HAZJ7eZbOWF6wY1X6cZ56d5" crossorigin="anonymous">

<!-- Feather Icons -->
<link rel="stylesheet" href="https://unpkg.com/feather-icons/dist/feather.min.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

<style>
    .list-card {
        background-color: #ffffff;
    }
    footer {
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3); /* You can adjust the values for your desired shadow effect */
    z-index: 2; /* Ensure the footer appears above other elements */
}
    .card.custom-card {
        background-color: #ffffff;
    }

    .form-column {
        background-color: #eeebe3;
    }

    #main-content {
        margin-top: 80px; /* Sesuaikan dengan tinggi navbar Anda */
        padding: 20px; /* Sesuaikan sesuai kebutuhan Anda */
    }

    /* Gaya untuk tombol "Tambah Buku" */
    .btn-tambah-buku {
        background-color: #eeebe3;
        color: #333;
        width: 100px;
        margin-right: 10px;
        margin-left: 10px;
    }

    /* Gaya untuk tabel data buku */
    .table-data-buku {
        margin-top: 20px; /* Sesuaikan dengan kebutuhan Anda */
    }
</style>

<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';

switch ($aksi) {
    case 'list':
?>
        <!-- MAIN CONTENT-->
        <div class="p-4 active-main-content" id="main-content">
            <div class="row">
                <!-- Kolom Formulir -->
                <div class="col-sm-12">
                    <div class="card custom-card">
                        <div class="card-header">
                            <h4>DATA KATEGORI</h4>
                        </div>
                        <div class="card-body">
                            <button type="button" class="btn btn-primary button-custom btn-tambah-kategori float-left" data-toggle="modal" data-target="#tambahKategoriModal">
                                Tambah Kategori
                            </button>

                            <table class="table table-data-kategori" id="example">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Kategori</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Isi tabel -->
                                    <?php
                                    $query = "SELECT * FROM categories";
                                    $result = $db->query($query);
                                    $nomor = 1;
                                    foreach ($result as $row) :
                                    ?>
                                        <tr>
                                            <td><?= $nomor++ ?></td>
                                            <td><?= $row['nama_kategori'] ?></td>
                                            <td><?= $row['keterangan'] ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editKategoriModal<?= $row['id_kategori'] ?>">
                                                    Edit
                                                </button>
                                                <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#hapusKategoriModal<?= $row['id_kategori'] ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal Tambah Kategori -->
                                        <div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered mx-auto">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form tambah kategori -->
                                                        <form action="http://localhost/kelompok1perpus/buku/proses-kategori.php?proses=insert" method="post">
                                                            <div class="mb-3 row">
                                                                <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                                                <div class="col-sm-9">
                                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required></textarea>
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Edit Kategori -->
                                        <div class="modal fade" id="editKategoriModal<?= $row['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered mx-auto">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">EDIT DATA KATEGORI</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Form edit kategori -->
                                                        <form action="http://localhost/kelompok1perpus/buku/proses-kategori.php?proses=update" method="post">
                                                            <div class="mb-3 row">
                                                                <input type="hidden" name="id_kategori" value="<?= $row['id_kategori'] ?>">
                                                                <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                                                                <div class="col-sm-9">
                                                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $row['nama_kategori'] ?>" required>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3 row">
                                                                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                                                <div class="col-sm-9">
                                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?= $row['keterangan'] ?></textarea>
                                                                </div>
                                                            </div>

                                                            <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Modal Hapus Kategori -->
        <?php foreach ($result as $row) : ?>
            <div class="modal fade" id="hapusKategoriModal<?= $row['id_kategori'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered mx-auto">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Kategori</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Apakah Anda yakin ingin menghapus kategori dengan nama kategori "<?= $row['nama_kategori'] ?>" maka akan menghapus buku dengan kategori tersebut ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <a href="http://localhost/kelompok1perpus/buku/proses-kategori.php?proses=delete&id_kategori=<?= $row['id_kategori'] ?>">
                                <button type="button" class="btn btn-danger">Hapus</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "pageLength": 10
                });
            });
        </script>
<?php
        break;

    case 'input':
?>
        <!-- Form tambah buku -->
        <div class="p-4 active-main-content" id="main-content">
            <form action="http://localhost/kelompok1perpus/buku/proses-kategori.php?proses=insert" method="post">
                <div class="row justify-content-center mx-auto">
                    <div class="col-md-8 my-5 py-5 mx-auto">
                        <div class="card custom-card">
                            <div class="card-header">
                                <h4>INPUT DATA KATEGORI</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<?php
        break;

    case 'edit':
        if (isset($_GET['id_kategori'])) {
            $id_kategori = $_GET['id_kategori'];
            $query = "SELECT * FROM categories WHERE id_kategori='$id_kategori'";
            $result = $db->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $nama_kategori = $row['nama_kategori'];
                $keterangan = $row['keterangan'];
            } else {
                echo "Data Kategori " . $id_kategori . "tidak ditemukan";
                exit;
            }
        } else {
            echo "Parameter tidak valid";
            exit;
        }
?>
        <!-- Form edit kategori -->
        <div class="p-4 active-main-content" id="main-content">
            <form action="http://localhost/kelompok1perpus/buku/proses-kategori.php?proses=update" method="post">
                <div class="row justify-content-center mx-auto">
                    <div class="col-md-8 my-5 py-5 mx-auto">
                        <div class="card custom-card">
                            <div class="card-header">
                                <h4>EDIT DATA KATEGORI</h4>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    <input type="hidden" name="id_kategori" value="<?= $row['id_kategori'] ?>">
                                    <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?= $nama_kategori ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="5" required><?= $keterangan ?></textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
<?php
        break;
}
?>
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