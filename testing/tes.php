<style>
    .list-card {
        background-color: #eeebe3;
    }


    .card.custom-card {
        background-color: #fff1e6;
    }


    .form-column {
        background-color: #eeebe3;
    }
</style>

<?php
chdir(__DIR__);
include '../koneksi.php';
?>

<!-- MAIN CONTENT prodi-->

<div class="p-4 active-main-content" id="main-content">
    <!-- ! Form dan card list prodi -->
    <div class="row">
        <div class="col-sm-8">
            <div class="card custom-card">
                <div class="card-header">
                    <h4>DATA PRODI</h4>
                </div>
                <div class="card-body">

                    <!-- Tombol "Tambah Prodi" -->
                    <button type="button" class="btn btn-primary button-custom float-left" style="width: 100px; margin-right: 10px; margin-left: 10px;" data-bs-toggle="modal" data-bs-target="#modalTambahProdi">
                        Tambah Prodi
                    </button>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">no</th>
                                <th scope="col">nama prodi</th>
                                <th scope="col">keterangan</th>
                                <th scope="col">aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            $nomor= 1;
                            $query = mysqli_query($db, "SELECT * FROM prodi");
                            while ($row = mysqli_fetch_array($query)) : ?>
                                <tr>
                                    <td><?= $nomor++ ?></td>
                                    <td><?= $row['nama_prodi'] ?></td>
                                    <td><?= $row['keterangan'] ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProdi<?=$nomor?>">Edit</a>

                                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusProdi<?=$nomor?>">Hapus</a>

                                        
                                    </td>

                                </tr>

                                <!--Awal Modal "Edit Prodi" -->
                                <div class="modal fade" id="modalEditProdi<?= $nomor?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Prodi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Form tambah user -->
                                            <form action="http://localhost/perpus/prodi/proses-prodi.php" method="post">
                                                <input type="hidden" name="id_prodi" value="<?=$row['id_prodi']?>">
                                                
                                                <div class="modal-body">
                                                    <div class="mb-3 row">
                                                        <label for="nama_prodi" class="col-sm-2 col-form-label">Nama Prodi</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?=$row['nama_prodi']?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 row">
                                                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                                        <div class="col-sm-5">
                                                            <input type="text" class="form-control" id="keterangan" name="keterangan"
                                                            value="<?=$row['keterangan']?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary" name="ubahProdi">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Akhir Modal Ubah Prodi -->

                                <!--Awal Modal "Hapus Prodi" -->
                                <div class="modal fade" id="modalHapusProdi<?= $nomor?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Prodi</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <!-- Form hapus prodi -->
                                            <form action="http://localhost/perpus/prodi/proses-prodi.php" method="post">
                                                <input type="hidden" name="id_prodi" value="<?=$row['id_prodi']?>">
                                                
                                                <div class="modal-body">
                                                    <h5 class="text-center">Apakah yakin menghapus data ini?</h5> <br>
                                                    <span class="text-danger text-center"><?=$row['id_prodi']?> - <?=$row['nama_prodi']?></span>
                                                </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="hapusProdi">Ya, Hapus Aja!</button>
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

<!--AWal Modal "Tambah Prodi" -->
<div class="modal fade" id="modalTambahProdi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Prodi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Form tambah user -->
            <form action="http://localhost/perpus/prodi/proses-prodi.php" method="post">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="nama_prodi" class="col-sm-2 col-form-label">Nama Prodi</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="simpanProdi">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah Prodi -->