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
  .table-data-buku {
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
              <h4>DATA BUKU</h4>
            </div>
            <div class="card-body">
              <!-- Tombol "Tambah Buku" -->
              <button type="button" class="btn btn-primary button-custom btn-tambah-books float-left" data-toggle="modal" data-target="#tambahBukuModal">
                Tambah Buku
              </button>
              </a>
              <table class="table table-data-buku" id="example">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Sampul</th>
                    <th scope="col">Kode ISBN</th>
                    <th scope="col">Kode Buku</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Buku Tersedia</th>
                    <th scope="col">Total Buku</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Isi tabel -->
                  <?php
                  $query = "SELECT * FROM books INNER JOIN categories ON books.category_id=categories.id_kategori INNER JOIN pengarang ON books.pengarang_id=pengarang.id_pengarang INNER JOIN penerbit ON books.penerbit_id=penerbit.id_penerbit ORDER BY books.kode_buku";
                  $result = $db->query($query);
                  $nomor = 1;
                  foreach ($result as $row) : ?>

                    <tr>
                      <td><?= $nomor++ ?></td>
                      <!-- Tambahkan sel untuk menampilkan sampul buku -->
                      <td>
                        <img src="berkas/resized_<?= $row['sampul'] ?>" alt="">
                      </td>

                      <!-- Sisanya dari kolom tabel -->
                      <td><?= $row['isbn'] ?></td>
                      <td><?= $row['kode_buku'] ?></td>
                      <td><?= $row['judul'] ?></td>
                      <td><?= $row['nama_kategori'] ?></td>
                      <td><?= $row['nama_pengarang'] ?></td>
                      <td><?= $row['nama_penerbit'] ?></td>
                      <td><?= $row['available_books'] ?></td>
                      <td><?= $row['total_books'] ?></td>
                      <td>
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editBukuModal<?= $row['kode_buku'] ?>" style="margin-bottom: 10px;">
                          Edit
                        </button>
                        <button type="button" class="btn btn-danger ml-0" data-toggle="modal" data-target="#hapusBukuModal<?= $row['kode_buku'] ?>">
                          Hapus
                        </button>
                      </td>
                    </tr>
                    <!-- Modal Tambah Buku -->
                    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Buku</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form tambah buku -->
                            <form action="http://localhost/kelompok1perpus/buku/proses-books.php?proses=insert" method="post" enctype="multipart/form-data">
                              <div class="mb-3 row">
                                <label for="sampul" class="col-sm-3 col-form-label">Sampul</label>
                                <div class="col-sm-9">
                                  <input type="file" class="form-control" id="sampul" name="sampul" required>
                                </div>
                              </div>
                              <div class="mb-3 row">
                                <label for="isbn" class="col-sm-3 col-form-label">Kode ISBN</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="isbn" name="isbn" required>
                                </div>
                              </div>
                              <div class="mb-3 row">
                                <label for="kode_buku" class="col-sm-3 col-form-label">Kode Buku</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="nama_kategori" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                  <select name="category_id" class="form-select" id="selectKategori">
                                    <option value="" class="text-center">--Pilih Kategori--</option>
                                    <?php
                                    $kategori = mysqli_query($db, "SELECT * FROM categories");
                                    while ($data_categories = mysqli_fetch_assoc($kategori)) {
                                      echo "<option value=" . $data_categories['id_kategori'] . ">" . $data_categories['nama_kategori'] . "</option>";
                                    }
                                    ?>
                                           
                                  </select>
                                  </select>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="category_id" class="col-sm-3 col-form-label">Pengarang</label>
                                <div class="col-sm-9">
                                  <select name="pengarang_id" class="form-select" id="selectPengarang">
                                    <option value="" class="text-center">--Pilih Pengarang--</option>
                                    <?php
                                    $pengarang = mysqli_query($db, "SELECT * FROM pengarang");
                                    while ($data_pengarang = mysqli_fetch_assoc($pengarang)) {
                                      echo "<option value=" . $data_pengarang['id_pengarang'] . ">" . $data_pengarang['nama_pengarang'] . "</option>";
                                    }
                                    ?>
                                           
                                  </select>
                                  </select>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="penerbit_id" class="col-sm-3 col-form-label">Penerbit</label>
                                <div class="col-sm-9">
                                  <select name="penerbit_id" class="form-select" id="selectPenerbit">
                                    <option value="" class="text-center">--Pilih Penerbit--</option>
                                    <?php
                                    $penerbit = mysqli_query($db, "SELECT * FROM penerbit");
                                    while ($data_penerbit = mysqli_fetch_assoc($penerbit)) {
                                      echo "<option value=" . $data_penerbit['id_penerbit'] . ">" . $data_penerbit['nama_penerbit'] . "</option>";
                                    }
                                    ?>
                                           
                                  </select>
                                  </select>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="available_books" class="col-sm-3 col-form-label">Buku yang Tersedia</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control" id="available_books" name="available_books" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="total_books" class="col-sm-3 col-form-label">Total Buku</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control" id="total_books" name="total_books" required>
                                </div>
                              </div>


                              <button type="submit" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" name="submit">Submit
                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Modal Edit Buku -->
                    <div class="modal fade" id="editBukuModal<?= $row['kode_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered mx-auto">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">EDIT DATA BUKU</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true"><i class="fas fa-times"></i></span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <!-- Form edit buku -->
                            <form action="http://localhost/kelompok1perpus/buku/proses-books.php?proses=update" method="post" enctype="multipart/form-data">
                              <input type="hidden" name="kode_buku" value="<?= $row['kode_buku'] ?>">

                              <div class="mb-3 row">
                                <label for="sampul" class="col-sm-3 col-form-label">Sampul</label>
                                <div class="col-sm-9">
                                  <input type="file" class="form-control" id="sampul" name="sampul" value="<?= $row['sampul'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" id="judul" name="judul" value="<?= $row['judul'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="category_id" class="col-sm-3 col-form-label">Kategori</label>
                                <div class="col-sm-9">
                                  <select name="category_id" class="form-select" required>
                                    <option value="" class="text-center">--Pilih Kategori Buku--</option>
                                    <?php
                                    $kategori = mysqli_query($db, "SELECT * FROM categories ");
                                    while ($data_categories = mysqli_fetch_assoc($kategori)) {
                                      $selected = ($data_categories['id_kategori'] == $row['category_id']) ? 'selected' : '';
                                      echo "<option " . $selected . " value=" . $data_categories['id_kategori'] . " >" . $data_categories['nama_kategori'] . "</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="pengarang_id" class="col-sm-3 col-form-label">Pengarang</label>
                                <div class="col-sm-9">
                                  <select name="pengarang_id" class="form-select" required>
                                    <option value="" class="text-center">--Pilih Pengarang Buku--</option>
                                    <?php
                                    $pengarang = mysqli_query($db, "SELECT * FROM pengarang ");
                                    while ($data_pengarang = mysqli_fetch_assoc($pengarang)) {
                                      $selected = ($data_pengarang['id_pengarang'] == $row['pengarang_id']) ? 'selected' : '';
                                      echo "<option " . $selected . " value=" . $data_pengarang['id_pengarang'] . " >" . $data_pengarang['nama_pengarang'] . "</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="penerbit_id" class="col-sm-3 col-form-label">Penerbit</label>
                                <div class="col-sm-9">
                                  <select name="penerbit_id" class="form-select" required>
                                    <option value="" class="text-center">--Pilih Penerbit Buku--</option>
                                    <?php
                                    $penerbit = mysqli_query($db, "SELECT * FROM penerbit");
                                    while ($data_penerbit = mysqli_fetch_assoc($penerbit)) {
                                      $selected = ($data_penerbit['id_penerbit'] == $row['penerbit_id']) ? 'selected' : '';
                                      echo "<option " . $selected . " value=" . $data_penerbit['id_penerbit'] . " >" . $data_penerbit['nama_penerbit'] . "</option>";
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="available_books" class="col-sm-3 col-form-label">Buku yang Tersedia</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control" id="available_books" name="available_books" value="<?= $row['available_books'] ?>" required>
                                </div>
                              </div>

                              <div class="mb-3 row">
                                <label for="total_books" class="col-sm-3 col-form-label">Total Buku</label>
                                <div class="col-sm-9">
                                  <input type="number" class="form-control" id="total_books" name="total_books" value="<?= $row['total_books'] ?>" required>
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
      <div class="modal fade" id="hapusBukuModal<?= $row['kode_buku'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mx-auto">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus Buku</h5>
              <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus buku "<?= $row['judul'] ?>"?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
              <a href="http://localhost/kelompok1perpus/buku/proses-books.php?proses=delete&kode_buku=<?= $row['kode_buku'] ?>">
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
      <!-- Form tambah buku -->
      <form action="http://localhost/kelompok1perpus/buku/proses-books.php?proses=insert" method="post">
        <div class="row justify-content-center">

          <div class="col-md-8 my-5 py-5 mx-auto">
            <div class="card custom-card">
              <div class="card-header">
                <h4>INPUT DATA BUKU</h4>
              </div>
              <div class="card-body">
                <div class="mb-3 row">
                  <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                  <div class="col-sm-5">
                    <input type="file" class="form-control" id="sampul" name="sampul" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="judul" name="judul" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-5">
                    <select name="category_id" class="form-select" id="selectKategori">
                      <option value="">--Pilih Kategori--</option>
                      <?php
                      $kategori = mysqli_query($db, "SELECT * FROM categories");
                      while ($data_categories = mysqli_fetch_array($kategori)) {
                        echo "<option value=" . $data_categories['id_kategori'] . ">" . $data_categories['nama_kategori'] . "</option>";
                      }
                      ?>
                             
                    </select>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="category_id" class="col-sm-2 col-form-label">Pengarang</label>
                  <div class="col-sm-5">
                    <select name="pengarang_id" class="form-select" id="selectPengarang">
                      <option value="">--Pilih Pengarang--</option>
                      <?php
                      $pengarang = mysqli_query($db, "SELECT * FROM pengarang");
                      while ($data_pengarang = mysqli_fetch_array($pengarang)) {
                        echo "<option value=" . $data_pengarang['id_pengarang'] . ">" . $data_pengarang['nama_pengarang'] . "</option>";
                      }
                      ?>
                             
                    </select>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="penerbit_id" class="col-sm-2 col-form-label">Penerbit</label>
                  <div class="col-sm-5">
                    <select name="penerbit_id" class="form-select" id="selectPenerbit">
                      <option value="">--Pilih Penerbit--</option>
                      <?php
                      $penerbit = mysqli_query($db, "SELECT * FROM penerbit");
                      while ($data_penerbit = mysqli_fetch_array($penerbit)) {
                        echo "<option value=" . $data_penerbit['id_penerbit'] . ">" . $data_penerbit['nama_penerbit'] . "</option>";
                      }
                      ?>
                             
                    </select>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="available_books" class="col-sm-2 col-form-label">Buku yang Tersedia</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="available_books" name="available_books" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="total_books" class="col-sm-2 col-form-label">Total Buku</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="total_books" name="total_books" required>
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
    if (isset($_GET['kode_buku'])) {


      $kode_buku = $_GET['kode_buku'];
      $query = "SELECT * FROM books WHERE kode_buku='$kode_buku'";
      $result = $db->query($query);

      if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        $sampul = $row['sampul'];
        $kode_buku = $row['kode_buku'];
        $judul = $row['judul'];
        $category_id = $row['category_id'];
        $pengarang = $row['pengarang_id'];
        $penerbit = $row['penerbit_id'];
        $available_books = $row['available_books'];
        $total_books = $row['total_books'];
      } else {
        echo "Data Buku " . $kode_buku . "tidak ditemukan";
        exit;
      }
    } else {
      echo "Parameter tidak valid";
      exit;
    }
  ?>
    <div class="p-4 active-main-content" id="main-content">
      <!-- Form edit buku -->
      <form action="http://localhost/kelompok1perpus/buku/proses-books.php?proses=update" method="post">
        <div class="row justify-content-center">

          <div class="col-md-8 my-5 py-5 mx-auto">
            <div class="card custom-card">
              <div class="card-header">
                <h4>EDIT DATA BUKU</h4>
              </div>
              <div class="card-body">
                <div class="mb-3 row">
                  <input type="hidden" name="kode_buku" value="<?= $row['kode_buku'] ?>">
                  <div class="mb-3 row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <input type="file" class="form-control" id="sampul" name="sampul" value="<?= $sampul ?>" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" value="<?= $kode_buku ?>" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $judul ?>" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-5">
                    <select name="category_id" class="form-select" required>
                      <option value="">--Pilih Kategori Buku--</option>
                      <?php
                      $kategori = mysqli_query($db, "SELECT * FROM categories ");
                      while ($data_categories = mysqli_fetch_assoc($kategori)) {
                        $selected = ($data_categories['id_kategori'] == $row['category_id']) ? 'selected' : '';
                        echo "<option " . $selected . " value=" . $data_categories['id_kategori'] . " >" . $data_categories['nama_kategori'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="pengarang_id" class="col-sm-2 col-form-label">Pengarang</label>
                  <div class="col-sm-5">
                    <select name="pengarang_id" class="form-select" required>
                      <option value="">--Pilih Pengarang Buku--</option>
                      <?php
                      $pengarang = mysqli_query($db, "SELECT * FROM pengarang ");
                      while ($data_pengarang = mysqli_fetch_assoc($pengarang)) {
                        $selected = ($data_pengarang['id_pengarang'] == $row['pengarang_id']) ? 'selected' : '';
                        echo "<option " . $selected . " value=" . $data_pengarang['id_pengarang'] . " >" . $data_pengarang['nama_pengarang'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="penerbit_id" class="col-sm-2 col-form-label">Penerbit</label>
                  <div class="col-sm-5">
                    <select name="penerbit_id" class="form-select" required>
                      <option value="">--Pilih Penerbit Buku--</option>
                      <?php
                      $penerbit = mysqli_query($db, "SELECT * FROM penerbit");
                      while ($data_penerbit = mysqli_fetch_assoc($penerbit)) {
                        $selected = ($data_penerbit['id_penerbit'] == $row['penerbit_id']) ? 'selected' : '';
                        echo "<option " . $selected . " value=" . $data_penerbit['id_penerbit'] . " >" . $data_penerbit['nama_penerbit'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <div class="mb-3 row">
                  <label for="available_books" class="col-sm-2 col-form-label">Buku yang Tersedia</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="available_books" name="available_books" value="<?= $available_books ?>" required>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="total_books" class="col-sm-2 col-form-label">Total Buku</label>
                  <div class="col-sm-5">
                    <input type="number" class="form-control" id="total_books" name="total_books" value="<?= $total_books ?>" required>
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