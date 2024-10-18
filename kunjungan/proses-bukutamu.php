<?php 
    include '../koneksi.php';

    //query insert
    if (isset($_POST['simpanBukuTamu'])) {

        //mengambil nilai yang dikirimkan dari input form
        $nama = $_POST['nama'];
        //$tgl_kunjungan = $_POST['tgl_kunjungan'];
        $tgl_kunjungan = new DateTime();
        
        $tanggalFormatted = $tgl_kunjungan->format('j F Y');


        $simpanBukuTamu = "INSERT INTO buku_tamu(nama, tgl_kunjungan) VALUES ('$nama', '$tanggalFormatted')";

                            

        //jika simpan sukses
        if ($db->query($simpanBukuTamu)) {
            echo "<script>
                    alert('Simpan Buku tamu Sukses');
                    document.location='../index.php?page=buku_tamu';
                </script>";
            
            
        } else {
            echo "<script>
                    alert('Simpan Buku Tamu Gagal');
                    document.location='../index.php?page=buku_tamu';
                </script>";
            
        }

        $db->close();
    
}