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

  /* Gaya untuk tabel data buku */
  .table-data-pengarang {
    margin-top: 20px;
    /* Sesuaikan dengan kebutuhan Anda */
  }

  .modal-dialog-centered {
    margin-top: 5rem !important;
    /* Sesuaikan dengan kebutuhan Anda */
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
              <h4>DATA PENGARANG</h4>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary button-custom btn-tambah-pengarang float-left" data-toggle="modal" data-target="#tambahPengarangModal">
                Tambah Pengarang
              </button>
              <table class="table table-data-pengarang" id="example">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Pengarang</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Referensi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Isi tabel -->
                  <?php
                  $query = "SELECT * FROM pengarang";
                  $result = $db->query($query);
                  $nomor = 1;
                  foreach ($result as $row) : ?>
                    <tr>
                      <td><?= $nomor++ ?></td>
                      <td><?= $row['nama_pengarang'] ?></td>
                      <td><?= $row['tgl_lahir'] ?></td>
                      <td><?= $row['alamat'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= $row['telepon'] ?></td>
                      <td><?= $row['referensi'] ?></td>
                      <td>
    <div class="btn-group-vertical">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPengarangModal<?= $row['id_pengarang'] ?>">
            Edit
        </button>
        <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#hapusPengarangModal<?= $row['id_pengarang'] ?>">
            Hapus
        </button>
    </div>
</td>

                    </tr>
                    <!-- Modal Tambah Pengarang -->
                    <div class="modal fade" id="tambahPengarangModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Pengarang</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form tambah Pengarang -->
                            <form action="http://localhost/kelompok1perpus/buku/proses-pengarang.php?proses=insert" method="post">
                              <div class="mb-3 row">
                                <label for="nama_pengarang" class="col-sm-3 col-form-label">Nama Pengarang</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                  <!-- <input type="text" class="form-control" id="alamat" name="alamat" required> -->
                                  <textarea name="alamat" id="alamat" cols="10" rows="5" required></textarea>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="email" name="email" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="telepon" name="telepon" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="referensi" class="col-sm-3 col-form-label">Referensi</label>
                                <div class="col-sm-9">
                                  <!-- <input type="text" class="form-control" id="referensi" name="referensi" required> -->
                                  <textarea name="referensi" id="referensi" cols="10" rows="5" required></textarea>
                                </div>
                              </div>
                              <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Edit Pengarang -->
                    <div class="modal fade" id="editPengarangModal<?= $row['id_pengarang'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">EDIT DATA PENGARANG</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form Edit Pengarang -->
                            <form action="http://localhost/kelompok1perpus/buku/proses-pengarang.php?proses=update" method="post">
                              <input type="hidden" name="id_pengarang" value="<?= $row['id_pengarang'] ?>">
                              <div class="mb-3 row">
                                <label for="nama_pengarang" class="col-sm-3 col-form-label">Nama Pengarang</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" value="<?= $row['nama_pengarang'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="tgl_lahir" class="col-sm-3 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-9">
                                  <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $row['tgl_lahir'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                  <textarea name="alamat" id="alamat" cols="10" rows="5" required><?= $row['alamat'] ?></textarea>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="email" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="email" name="email" value="<?= $row['email'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="telepon" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $row['telepon'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="referensi" class="col-sm-3 col-form-label">Referensi</label>
                                <div class="col-sm-9">
                                  <textarea name="referensi" id="alamat" cols="10" rows="5" required><?= $row['referensi'] ?></textarea>
                                </div>
                              </div>

                              <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Modal Hapus Pengarang -->
    <?php foreach ($result as $row) : ?>
      <div class="modal fade" id="hapusPengarangModal<?= $row['id_pengarang'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mx-auto">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Pengarang</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus pengarang "<?= $row['nama_pengarang'] ?>"?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <a href="http://localhost/kelompok1perpus/buku/proses-pengarang.php?proses=delete&id_pengarang=<?= $row['id_pengarang'] ?>">
                <button type="button" class="btn btn-danger">Hapus</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

    <script>
      $(document).ready(function() {
        $('#example').DataTable({
          "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ],
          "pageLength": 10
        });
      });
    </script>
  <?php
    break;

  case 'input': ?>
    <div class="p-4 active-main-content" id="main-content">
      <!-- Form tambah Pengarang -->
      <form action="http://localhost/kelompok1perpus/buku/proses-pengarang.php?proses=insert" method="post">
        <div class="row justify-content-center">

          <div class="col-md-8 my-5 py-5 mx-auto">
            <div class="card custom-card">
              <div class="card-header">
                <h4>INPUT DATA PENGARANG</h4>
              </div>
              <div class="card-body">
                <div class="mb-3 row">
                  <label for="nama_pengarang" class="col-sm-2 col-form-label">Nama Pengarang</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                  <div class="col-sm-5">
                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-5">
                    <!-- <input type="text" class="form-control" id="alamat" name="alamat" required> -->
                    <textarea name="alamat" id="alamat" cols="10" rows="5" required></textarea>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="email" name="email" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="telepon" name="telepon" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="referensi" class="col-sm-2 col-form-label">Referensi</label>
                  <div class="col-sm-5">
                    <!-- <input type="text" class="form-control" id="referensi" name="referensi" required> -->
                    <textarea name="referensi" id="referensi" cols="10" rows="5" required></textarea>
                  </div>
                </div>

                <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit
                </button>
              </div>
            </div>
      </form>
    </div>
  <?php
    break;
  case 'edit':
    if (isset($_GET['id_pengarang'])) {


      $id_pengarang = $_GET['id_pengarang'];
      $query = "SELECT * FROM pengarang WHERE id_pengarang='$id_pengarang'";
      $result = $db->query($query);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama_pengarang = $row['nama_pengarang'];
        $tgl_lahir = $row['tgl_lahir'];
        $alamat = $row['alamat'];
        $email = $row['email'];
        $telepon = $row['telepon'];
        $referensi = $row['referensi'];
      } else {
        echo "pengarang " . $id_pengarang . "tidak ditemukan";
        exit;
      }
    } else {
      echo "Parameter tidak valid";
      exit;
    }
  ?>
    <div class="p-4 active-main-content" id="main-content">
      <!-- Form Edit Pengarang -->
      <form action="http://localhost/kelompok1perpus/buku/proses-pengarang.php?proses=update" method="post">
        <div class="row justify-content-center">

          <div class="col-md-8 my-5 py-5 mx-auto">
            <div class="card custom-card">
              <div class="card-header">
                <h4>EDIT DATA PENGARANG</h4>
              </div>
              <div class="card-body">
                <div class="mb-3 row">
                  <input type="hidden" name="id_pengarang" value="<?= $row['id_pengarang'] ?>">
                  <div class="mb-3 row">
                    <label for="nama_pengarang" class="col-sm-2 col-form-label">Nama Pengarang</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="nama_pengarang" name="nama_pengarang" value="<?= $nama_pengarang ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="tgl_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-5">
                      <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $tgl_lahir ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                      <textarea name="alamat" id="alamat" cols="10" rows="5" required><?= $row['alamat'] ?></textarea>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="email" name="email" value="<?= $email ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $telepon ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="referensi" class="col-sm-2 col-form-label">Referensi</label>
                    <div class="col-sm-5">
                      <textarea name="referensi" id="referensi" cols="10" rows="5" required><?= $row['referensi'] ?></textarea>
                    </div>
                  </div>


                  <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit
                  </button>
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