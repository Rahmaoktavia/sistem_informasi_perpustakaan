<?php 
    include '../koneksi.php';

    if ($_GET['proses']=='insert') {
        //query insert
        if (isset($_POST['submit'])) {
        
            //mengambil nilai yang dikirimkan dari inputan form
            $id_penerbit = $_POST['id_penerbit'];
            $nama_penerbit = $_POST['nama_penerbit'];
            $alamat_penerbit = $_POST['alamat_penerbit'];
            $kota = $_POST['kota'];
            $negara = $_POST['negara'];
            $email_penerbit	= $_POST['email_penerbit'];
            $tlp_penerbit = $_POST['tlp_penerbit'];
            $tautan = $_POST['tautan'];
    
            //cek buku dan cek hasil
            $cek_penerbit = "SELECT * FROM penerbit WHERE id_penerbit = '$id_penerbit'";
            $cek_hasil = $db->query($cek_penerbit);
    
            if ($cek_hasil->num_rows > 0) {
                echo "Penerbit ".$id_penerbit." sudah terdaftar!";

            } else {
                // menyimpan query insert ke tabel user
                $query = "INSERT INTO penerbit (nama_penerbit, alamat_penerbit, kota, negara, email_penerbit, tlp_penerbit, tautan) 
                            VALUES ('$nama_penerbit', '$alamat_penerbit', '$kota', '$negara', '$email_penerbit', '$tlp_penerbit', '$tautan' )";
                
        
                if ($db->query($query) == TRUE ) {
                header("Location: ../index.php?page=penerbit"); //redirect
                } else {
                echo "Error: " .$query . "<br>" .$db->error;
                }
            }      
            
          }
    }

    if ($_GET['proses']=='update') {
        //query update
        if (isset($_POST['submit'])) {

            $id_penerbit = $_POST['id_penerbit'];
            $nama_penerbit = $_POST['nama_penerbit'];
            $alamat_penerbit = $_POST['alamat_penerbit'];
            $kota = $_POST['kota'];
            $negara = $_POST['negara'];
            $email_penerbit	= $_POST['email_penerbit'];
            $tlp_penerbit = $_POST['tlp_penerbit'];
            $tautan = $_POST['tautan'];
      
            $query = "UPDATE penerbit SET nama_penerbit ='$nama_penerbit', alamat_penerbit ='$alamat_penerbit', kota ='$kota', 	
                    negara ='$negara', email_penerbit ='$email_penerbit', tlp_penerbit ='$tlp_penerbit', tautan ='$tautan'   WHERE id_penerbit='$id_penerbit'";
      
                  //cek apakah sukses atau gagal
                  if ($db->query($query) == TRUE) {
                    // echo "update";
                    header("Location: ../index.php?page=penerbit");
                } else {
                    echo "Data gagal diupdate!".$db->error;
                }
      
          }
    }

    if ($_GET['proses']=='delete') {
        //query delete
        if (isset($_GET['id_penerbit'])) {
            $id_penerbit = $_GET['id_penerbit'];
            $query = "DELETE FROM penerbit WHERE id_penerbit='$id_penerbit'";
    
            //cek apakah terhapus atau tidak
            if ($db->query($query) == true) {
                header("Location: ../index.php?page=penerbit");
            } else {
                echo "Gagal Update Data!" . $db->error;
            }
        } else {
            echo "Penerbit Tidak Ditemukan";
        }
    }