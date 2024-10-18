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
        padding: 20px;
    }

    .custom-radio {
        width: 16px;
        height: 16px;
    }


    /* Ganti warna background dan warna teks sesuai kebutuhan Anda */
    .dataTables_wrapper .dataTables_length {
        float: left;
        margin-bottom: 10px;
    }

    /* Ganti warna background dan warna teks sesuai kebutuhan Anda */
    .dataTables_wrapper .dataTables_filter {
        float: right;
        margin-bottom: 10px;
    }

    /* Ganti warna background dan warna teks untuk tabel */
    #example {
        background-color: #fff;
        color: #333;

    }

    /* Ganti warna background untuk baris ganjil */
    #example tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9;
    }

    /* Ganti warna background untuk baris genap */
    #example tbody tr:nth-of-type(even) {
        background-color: #e5e5e5;
    }

    /* Ganti warna teks dan rata kanan kolom dengan angka */
    #example th,
    #example td {
        text-align: center;
    }

    /* Ganti warna tombol paging */
    #example_paginate .paginate_button {
        background-color: #007bff;
        color: #fff;
    }

    /* Ganti warna tombol paging saat dihover */
    #example_paginate .paginate_button:hover {
        background-color: #0056b3;
    }

    /* Ganti warna halaman yang aktif */
    #example_paginate .paginate_button.current {
        background-color: #0056b3;
    }

    /* Ganti warna border pada hover */
    #example tbody tr:hover {
        background-color: #d0e9c6;
    }

    /* Ganti warna header kolom saat dihover */
    #example thead tr:hover th {
        background-color: #007bff;
        color: #fff;
    }
</style>



<?php
include 'koneksi.php';

if ($db->connect_error) {
    die("Koneksi Gagal! " . $db->connect_error);
}

// Query SQL untuk menampilkan data member
$query_select = "SELECT * FROM member";
$result = $db->query($query_select);
?>





<!-- MAIN CONTENT prodi-->

<div class="p-4 active-main-content" id="main-content">
    <!-- ! Form dan card list prodi -->
    <div class="row">
        <div class="col-sm-12 text-center">
            <div class="card custom-card">
                <div class="card-header">
                    <h4>DATA MEMBER</h4>
                </div>

                <div class="d-flex justify-content-start">
                        <div class="p-2">
                            <button type="button" class="btn btn-primary button-custom" data-bs-toggle="modal" data-bs-target="#modalTambahMember">
                                Tambah Member
                            </button>
                        </div>
                        <div class="p-2 print-button">
                            <a href="http://localhost/kelompok1perpus/datamember/cetakdatamember.php" class="btn btn-primary text-light">
                                <i class="fas fa-print"></i>
                            </a>
                        </div>
                    </div>

                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">ID Member</th>
                                <th scope="col">NIP/NIM</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jenis Kelamin</th>
                                <th scope="col">Status</th>
                                <th scope="col">Level</th>
                                <th scope="col">Prodi ID</th>
                                <th scope="col">Email</th>
                                <th scope="col">No Telepon</th>
                                <th scope="col">Tanggal Terdaftar</th>
                                <th scope="col">Tanggal Akhir Member</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $query = "SELECT * FROM prodi";
                            // $result = $db->query($query);
                            // $nomor = 1;
                            // foreach ($result as $row) :
                            $nomor = 1;
                            $query = mysqli_query($db, "SELECT * FROM member JOIN prodi ON member.prodi_id = prodi.id_prodi");
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $row['id_member'] ?></td>
                                    <td><?= $row['nim'] ?></td>
                                    <td><?= $row['nama'] ?></td>
                                    <td><?= $row['jenis_kelamin'] ?></td>
                                    <td><?= $row['status'] ?></td>
                                    <td><?= $row['level'] ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['no_tlp'] ?></td>
                                    <td><?= $row['tgl_daftar'] ?></td>
                                    <td><?= $row['tgl_berakhir'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditMember<?= $nomor ?>" style="margin-bottom: 10px;">Edit</a>

                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusMember<?= $nomor ?>">Hapus</a>


                                    </td>

                                </tr>

                                <!--Awal Modal "Edit Prodi" -->
                                <div class="modal fade" id="modalEditMember<?= $nomor ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Member</h5>

                                            </div>
                                            <!-- Form tambah user -->
                                            <form action="http://localhost/kelompok1perpus/datamember/proses-member.php" method="post">
                                                <input type="hidden" name="id_member" value="<?= $row['id_member'] ?>">

                                                <div class="modal-body">
                                                    <div class="col-md-6">
                                                        <label for="inputIdMember" class="form-label">ID Member</label>
                                                        <input type="text" class="form-control" id="inputIdMember" name="id_member" value="<?= $row['id_member'] ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputNim" class="form-label">NIM</label>
                                                        <input type="text" class="form-control" id="inputNim" name="nim" value="<?= $row['nim'] ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputNama" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" id="inputNama" name="nama" value="<?= $row['nama'] ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                                                        <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="jenis_kelamin">
                                                            <option value="laki" <?php echo ($row['jenis_kelamin'] == "laki") ? 'selected' : ''; ?>>laki-laki</option>
                                                            <option value="perempuan" <?php echo ($row['jenis_kelamin'] == "perempuan") ? 'selected' : ''; ?>>perempuan</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputProdi" class="form-label">Prodi</label>
                                                        <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="prodi_id">
                                                            <option value="">- Pilih Prodi -</option>
                                                            <?php
                                                            $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                                                            while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                                                                $selected = ($rowProdi['id_prodi'] == $row['prodi_id']) ? 'selected' : '';
                                                                echo "<option value='" . $rowProdi['id_prodi'] . "' $selected>" . $rowProdi['nama_prodi'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputEmail" class="form-label">Email</label>
                                                        <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $row['email'] ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputLevelEdit" class="form-label">Level</label>
                                                        <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="level" id="inputLevelEdit">
                                                            <option value="admin" <?php echo ($row['level'] == "admin") ? 'selected' : ''; ?>>admin</option>
                                                            <option value="pustakawan" <?php echo ($row['level'] == "pustakawan") ? 'selected' : ''; ?>>pustakawan</option>
                                                            <option value="anggota" <?php echo ($row['level'] == "anggota") ? 'selected' : ''; ?>>anggota</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputStatusEdit" class="form-label">Status</label>
                                                        <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="status" id="inputStatusEdit">
                                                            <option value="-" <?php echo ($row['status'] == "-") ? 'selected' : ''; ?>>-</option>
                                                            <option value="Mahasiswa" <?php echo ($row['status'] == "Mahasiswa") ? 'selected' : ''; ?>>Mahasiswa</option>
                                                            <option value="Dosen" <?php echo ($row['status'] == "Dosen") ? 'selected' : ''; ?>>Dosen</option>
                                                            <option value="Tendik" <?php echo ($row['status'] == "Tendik") ? 'selected' : ''; ?>>Tendik</option>
                                                        </select>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="inputNoTelp" class="form-label">No Telepon</label>
                                                        <input type="text" class="form-control" id="inputNoTelp" name="no_tlp" value="<?= $row['no_tlp'] ?>">
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputTanggalDaftar" class="form-label">Tanggal Terdaftar</label>
                                                        <input type="date" class="form-control" id="inputTanggalDaftar" name="tgl_daftar" value="<?= $row['tgl_daftar'] ?>">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="inputTanggalKembali" class="form-label">Tanggal Akhir Member</label>
                                                        <input type="date" class="form-control" id="inputTanggalKembali" name="tgl_berakhir" value="<?= $row['tgl_berakhir'] ?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary" name="ubahMember">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Ubah Prodi -->

                                <!--Awal Modal "Hapus Prodi" -->
                                <div class="modal fade" id="modalHapusMember<?= $nomor ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Member</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Form hapus prodi -->
                                            <form action="http://localhost/kelompok1perpus/datamember/proses-member.php" method="post">
                                                <input type="hidden" name="id_member" value="<?= $row['id_member'] ?>">

                                                <div class="modal-body">
                                                    <h5 class="text-center">Apakah yakin menghapus data ini?</h5> <br>
                                                    <span class="text-danger text-center"><?= $row['id_member'] ?> - <?= $row['nama'] ?></span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="hapusMember">Ya</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Hapus Prodi -->
                            <?php endwhile; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--AWal Modal "Tambah Member" -->
<div class="modal fade" id="modalTambahMember" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Data Member</h5>
            </div>
            <!-- Form tambah user -->
            <form action="http://localhost/kelompok1perpus/datamember/proses-member.php" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                    <?php
            $latestIdQuery = mysqli_query($db, "SELECT id_member FROM member ORDER BY id_member DESC LIMIT 1");

            if ($latestIdResult = mysqli_fetch_assoc($latestIdQuery)) {
                $latestId = $latestIdResult['id_member'];
                // Ekstrak bagian numerik dan tambahkan satu
                $numericPart = (int) substr($latestId, 2);
                $newId = 'M-' . sprintf('%06d', $numericPart + 1);
            } else {
                // Jika tidak ada id_member yang ada, mulai dari M-000001
                $newId = 'M-000001';
            }

            // Sisipkan id_member baru ke dalam $_POST agar dapat digunakan dalam pernyataan INSERT INTO
            $_POST['id_member'] = $newId;
            ?>

            <!-- Display the generated id_member -->
            <div class="col-md-6">
                <label for="inputIdMember" class="form-label">ID Member</label>
                <input type="text" class="form-control" id="inputIdMember" name="id_member" value="<?= $newId ?? ''; ?>" readonly>
            </div>
                        <div class="col-md-6">
                            <label for="inputNim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="inputNim" name="nim" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" required>
                        </div>
                        <div class="col-md-6">
                            <label for="inputJenisKelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="jenis_kelamin" required>
                                <option value="laki-laki">laki-laki</option>
                                <option value="perempuan">perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="status" id="inputStatus">
                                <option disabled="disabled" selected="selected">Pilih Status</option>
                                <option value="mahasiswa">Mahasiswa</option>
                                <option value="dosen">Dosen</option>
                                <option value="tendik">Tendik</option>
                                <option value="admpustakawan">AdmPustakawan</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="inputLevel" class="form-label">Level</label>
                            <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="level" id="inputLevel">
                                <option disabled="disabled" selected="selected">Pilih Level</option>
                                <option value="admin">admin</option>
                                <option value="pustakawan">pustakawan</option>
                                <option value="anggota">anggota</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="inputProdi" class="form-label">Prodi</label>
                            <select class="form-select mb-1" aria-label=".form-select-lg example" style="height: 38px;" name="prodi_id" id="inputProdi">
                                <option disabled="disabled" selected="selected">Pilih Prodi</option>
                                <?php
                                $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                                while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                                    echo "<option value='" . $rowProdi['id_prodi'] . "'>" . $rowProdi['nama_prodi'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- <input type="hidden" name="level" id="hiddenLevel" value="anggota">
                        <input type="hidden" name="prodi_id" id="hiddenProdi" value="-">

                        <script>
                            document.getElementById('inputStatus').addEventListener('change', function() {
                                var statusDropdown = document.getElementById('inputStatus');
                                var levelDropdown = document.getElementById('inputLevel');
                                var prodiDropdown = document.getElementById('inputProdi');
                                var hiddenLevelInput = document.getElementById('hiddenLevel');
                                var hiddenProdiInput = document.getElementById('hiddenProdi');

                                // Reset dropdown level
                                levelDropdown.value = '';
                                levelDropdown.disabled = false;

                                // Reset dropdown prodi
                                prodiDropdown.value = '';
                                prodiDropdown.disabled = false;

                                if (statusDropdown.value === 'mahasiswa' || statusDropdown.value === 'dosen' || statusDropdown.value === 'tendik' || statusDropdown.value === 'admpustakawan') {
                                    levelDropdown.disabled = false;
                                    prodiDropdown.disabled = false;

                                    // Disable atau enable pilihan level dan prodi berdasarkan status yang dipilih
                                    if (statusDropdown.value === 'mahasiswa') {
                                        levelDropdown.value = 'anggota';
                                        levelDropdown.disabled = true;
                                        prodiDropdown.disabled = false;
                                        // Update nilai hidden input level
                                        hiddenLevelInput.value = 'anggota';
                                    } else if (statusDropdown.value === 'dosen' || statusDropdown.value === 'tendik') {
                                        levelDropdown.value = 'anggota';
                                        levelDropdown.disabled = true;
                                        // prodiDropdown.value = ''; // Mengatur prodi ke default jika status bukan mahasiswa
                                        prodiDropdown.disabled = true;
                                        hiddenLevelInput.value = 'anggota';
                                        hiddenLevelInput.value = '-';
                                    } else {
                                        levelDropdown.innerHTML = '<option value="admin">Admin</option><option value="pustakawan">Pustakawan</option>';
                                        levelDropdown.disabled = false;

                                        prodiDropdown.disabled = false;
                                        hiddenLevelInput.value = '-';
                                    }
                                } else {
                                    levelDropdown.disabled = true;
                                    prodiDropdown.disabled = true;
                                }




                            });
                        </script> -->



                        <div class="col-md-6">
                            <label for="inputEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name="email">
                        </div>

                        <div class="col-md-6">
                            <label for="inputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>



                        <div class="col-md-6">
                            <label for="inputNoTelp" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="inputNoTelp" name="no_tlp">
                        </div>

                        <div class="col-md-6">
                                                            <label for="inputTanggalDaftar" class="form-label">Tanggal Terdaftar</label>
                                                            <input type="date" class="form-control" id="inputTanggalDaftar" name="tgl_daftar" value="<?= $row['tgl_daftar'] ?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="inputTanggalKembali" class="form-label">Tanggal Akhir Member</label>
                                                            <input type="date" class="form-control" id="inputTanggalKembali" name="tgl_berakhir" value="<?= $row['tgl_berakhir'] ?>">
                                                        </div>

                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="simpanMember">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Prodi -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" integrity="sha384-rvBdIUPlu9I3GGGXYldFKlc/Z9fNfEXnV+fmRkSr47eADnJmGJX5CIO9M0DA9S3X" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>

<script>
    document.getElementById('inputLevel').addEventListener('change', function() {
        var levelValue = this.value;
        var statusDropdown = document.getElementById('inputStatus');

        // Set status to "-" for admin and pustakawan
        if (levelValue == '1' || levelValue == '2') {
            statusDropdown.value = '1'; // Set to "-"
            statusDropdown.disabled = true; // Disable the dropdown
        } else {
            statusDropdown.disabled = false; // Enable the dropdown for other levels
        }
    });
</script>