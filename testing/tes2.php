<?php 


include '../koneksi.php';

    //query insert
    if (isset($_POST['simpanProdi'])) {

            //persiapan simpan data baru
            $simpanProdi = mysqli_query($db, "INSERT INTO prodi (nama_prodi, keterangan) VALUES ('$_POST[nama_prodi]',
                                '$_POST[keterangan]')");

            //jika simpan sukses
            if ($simpanProdi) {
                echo "<script>
                        alert('Simpan Data Prodi Sukses');
                        document.location='../index.php?page=prodi';
                    </script>";
                
            } else {
                echo "<script>
                        alert('Simpan Data Prodi Gagal');
                        document.location='../index.php?page=prodi';
                    </script>";
            }
        
    }   

    //query update
    if (isset($_POST['ubahProdi'])) {

            //persiapan ubah data
            $ubahProdi = mysqli_query($db, "UPDATE prodi
             SET 
                nama_prodi = '$_POST[nama_prodi]',
                keterangan = '$_POST[keterangan]'
            WHERE id_prodi = '$_POST[id_prodi]'");

            //jika ubah sukses
            if ($ubahProdi) {
                echo "<script>
                        alert('Ubah Data Prodi Sukses');
                        document.location='../index.php?page=prodi';
                    </script>";
                
            } else {
                echo "<script>
                        alert('Ubah Data Prodi Gagal');
                        document.location='../index.php?page=prodi';
                    </script>";
            }
        
    }   

    //query delete
    if (isset($_POST['hapusProdi'])) {

        //persiapan hapus data 
        $hapusProdi = mysqli_query($db, "DELETE FROM prodi 
        WHERE id_prodi = '$_POST[id_prodi]'");

        //jika hapus sukses
        if ($hapusProdi) {
            echo "<script>
                    alert('Hapus Prodi Sukses');
                    document.location='../index.php?page=prodi';
                </script>";
            
        } else {
            echo "<script>
                    alert('Hapus Prodi Gagal');
                    document.location='../index.php?page=prodi';
                </script>";
        }
    
}  


    
