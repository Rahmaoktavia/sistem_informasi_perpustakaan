<?php
include 'koneksi.php';

// Ambil parameter category_id dari URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Tambahkan kode untuk menangani parameter pencarian (jika diperlukan)
    if (isset($_GET['search'])) {
        $search_query = $_GET['search'];

        // Query untuk mendapatkan buku berdasarkan kategori
        $stmt = $db->prepare("SELECT * FROM books 
                              INNER JOIN categories ON books.category_id = categories.id_kategori 
                              WHERE books.category_id = ? AND books.judul LIKE ?");
        
        // Bind parameter dengan tipe data yang sesuai
        $stmt->bind_param('is', $category_id, $search_query);
    } else {
        // Query untuk mendapatkan buku berdasarkan kategori tanpa pencarian
        $stmt = $db->prepare("SELECT * FROM books 
                              INNER JOIN categories ON books.category_id = categories.id_kategori 
                              WHERE books.category_id = ?");
        
        // Bind parameter dengan tipe data yang sesuai
        $stmt->bind_param('i', $category_id);
    }

    $stmt->execute();

    // Periksa apakah query berhasil
    if ($stmt) {
        $result = $stmt->get_result();
        $stmt->close();
    } else {
        die("Query error: " . $db->error);
    }
} else {
    // Redirect ke halaman utama jika parameter kategori tidak ditemukan
    header("Location: index.php?page=bookcategory");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
    <!-- Tambahkan stylesheet atau link Bootstrap jika diperlukan -->
</head>

<body>

    <!-- Tampilkan judul kategori -->
    <div class="container mt-4">
        <?php if ($category_id !== null) : ?>
            <h2>Kategori: <?php echo $category_name; ?></h2>
        <?php endif; ?>
    </div>

    <!-- Tampilkan buku berdasarkan kategori dan pencarian -->
    <section class="book-list-by-category">
        <div class="container">
            <div class="row gx-4">
                <?php foreach ($result as $book) : ?>
                    <!-- Tampilkan informasi buku -->
                    <div class="col-md-2 mb-4">
                        <div class="card h-100">
                            <img src="berkas/resized_<?php echo $book['sampul']; ?>" class="card-img-top img-fluid" alt="Sampul Buku">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $book['judul']; ?></h5>
                                <?php if (isset($book['nama_pengarang'])) : ?>
                                    <p class="card-text"><?php echo $book['nama_pengarang']; ?></p>
                                <?php else : ?>
                                    <p class="card-text">Nama Pengarang Tidak Tersedia</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Tambahkan script atau link JS jika diperlukan -->

</body>

</html>
