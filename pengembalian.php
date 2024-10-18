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
    margin-top: 120px;
    /* Sesuaikan dengan tinggi navbar Anda */
    padding: 20px;
    /* Sesuaikan sesuai kebutuhan Anda */
  }
</style>

<?php
// chdir(_DIR_);
include 'koneksi.php';
?>
 <!-- MAIN CONTENT -->
 <div class="p-4 active-main-content" id="main-content">
        <div class="row">
            <!-- Kolom Formulir -->
            <div class="col-sm-12">
                <div class="card custom-card">
                    <div class="card-header">
                        <div class="text-center">
                            <h4>PENGEMBALIAN BUKU</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                
                                
                                    <a href="http://localhost/kelompok1perpus/cetakpengembalian.php" class="btn btn-primary text-light ms-2" style="margin-left: 5px;">
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
                                    <th scope="col">no</th>
                              <th scope="col">nip/nim</th>
                              <th scope="col">id_member</th>
                              <th scope="col">nama</th>
                              <th scope="col">kode isbn</th>
                              <th scope="col">judul buku</th>
                              <th scope="col">tanggal peminjaman</th>
                              <th scope="col">tanggal pengembalian</th>
                              <th scope="col">jumlah denda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Isi tabel -->
                                   <?php
                                    $nomor = 1;
                                    $query = mysqli_query($db, "SELECT * FROM pengembalian");

                                    while ($row = mysqli_fetch_array($query)) : ?>
                                      <!-- Isi tabel -->
                                      <tr>
                                        <td><?= $nomor++ ?></td>
                                        <td><?= $row['nim']?></td>
                                        <td><?= $row['id_member']?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td><?= $row['isbn'] ?></td>
                                        <td><?= $row['judul'] ?></td>
                                        <td><?= $row['tgl_pinjam'] ?></td>
                                        <td><?= $row['tgl_kembali'] ?></td>
                                        <td><?= $row['denda'] ?></td>
                                        
                                      </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Awal Modal Tambah Buku tamu -->
                   
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

<!-- Example jQuery code to trigger the modal -->
<script>
  var modalTambahPeminjaman = document.getElementById('modalTambahPeminjaman')
  modalTambahPeminjaman.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'New message to ' + recipient
    modalBodyInput.value = recipient
  })
</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>