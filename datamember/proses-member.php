<?php
include '../koneksi.php';

// query insert
if (isset($_POST['simpanMember'])) {
    // Ambil id_member terbaru
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
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $prodi_id = $_POST['prodi_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $status = $_POST['status'];
    $no_tlp = $_POST['no_tlp'];

    $tgl_daftar = new DateTime();

    // Menambahkan satu tahun ke tanggal pendaftaran
    $tgl_akhir = $tgl_daftar->add(new DateInterval('P1Y'));

    $tanggalDaftarFormatted = $tgl_daftar->format('Y-m-d');
    // Format tanggal akhir
    $tanggalAkhirFormatted = $tgl_akhir->format('Y-m-d');

    $simpanMember = "INSERT INTO member(id_member, nim, nama, jenis_kelamin, prodi_id, email, password, level, status, no_tlp, tgl_daftar, tgl_berakhir) VALUES ('$newId', '$nim', '$nama', '$jenis_kelamin', '$prodi_id', '$email', '$password', '$level', '$status', '$no_tlp', '$tanggalDaftarFormatted', '$tanggalAkhirFormatted')";

    // Jika simpan sukses
    if ($db->query($simpanMember)) {
        echo "<script>
                alert('Simpan Data Member Sukses');
                document.location='../index.php?page=datamember';
            </script>";
    } else {
        echo "<script>
                alert('Simpan Data Member Gagal: " . mysqli_error($db) . "');
                document.location='../index.php?page=datamember';
            </script>";
    }
}


//query update
//query update
if (isset($_POST['ubahMember'])) {

    // Persiapan ubah data
    $ubahMember = mysqli_query($db, "UPDATE member
        SET 
        id_member = '$_POST[id_member]',
        nim = '$_POST[nim]',
        nama = '$_POST[nama]',
        jenis_kelamin = '$_POST[jenis_kelamin]',
        prodi_id = '$_POST[prodi_id]',
        email= '$_POST[email]',
        level = '$_POST[level]', 
        status = '$_POST[status]',  
        no_tlp = '$_POST[no_tlp]',
        tgl_daftar = '$_POST[tgl_daftar]',  
        tgl_berakhir = '$_POST[tgl_berakhir]'
        WHERE id_member = '$_POST[id_member]'
    ");

    // Jika ubah sukses
    if ($ubahMember) {
        echo "<script>
                alert('Ubah Data Member Sukses');
                document.location='../index.php?page=datamember';
              </script>";
    } else {
        echo "<script>
                alert('Ubah Data Member Gagal');
                document.location='../index.php?page=datamember';
              </script>";
    }
}


//query delete
if (isset($_POST['hapusMember'])) {

    //persiapan hapus data 
    $hapusMember = mysqli_query($db, "DELETE FROM member
    WHERE id_member = '$_POST[id_member]'");

    //jika hapus sukses
    if ($hapusMember) {
        echo "<script>
                alert('Hapus member sukses');
                document.location='../index.php?page=datamember';
            </script>";
    } else {
        echo "<script>
                alert('Hapus member gagal');
                document.location='../index.php?page=datamember';
            </script>";
    }
}