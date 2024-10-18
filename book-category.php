<!-- Koneksi Database -->
<?php
include 'koneksi.php';

// Ambil parameter category_id dari URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Ambil parameter search dari URL
    $search = isset($_POST['cari']) ? $_POST['cari'] : ''; // Changed from $_GET to $_POST

    // Query untuk mendapatkan buku berdasarkan kategori dengan filter pencarian
    $stmt = $db->prepare("SELECT books.*, categories.nama_kategori, pengarang.nama_pengarang 
                         FROM books 
                         INNER JOIN categories ON books.category_id = categories.id_kategori 
                         LEFT JOIN pengarang ON books.pengarang_id = pengarang.id_pengarang
                         WHERE books.category_id = ? AND (books.judul LIKE ? OR pengarang.nama_pengarang LIKE ?)");
    $searchTerm = "%$search%";
    $stmt->bind_param('iss', $category_id, $searchTerm, $searchTerm);
    $stmt->execute();

    // Periksa apakah query berhasil
    $result = $stmt->get_result(); // Moved this line outside the if statement
    $stmt->close();
} else {
    // Redirect ke halaman utama jika parameter kategori tidak ditemukan
    header("Location: index.php?page=bookcategory");
    exit();
}
?>

<style>
    body {
        padding-top: 56px;
    }

    .book-list-by-category {
        margin-top: 40px;
    }

    .category-title {
        font-size: 1.5rem;
        margin-bottom: 10px;
        margin-top: 15px;
    }

    .book-list-by-category .card {
        width: 18rem;
        height: 300px;
        max-width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: transform 0.2s;
    }

    .book-list-by-category .card:hover {
        transform: scale(1.05);
    }

    .book-list-by-category .card img {
        max-width: 100%;
        height: auto;
        border-radius: 8px 8px 0 0;
    }

    .book-list-by-category .card-body {
        padding: 1rem;
    }

    /* Tingkatkan lebar untuk kelas col-md-3 */
    .book-list-by-category .col-md-3 {
        width: 25%;
        margin-bottom: 20px;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
    }
    footer {
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3); /* You can adjust the values for your desired shadow effect */
    z-index: 2; /* Ensure the footer appears above other elements */
}
</style>

<!-- Navbar -->
<!-- Tambahkan navbar sesuai kebutuhan -->

<!-- Tampilkan judul kategori dan form pencarian -->
<div class="container mt-4">
    <h2 class="category-title">
        <?php
        // Ambil nama kategori dari database
        $stmt_category = $db->prepare("SELECT nama_kategori FROM categories WHERE id_kategori = ?");
        $stmt_category->bind_param('i', $category_id);
        $stmt_category->execute();
        $category_name = $stmt_category->get_result()->fetch_assoc()['nama_kategori'];
        $stmt_category->close();

        echo "Kategori: " . $category_name;
        ?>
    </h2>

    <!-- Form Pencarian -->
    <form action="" method="POST" class="d-flex justify-content-end mt-5">
        <div class="input-group mb-1"> <!-- Reduce mb-2 to mb-1 or any smaller value -->
            <input type="text" class="form-control" placeholder="Cari buku..." name="cari" value="<?= isset($_POST['cari']) ? $_POST['cari'] : '' ?>">
            <button class="btn btn-outline-secondary" type="submit" style="height: 38px;">Cari</button>
        </div>
    </form>

    <!-- Tampilkan hasil pencarian buku berdasarkan kategori -->
<section class="book-list-by-category">
    <div class="container">
        <?php if (!empty($result)) : ?>
            <div class="row gx-4">
                <?php foreach ($result as $book) : ?>
                    <!-- Tampilkan informasi buku -->
                    <div class="col-md-3 mb-4">
                        <div class="card h-100">
                            <!-- Tambahkan tautan ke detail-buku.php dengan menyertakan parameter kode_buku -->
                            <a href="index.php?page=detail-buku&kode_buku=<?= $book['kode_buku'] ?>" class="card-link">
                                <img src="berkas/resized_<?= $book['sampul'] ?>" class="card-img-top img-fluid" alt="Sampul Buku">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $book['judul'] ?></h5>
                                    <p class="card-text">
                                        <?php
                                        if (!empty($book['nama_pengarang'])) {
                                            echo $book['nama_pengarang'];
                                        } else {
                                            echo "Nama Pengarang Tidak Tersedia";
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="alert alert-info mt-3" role="alert">
                Tidak ada hasil pencarian buku.
            </div>
        <?php endif; ?>
    </div>
</section>

    <!-- Tambahkan script atau tautkan Bootstrap/JS scripts Anda di sini -->
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