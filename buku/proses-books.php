<?php
include '../koneksi.php';

if ($_GET['proses'] == 'insert') {
    // query insert
    if (isset($_POST['submit'])) {
        // mengambil nilai yang dikirimkan dari inputan form
        $target_dir = "../berkas/";

        // Mengecek apakah file sampul diunggah
        if (isset($_FILES['sampul']) && $_FILES['sampul']['error'] == UPLOAD_ERR_OK) {
            $file_name = basename($_FILES['sampul']['name']);
            $target_file = $target_dir . $file_name;

            // Mengecek apakah file yang diunggah adalah gambar
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_extension, $allowed_extensions)) {
                // Menyimpan query insert ke tabel books
                $isbn = $_POST['isbn'];
                $kode_buku = $_POST['kode_buku'];
                $judul = $_POST['judul'];
                $category_id = $_POST['category_id'];
                $pengarang_id = $_POST['pengarang_id'];
                $penerbit_id = $_POST['penerbit_id'];
                $available_books = $_POST['available_books'];
                $total_books = $_POST['total_books'];

                // Pindahkan file yang diunggah
                move_uploaded_file($_FILES['sampul']['tmp_name'], $target_file);

                // fitur resize foto
                $resized_image_path = $target_dir  . "resized_" . $file_name;
                
                resizeImage($target_file, $resized_image_path, 100, 155);

                $query = "INSERT INTO books (kode_buku, isbn, judul, category_id, pengarang_id, penerbit_id, available_books, total_books, sampul) 
                          VALUES ('$kode_buku', '$isbn' , '$judul', '$category_id', '$pengarang_id', '$penerbit_id', '$available_books', '$total_books', '$file_name')";

                if ($db->query($query) === TRUE) {
                    header("Location: ../index.php?page=books"); //redirect
                    exit;
                } else {
                    echo "Error: " . $query . "<br>" . $db->error;
                }
            } else {
                echo "Format file tidak didukung!";
            }
        } else {
            echo "File sampul tidak diunggah atau terjadi kesalahan.";
        }
    }
}

if ($_GET['proses'] == 'update') {
    // query update
    if (isset($_POST['submit'])) {
        $target_dir = ".../berkas/";

        // Mengecek apakah file sampul diunggah
        if (isset($_FILES['sampul']) && $_FILES['sampul']['error'] == UPLOAD_ERR_OK) {
            $file_name = basename($_FILES['sampul']['name']);
            $target_file = $target_dir . $file_name;

            // Mengecek apakah file yang diunggah adalah gambar
            $allowed_extensions = array('jpg', 'jpeg', 'png');
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            if (in_array($file_extension, $allowed_extensions)) {
                // Menyimpan query update ke tabel books
                $kode_buku = $_POST['kode_buku'];
                $judul = $_POST['judul'];
                $category_id = $_POST['category_id'];
                $pengarang_id = $_POST['pengarang_id'];
                $penerbit_id = $_POST['penerbit_id'];
                $available_books = $_POST['available_books'];
                $total_books = $_POST['total_books'];

                // fitur resize foto
                $resized_image_path = $target_dir . 'resized_' . $file_name;
                resizeImage($_FILES['sampul']['tmp_name'], $resized_image_path, 100, 155);

                // Pindahkan file yang diunggah
                move_uploaded_file($_FILES['sampul']['tmp_name'], $target_file);

                $query = "UPDATE books SET 
                          sampul ='$file_name', judul ='$judul', category_id ='$category_id', pengarang_id ='$pengarang_id', penerbit_id ='$penerbit_id', 
                          available_books='$available_books', total_books='$total_books' WHERE kode_buku='$kode_buku'";

                // cek apakah sukses atau gagal
                if ($db->query($query) == TRUE) {
                    header("Location: ../index.php?page=books");
                    exit;
                } else {
                    echo "Data gagal diupdate!" . $db->error;
                }
            } else {
                echo "Format file tidak didukung!";
            }
        } else {
            echo "File sampul tidak diunggah atau terjadi kesalahan.";
        }
    }
}

if ($_GET['proses'] == 'delete') {
    // query delete
    if (isset($_GET['kode_buku'])) {
        $kode_buku = $_GET['kode_buku'];
        $query = "DELETE FROM books WHERE kode_buku='$kode_buku'";

        // cek apakah terhapus atau tidak
        if ($db->query($query) == true) {
            header("Location: ../index.php?page=books");
            exit;
        } else {
            echo "Gagal Update Data!" . $db->error;
        }
    } else {
        echo "Kode Buku Tidak Ditemukan";
    }
}

function resizeImage($filePath, $destination, $newWidth, $newHeight)
{
    // Dapatkan gambar asli
    $image = imagecreatefromstring(file_get_contents($filePath));

    // Buat gambar baru dengan true-color
    $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

    // Pertahankan transparansi untuk file PNG dan GIF
    imagealphablending($resizedImage, false);
    imagesavealpha($resizedImage, true);

    // Ubah ukuran gambar
    imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));

    // Simpan gambar yang sudah diubah ukurannya
    imagepng($resizedImage, $destination); // Ubah ini menjadi 'imagejpeg' jika ingin menyimpan dalam format JPEG

    // Hancurkan gambar untuk membebaskan memori
    imagedestroy($image);
    imagedestroy($resizedImage);
}