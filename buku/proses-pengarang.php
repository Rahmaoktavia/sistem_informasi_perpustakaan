<?php 
    include '../koneksi.php';

    if ($_GET['proses']=='insert') {
        //query insert
        if (isset($_POST['submit'])) {
        
            //mengambil nilai yang dikirimkan dari inputan form
            $id_pengarang = $_POST['id_pengarang'];
            $nama_pengarang = $_POST['nama_pengarang'];

            //format tanggal
            $tgl_lahir = $_POST['tgl_lahir'];
            $tanggalFormatted =date_create($tgl_lahir)->format('d F Y');

            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $telepon = $_POST['telepon'];
            $referensi = $_POST['referensi'];
    
            //cek buku dan cek hasil
            $cek_pengarang = "SELECT * FROM pengarang WHERE id_pengarang = '$id_pengarang'";
            $cek_hasil = $db->query($cek_pengarang);
    
            if ($cek_hasil->num_rows > 0) {
                echo "Pengarang ".$id_pengarang." sudah terdaftar!";

            } else {
                // menyimpan query insert ke tabel user
                $query = "INSERT INTO pengarang (nama_pengarang, tgl_lahir,	alamat,	email,	telepon, referensi) VALUES ('$nama_pengarang', '$tanggalFormatted', '$alamat', '$email', '$telepon', '$referensi' )";
                
        
                if ($db->query($query) == TRUE ) {
                header("Location: ../index.php?page=pengarang"); //redirect
                } else {
                echo "Error: " .$query . "<br>" .$db->error;
                }
            }
         
          }
    }

    if ($_GET['proses']=='update') {
        //query update
        if (isset($_POST['submit'])) {

            $id_pengarang = $_POST['id_pengarang'];
            $nama_pengarang = $_POST['nama_pengarang'];
            $tgl_lahir = $_POST['tgl_lahir'];
            $tanggalFormatted =date_create($tgl_lahir)->format('d F Y');
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $telepon = $_POST['telepon'];
            $referensi = $_POST['referensi'];
      
            $query = "UPDATE pengarang SET nama_pengarang ='$nama_pengarang', tgl_lahir ='$tanggalFormatted', 	
                    alamat ='$alamat', email ='$email', telepon ='$telepon', referensi ='$referensi'   WHERE id_pengarang='$id_pengarang'";
      
                  //cek apakah sukses atau gagal
                  if ($db->query($query) == TRUE) {
                    // echo "update";
                    header("Location: ../index.php?page=pengarang");
                } else {
                    echo "Data gagal diupdate!".$db->error;
                }
      
          }
    }

    if ($_GET['proses']=='delete') {
        //query delete
        if (isset($_GET['id_pengarang'])) {
            $id_pengarang = $_GET['id_pengarang'];
            $query = "DELETE FROM pengarang WHERE id_pengarang='$id_pengarang'";
    
            //cek apakah terhapus atau tidak
            if ($db->query($query) == true) {
                header("Location: ../index.php?page=pengarang");
            } else {
                echo "Gagal Update Data!" . $db->error;
            }
        } else {
            echo "Pengarang Tidak Ditemukan";
        }
    }