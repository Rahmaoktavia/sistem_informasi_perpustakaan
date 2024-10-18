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
  .table-data-penerbit {
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
              <h4>DATA PENERBIT</h4>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-primary button-custom btn-tambah-penerbit float-left" data-toggle="modal" data-target="#tambahPenerbitModal">
                Tambah Penerbit
              </button>
              <table class="table table-data-penerbit" id="example">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Penerbit</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Negara</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Tautan</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Isi tabel -->
                  <?php
                  $query = "SELECT * FROM penerbit";
                  $result = $db->query($query);
                  $nomor = 1;
                  foreach ($result as $row) : ?>
                    <tr>
                      <td><?= $nomor++ ?></td>
                      <td><?= $row['nama_penerbit'] ?></td>
                      <td><?= $row['alamat_penerbit'] ?></td>
                      <td><?= $row['kota'] ?></td>
                      <td><?= $row['negara'] ?></td>
                      <td><?= $row['email_penerbit'] ?></td>
                      <td><?= $row['tlp_penerbit'] ?></td>
                      <td><?= $row['tautan'] ?></td>
                      <td>
    <div class="btn-group-vertical">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPenerbitModal<?= $row['id_penerbit'] ?>">
            Edit
        </button>
        <button type="button" class="btn btn-danger mt-2" data-toggle="modal" data-target="#hapusPenerbitModal<?= $row['id_penerbit'] ?>">
            Hapus
        </button>
    </div>
</td>

                    </tr>
                    <!-- Modal Tambah Penerbit -->
                    <div class="modal fade" id="tambahPenerbitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Penerbit</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form tambah Penerbit -->
                            <form action="http://localhost/kelompok1perpus/buku/proses-penerbit.php?proses=insert" method="post">
                              <div class="mb-3 row">
                                <label for="nama_penerbit" class="col-sm-3 col-form-label">Nama Penerbit</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="alamat_penerbit" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                  <!-- <input type="text" class="form-control" id="alamat_penerbit" name="alamat_penerbit" required> -->
                                  <textarea name="alamat_penerbit" id="alamat_penerbit" cols="10" rows="5" required></textarea >
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="kota" class="col-sm-3 col-form-label">Kota</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="kota" name="kota" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="negara" class="col-sm-3 col-form-label">Negara</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="negara" name="negara" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="email_penerbit" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="email_penerbit" name="email_penerbit" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="tlp_penerbit" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="tlp_penerbit" name="tlp_penerbit" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="tautan" class="col-sm-3 col-form-label">Tautan</label>
                                <div class="col-sm-9">
                                  <!-- <input type="text" class="form-control" id="tautan" name="tautan" required> -->
                                  <textarea name="tautan" id="tautan" cols="10" rows="5" required></textarea >
                                </div>
                              </div>

                              <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Edit Penerbit -->
                    <div class="modal fade" id="editPenerbitModal<?= $row['id_penerbit'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">EDIT DATA PENERBIT</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form Edit Penerbit -->
                            <form action="http://localhost/kelompok1perpus/buku/proses-penerbit.php?proses=update" method="post">
                              <input type="hidden" name="id_penerbit" value="<?= $row['id_penerbit'] ?>">
                              <div class="mb-3 row">
                                <label for="nama_penerbit" class="col-sm-3 col-form-label">Nama Penerbit</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="<?= $row['nama_penerbit'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="alamat_penerbit" class="col-sm-3 col-form-label">Alamat</label>
                                <div class="col-sm-9">
                                  <textarea name="alamat_penerbit" id="alamat_penerbit" cols="10" rows="5" required><?= $row['alamat_penerbit'] ?></textarea >
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="kota" class="col-sm-3 col-form-label">Kota</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="kota" name="kota" value="<?= $row['kota'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="negara" class="col-sm-3 col-form-label">Negara</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="negara" name="negara" value="<?= $row['negara'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="email_penerbit" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="email_penerbit" name="email_penerbit" value="<?= $row['email_penerbit'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="tlp_penerbit" class="col-sm-3 col-form-label">Telepon</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="tlp_penerbit" name="tlp_penerbit" value="<?= $row['tlp_penerbit'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="tautan" class="col-sm-3 col-form-label">Tautan</label>
                                <div class="col-sm-9">
                                  <textarea name="tautan" id="tautan" cols="10" rows="5" required><?= $row['tautan'] ?></textarea >
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
      <div class="modal fade" id="hapusPenerbitModal<?= $row['id_penerbit'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mx-auto">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Penerbit</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus penerbit "<?= $row['nama_penerbit'] ?>"?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <a href="http://localhost/kelompok1perpus/buku/proses-penerbit.php?proses=delete&id_penerbit=<?= $row['id_penerbit'] ?>">
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
      <!-- Form tambah Penerbit -->
      <form action="http://localhost/kelompok1perpus/buku/proses-penerbit.php?proses=insert" method="post">
        <div class="row justify-content-center">

          <div class="col-md-8 my-5 py-5 mx-auto">
            <div class="card custom-card">
              <div class="card-header">
                <h4>INPUT DATA PENERBIT</h4>
              </div>
              <div class="card-body">
                <div class="mb-3 row">
                  <label for="nama_penerbit" class="col-sm-2 col-form-label">Nama Penerbit</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="alamat_penerbit" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-5">
                    <!-- <input type="text" class="form-control" id="alamat_penerbit" name="alamat_penerbit" required> -->
                    <textarea name="alamat_penerbit" id="alamat_penerbit" cols="10" rows="5" required></textarea >
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="kota" name="kota" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="negara" class="col-sm-2 col-form-label">Negara</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="negara" name="negara" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="email_penerbit" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="email_penerbit" name="email_penerbit" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="tlp_penerbit" class="col-sm-2 col-form-label">Telepon</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="tlp_penerbit" name="tlp_penerbit" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="tautan" class="col-sm-2 col-form-label">Tautan</label>
                  <div class="col-sm-5">
                    <!-- <input type="text" class="form-control" id="tautan" name="tautan" required> -->
                    <textarea name="tautan" id="tautan" cols="10" rows="5" required><?= $row['tautan'] ?></textarea >
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
    if (isset($_GET['id_penerbit'])) {


      $id_penerbit = $_GET['id_penerbit'];
      $query = "SELECT * FROM penerbit WHERE id_penerbit='$id_penerbit'";
      $result = $db->query($query);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $nama_penerbit = $row['nama_penerbit'];
        $alamat_penerbit = $row['alamat_penerbit'];
        $kota = $row['kota'];
        $negara = $row['negara'];
        $email_penerbit = $row['email_penerbit'];
        $tlp_penerbit = $row['tlp_penerbit'];
        $tautan = $row['tautan'];
      } else {
        echo "penerbit " . $id_penerbit . "tidak ditemukan";
        exit;
      }
    } else {
      echo "Parameter tidak valid";
      exit;
    }
  ?>
    <div class="p-4 active-main-content" id="main-content">
      <!-- Form edit Penerbit -->
      <form action="http://localhost/kelompok1perpus/buku/proses-penerbit.php?proses=update" method="post">
        <div class="row justify-content-center">

          <div class="col-md-8 my-5 py-5 mx-auto">
            <div class="card custom-card">
              <div class="card-header">
                <h4>EDIT DATA PENERBIT</h4>
              </div>
              <div class="card-body">
                <div class="mb-3 row">
                  <input type="hidden" name="id_penerbit" value="<?= $row['id_penerbit'] ?>">
                  <div class="mb-3 row">
                    <label for="nama_penerbit" class="col-sm-2 col-form-label">Nama Penerbit</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit" value="<?= $nama_penerbit ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="alamat_penerbit" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-5">
                      <textarea name="alamat_penerbit" id="alamat_penerbit" cols="10" rows="5" required><?= $row['alamat_penerbit'] ?></textarea >
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="kota" class="col-sm-2 col-form-label">Kota</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="kota" name="kota" value="<?= $kota ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="negara" class="col-sm-2 col-form-label">Negara</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="negara" name="negara" value="<?= $negara ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="email_penerbit" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="email_penerbit" name="email_penerbit" value="<?= $email_penerbit ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="tlp_penerbit" class="col-sm-2 col-form-label">Telepon</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="tlp_penerbit" name="tlp_penerbit" value="<?= $tlp_penerbit ?>" required>
                    </div>
                  </div>

                  <div class="mb-3 row">
                    <label for="tautan" class="col-sm-2 col-form-label">Tautan</label>
                    <div class="col-sm-5">
                      <textarea name="tautan" id="tautan" cols="10" rows="5" required><?= $row['tautan'] ?></textarea >
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