<?php

include '../koneksi.php';
include '../method/fungsi.php';

//awal proses pembuatan id transaksi
// Ambil ID Transaksi terakhir dari database
$query = "SELECT * FROM peminjaman ORDER BY id_transaksi DESC LIMIT 1";
$result = $db->query($query);


if ($result->num_rows > 0) {
    $last_transaksi = $result->fetch_assoc();
    $last_id_transaksi = $last_transaksi['id_transaksi'] ?? '';

    // Tingkatkan ID transaksi
    $next_id_transaksi = incrementId($last_id_transaksi);
} else {
    // Jika tidak ada transaksi, maka ID baru dimulai dari 1
    $next_id_transaksi = 1;
}

// Format ID sesuai kebutuhan (contoh: T-000002)
$formatted_next_id_transaksi = 'T-' . str_pad($next_id_transaksi, 6, '0', STR_PAD_LEFT);
//akhir proses pembuatan id transaksi

//query insert
if (isset($_POST['simpanPeminjaman'])) {

    //mengambil nilai yang dikirimkan dari input form
    $nama = $_POST['member_id'];
    $judul_buku = $_POST['tanda_buku'];

    $tgl_pinjam = new DateTime();
    // Durasi peminjaman (7 hari)
    $durasiPeminjaman = new DateInterval('P7D');


    // Menghitung tanggal pengembalian
    $tglPengembalian = clone $tgl_pinjam;
    $tglPengembalian->add($durasiPeminjaman);

    //hasil format
    $tanggalFormattedPinjam = $tgl_pinjam->format('d F Y');
    $tanggalFormattedKembali = $tglPengembalian->format('d F Y');

    $denda = $_POST['denda'];

    $simpanPeminjaman = "INSERT INTO peminjaman(id_transaksi, member_id, tanda_buku, tgl_pinjam, tgl_kembali, denda) VALUES ('$formatted_next_id_transaksi', '$nama', '$judul_buku', '$tanggalFormattedPinjam', '$tanggalFormattedKembali', '$denda')";

    //jika simpan sukses
    if ($db->query($simpanPeminjaman)) {
        echo "<script>
                    alert('Simpan Data Peminjaman Sukses');
                    document.location='../index.php?page=peminjaman';
                </script>";
    } else {
        echo "<script>
                    alert('Simpan Data Peminjaman Gagal');
                    document.location='../index.php?page=peminjaman';
                </script>";
    }

    //$db->close();

}

$tgl_pinjam = new DateTime();
// Durasi peminjaman (7 hari)
$durasiPeminjaman = new DateInterval('P7D');


// Menghitung tanggal pengembalian
$tglPengembalian = clone $tgl_pinjam;
$tglPengembalian->add($durasiPeminjaman);

//hasil format
$tanggalFormattedPinjam = $tgl_pinjam->format('d F Y');

$tanggalFormattedKembali = $tglPengembalian->format('d F Y');



//query update
if (isset($_POST['ubahPeminjaman'])) {


    $mulaiPerpanjang = new DateTime($tanggalFormattedKembali);
    $durasiPerpanjang = new DateInterval('P7D');
    // Ubah kembali ke format tanggal yang diinginkan
    $perpanjangBuku = clone $mulaiPerpanjang;
    $mulaiPerpanjang->add($durasiPerpanjang);

    //hasil format
    $tglFormattedPerpanjang = $mulaiPerpanjang->format('d F Y');
    $id_transaksi = $_POST['id_transaksi'];

    $ubahPeminjaman = "UPDATE peminjaman 
                            SET 
                            tgl_kembali = '$tglFormattedPerpanjang'
                            WHERE id_transaksi = '$id_transaksi'";

    //jika simpan sukses
    if ($db->query($ubahPeminjaman)) {
        echo "<script>
                    alert('Perpanjang Buku Sukses');
                    document.location='../index.php?page=peminjaman';
                </script>";
    } else {
        echo "<script>
                    alert('Perpanjang Buku Gagal');
                    document.location='../index.php?page=peminjaman';
                </script>";
    }

    //$db->close();

}

//query delete
// if (isset($_POST['hapusPeminjaman'])) {

//     //persiapan hapus data 
//     $hapusPeminjaman = mysqli_query($db, "DELETE FROM peminjaman 
//         WHERE id_transaksi = '$_POST[id_transaksi]'");

//     //jika hapus sukses
//     if ($hapusPeminjaman) {
//         echo "<script>
//                     alert('Kembali Buku Sukses');
//                     document.location='../index.php?page=peminjaman';
//                 </script>";
//     } else {
//         echo "<script>
//                     alert('Kembali Buku Gagal');
//                     document.location='../index.php?page=peminjaman';
//                 </script>";
//     }
// }

if (isset($_POST['hapusPeminjaman'])) {

    //menangkap id peminjaman yang dikirim melalui AJAX
    $id_transaksi = $_POST['id_transaksi'];

    //mengambil data peminjaman berdasarkan id
    $query = mysqli_query($db, "SELECT * FROM peminjaman 
    JOIN member ON member.id_member = peminjaman.member_id 
    JOIN books ON books.kode_buku = peminjaman.tanda_buku WHERE id_transaksi = '$id_transaksi'");

    if ($query) {
        # code...
        $data = mysqli_fetch_assoc($query);

        if ($data !== null) {
            // Lanjutkan dengan pemrosesan data
            //menyimpan data peminjaman ke variabel
            $nim = $data['nim'];
            $id_member = $data['id_member'];
            $nama = $data['nama'];
            $isbn = $data['isbn'];
            $judul = $data['judul'];
            $tgl_pinjam = $data['tgl_pinjam'];
            $tgl_kembali = $data['tgl_kembali'];
            $denda = $data['denda'];

            //menambahkan data peminjaman ke tabel pengembalian
    mysqli_query($db, "INSERT INTO pengembalian (nim, id_member, nama, isbn, judul, tgl_pinjam, tgl_kembali, denda ) VALUES ('$nim', '$id_member', '$nama', '$isbn', '$judul',  '$tgl_pinjam', '$tgl_kembali', '$denda')");
        } else {
            echo "Data tidak ditemukan";
        }
    } else {
        echo "Error dalam menjalankan query: " . mysqli_error($db);
    }



    

    //menghapus data peminjaman dari tabel peminjaman
    $hapusPeminjaman = mysqli_query($db, "DELETE FROM peminjaman WHERE id_transaksi='$id_transaksi'");

    //menutup koneksi
    //mysqli_close($koneksi);

    //mengirim pesan sukses
    //echo "Data berhasil dipindahkan ke tabel pengembalian";
    if ($hapusPeminjaman) {
        echo "<script>
                    alert('Kembali Buku Sukses');
                    document.location='../index.php?page=pengembalian';
                </script>";
        
    } else {
        echo "<script>
                    alert('Kembali Buku Gagal');
                    document.location='../index.php?page=pengembalian';
                </script>";
        
    }
}