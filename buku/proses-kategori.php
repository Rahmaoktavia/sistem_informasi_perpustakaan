<?php 
    include '../koneksi.php';

    if ($_GET['proses']=='insert') {
        //query insert
        if (isset($_POST['submit'])) {
        
            //mengambil nilai yang dikirimkan dari inputan form
            $id_kategori = $_POST['id_kategori'];
            $nama_kategori = $_POST['nama_kategori'];
            $keterangan = $_POST['keterangan'];
    
            //cek buku dan cek hasil
            $cek_kategori = "SELECT * FROM categories WHERE id_kategori = '$id_kategori'";
            $cek_hasil = $db->query($cek_kategori);
    
            if ($cek_hasil->num_rows > 0) {
                echo "Kategori ".$id_kategori." sudah terdaftar!";

            } else {
                // menyimpan query insert ke tabel user
                $query = "INSERT INTO categories (nama_kategori, keterangan) VALUES ('$nama_kategori', '$keterangan')";
                
        
                if ($db->query($query) == TRUE ) {
                header("Location: ../index.php?page=categories"); //redirect
                } else {
                echo "Error: " .$query . "<br>" .$db->error;
                }
            }
            
    
            
    
            
            
          }
    }

    if ($_GET['proses']=='update') {
        //query update
        if (isset($_POST['submit'])) {
            $id_kategori = $_POST['id_kategori'];
            $nama_kategori = $_POST['nama_kategori'];
            $keterangan = $_POST['keterangan'];           
      
            $query = "UPDATE categories SET 
                  nama_kategori ='$nama_kategori',
                  keterangan ='$keterangan' WHERE id_kategori='$id_kategori'";
      
                  //cek apakah sukses atau gagal
                  if ($db->query($query) == TRUE) {
                    // echo "update";
                    header("Location: ../index.php?page=categories");
                } else {
                    echo "Data gagal diupdate!".$db->error;
                }
      
          }
    }

    if ($_GET['proses']=='delete') {
        //query delete
        if (isset($_GET['id_kategori'])) {
            $id_kategori = $_GET['id_kategori'];
            $query = "DELETE FROM categories WHERE id_kategori='$id_kategori'";
    
            //cek apakah terhapus atau tidak
            if ($db->query($query) == true) {
                header("Location: ../index.php?page=categories");
            } else {
                echo "Gagal Update Data!" . $db->error;
            }
        } else {
            echo "Kategori Tidak Ditemukan";
        }
    }