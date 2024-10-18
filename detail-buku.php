<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffff;
            margin: 0;
            padding: 0;
        }

        .main-panel {
            margin-top: 100px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        footer {
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3); /* You can adjust the values for your desired shadow effect */
    z-index: 2; /* Ensure the footer appears above other elements */
}
        .card-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table td,
        .table th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .image img {
            border: 3px solid #333333;
            border-radius: 5px;
            max-width: 100%; /* Maksimum lebar gambar adalah 100% dari container */
            height: auto;
        }
    </style>
</head>

<body>

<?php
include 'koneksi.php';

if (isset($_GET['kode_buku'])) {
    $kode_buku = $_GET['kode_buku'];

    if (isset($_POST['pinjam'])) {
        // Process for borrowing the book
        $tanggal_peminjaman = date('Y-m-d');
        $tanggal_pengembalian = date('Y-m-d', strtotime('+7 days')); // Example: return in 7 days
    
        // Insert into peminjaman table
        $queryPinjam = $db->query("INSERT INTO peminjaman (id_buku, tanggal_peminjaman, tanggal_pengembalian) VALUES ('$kode_buku', '$tanggal_peminjaman', '$tanggal_pengembalian')");
        
        if ($queryPinjam) {
            // Update the available_books count
            $updateAvailableQuery = $db->query("UPDATE books SET available_books = available_books - 1 WHERE kode_buku = '$kode_buku'");
    
            if ($updateAvailableQuery) {
                echo "Buku berhasil dipinjam. Stok berkurang.";
            } else {
                echo "Gagal mengupdate stok buku: " . $db->error;
            }
        } else {
            echo "Gagal melakukan peminjaman: " . $db->error;
        }
    } elseif (isset($_POST['kembali'])) {
        // Process for returning the book
        // Identify the transaction to mark as 'kembali'
        $queryReturn = $db->query("UPDATE peminjaman SET status = 'kembali' WHERE id_buku = '$kode_buku' AND status = 'pinjam'");
        
        if ($queryReturn) {
            // Update the available_books count
            $updateAvailableQuery = $db->query("UPDATE books SET available_books = available_books + 1 WHERE kode_buku = '$kode_buku'");
    
            if ($updateAvailableQuery) {
                echo "Buku berhasil dikembalikan. Stok bertambah.";
            } else {
                echo "Gagal mengupdate stok buku: " . $db->error;
            }
        } else {
            echo "Gagal melakukan pengembalian: " . $db->error;
        }
    }
    

    // Fetch book details for display
    $query = $db->query("SELECT * FROM books 
        INNER JOIN categories ON books.category_id=categories.id_kategori 
        INNER JOIN pengarang ON books.pengarang_id=pengarang.id_pengarang 
        INNER JOIN penerbit ON books.penerbit_id=penerbit.id_penerbit 
        WHERE books.kode_buku = '$kode_buku'");

    if ($query) {
        if ($query->num_rows == 1) {
            $data = $query->fetch_assoc();
        } else {
            echo "Data dengan Kode Buku '$kode_buku' tidak ditemukan.";
        }
    } else {
        echo "Error dalam menjalankan query: " . $db->error;
    }
} else {
    echo "Parameter Kode Buku tidak ditemukan dalam URL.";
}
?>

    <div class="main-panel">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Detail Buku</div>
                <div class="panel-body">
                    <table class="table">
                        <tr>
                            <td width="250">Kode Buku</td>
                            <td width="550"><?php echo isset($data['kode_buku']) ? $data['kode_buku'] : ''; ?></td>
                            <td rowspan="9" class="image">
                                <img src="berkas/resized_<?php echo $data['sampul']; ?>" alt="Sampul Buku" style="width: 100%; max-width: 200px;" />
                            </td>
                        </tr>
                        <tr>
                            <td width="250">Judul</td>
                            <td width="550"><?php echo $data['judul']; ?></td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td><?php echo $data['nama_kategori']; ?></td>
                        </tr>
                        <tr>
                            <td>Pengarang</td>
                            <td><?php echo $data['nama_pengarang']; ?></td>
                        </tr>
                        <tr>
                            <td>Penerbit</td>
                            <td><?php echo $data['nama_penerbit']; ?></td>
                        </tr>
                        <tr>
                            <td>Buku yang Tersedia</td>
                            <td><?php echo $data['available_books']; ?></td>
                        </tr>
                        <tr>
                            <td>Total Buku</td>
                            <td><?php echo $data['total_books']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!--====== FOOTER PART START ======-->
<footer class="bg-steelblue text-white p-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>PERPUSTAKAAN</h5>
        <address style="color: black; display: block;">
          Jl.Kampus Politeknik Negeri Padang<br>
          Limau Manis, Kecamatan Pauh Kota Padang<br>
          Provinsi Sumatera Barat<br>
          25164<br>
          <strong>Telepon:</strong> 0751865<br>
          <strong>Email:</strong> perpustakaan@pnp.ac.id
        </address>
      </div>
      <div class="col-md-4">
        <h5 style="color: black;">Tim Kami</h5>
        <ul class="list-unstyled" style="color: black;">
          <li>Rahma Oktavia</li>
          <p>NIM: 2201091011</p>
          <li>Gitta Hutari Dewinzha</li>
          <p>NIM: 2201092009 </p>
          <li>Orry Frasetyo</li>
          <p>NIM:2201092025 </p>
          <li>Yuni Sartika</li>
          <p>NIM: 2201092056 </p>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Lokasi Kami</h5>
        <!-- Embed Google Maps -->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3100492018316!2d100.46357607424709!3d-0.9145625353313178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b7be9e52a171%3A0x609ef1cc57a38e32!2sPoliteknik%20Negeri%20Padang!5e0!3m2!1sen!2sid!4v1704787825452!5m2!1sen!2sid" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <p>Temukan kami di peta di atas.</p>
      </div>
    </div>
    <hr class="bg-light">
    <p class="text-center mb-0">&copy; 2024 Perpustakaan@pnp.ac.id </p>
  </div>
</footer>



<!--====== FOOTER PART ENDS ======-->
</body>

</html>

