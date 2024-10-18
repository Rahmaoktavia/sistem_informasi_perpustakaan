<?php
  require 'koneksi.php';
// session_start();
?>


<style>

.video-area .video-wrapper {
  background-image: url('perpus.jpg');
  position: relative;
  z-index: 1;
}


    .post-item-wrapper {
        display: flex;
        overflow-x: auto; /* Mengaktifkan scroll horizontal */
        overflow-y: hidden; /* Menonaktifkan scroll vertical */
        margin: 20px 0; /* Menambahkan margin atas dan bawah */
        white-space: nowrap; /* Mencegah wrap ke baris berikutnya */
    }

    .post-item {
        margin-right: 20px; /* Jarak antar buku */
        margin-bottom: 20px; /* Menambahkan margin bawah card */
    }

    .card {
        width: 250px; /* Lebar kartu */
        height: 400px; /* Tinggi kartu (disesuaikan sesuai kebutuhan) */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Efek bayangan kartu */
        transition: transform 0.3s ease-in-out; /* Efek transisi ketika hover */
        margin-right: 15px; /* Menambahkan margin antara card */
        margin-bottom: 15px;
        display: inline-block; /* Membuat kartu tampil dalam satu baris */
        white-space: normal; /* Mengembalikan wrap ke kondisi normal */
    }

    .card:hover {
        transform: scale(1.05); /* Perbesar kartu saat hover */
    }

    .card-img-top {
        width: 100%;
        height: 85%; /* Ubah tinggi gambar kartu menjadi 70% */
        object-fit: cover; /* Menggunakan 'cover' agar gambar memenuhi area kartu */
    }

    .card-body {
        padding: 15px; /* Menambahkan padding pada bagian body kartu */
        flex: 1; /* Memastikan card-body memenuhi sisa tinggi kartu */
        box-sizing: border-box; /* Mencegah padding mempengaruhi tinggi total kartu */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        margin-bottom: 15px; /* Menambahkan margin bawah card-body */
        text-align: center; /* Tengahkan teks */
    }

    .category-list-area {
        margin-top: 20px; /* Adjust the margin-top value to your preference */
    }

    footer {
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3); /* You can adjust the values for your desired shadow effect */
    z-index: 2; /* Ensure the footer appears above other elements */
}
</style>

<!--====== HEADER PART ENDS ======-->
<section id="home" class="hero-area bg_cover">
    <div class="container">
        <div class="row">
            <div class="mx-auto col-lg-9 col-xl-9 col-md-10">
                <div class="text-center hero-content">
                    <h1 class="mb-30 wow fadeInUp" data-wow-delay=".2s" style="font-size: 44px;">PERPUSTAKAAN POLITEKNIK NEGERI PADANG</h1>
                    <p class="wow fadeInUp" data-wow-delay=".4s" style="font-size: 16px;">Nothing is pleasanter than exploring in a library.</p><br>

                    <a href="#about-us" class="main-btn btn-hover">more info</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- search-area.php -->





	<!--====== CATEGORY LIST PART START ======-->
<section class="category-list-area pt-80">
    <div class="container">
        <div class="text-center section-title mb-10">
            <h1>BOOK CATEGORY</h1>
            <?php
            include 'koneksi.php';

            $stmt = $db->prepare("SELECT * FROM categories");
            $stmt->execute();

            if ($stmt) {
                $result = $stmt->get_result();
                $stmt->close();
            } else {
                die("Query error: " . $db->error);
            }
            ?>
            <div class="category-list-wrapper row row-cols-1 row-cols-md-3 g-4">
                <?php foreach ($result as $row) : ?>
                    <div class="col">
                        <div class="card h-100" style="background-color: white; border: 1px solid #ccc; border-radius: 10px;">
                            <div class="card-body">
                                <div class="icon text-center">
                                    <!-- Tautan menuju halaman buku berdasarkan kategori -->
                                    <a href="index.php?page=bookcategory&category_id=<?= $row['id_kategori'] ?>">
                                        <img src="bukukategori-image.png" alt="Members">
                                    </a>

                                </div>
                                <h5 class="card-title text-center" style="color: #333; font-family: 'Arial', sans-serif; font-weight: bold; padding-top: 10px;">
                                    <?= $row['nama_kategori'] ?>
                                </h5>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!--====== CATEGORY LIST PART END ======-->



<section id="about-us" class="video-area" style="margin-top: 30px;">
    <div class="video-wrapper img-bg">
        <div class="container">
            <div class="text-center video-content">
                <h1 class="text-white mb-60">Learn More About Us</h1>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="count-up-wrapper row justify-content-center">

            <div class="col-lg-3 col-sm-6">
                <div class="single-counter">
                    <div class="icon">
                        <img src="peminjaman-image.png" alt="Peminjaman">
                    </div>
                    <span class="count"> <?php
                        include 'koneksi.php';

                        $stmt = $db->prepare("SELECT COUNT(*) as total FROM peminjaman");
                        $stmt->execute();

                        if ($stmt) {
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            $stmt->close();
                        } else {
                            die("Query error: " . $db->error);
                        }
                        ?></span>
                    <span>Peminjaman</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-counter">
                    <div class="icon">
                        <img src="member-image.png" alt="Members">
                    </div>
                    <span class="count"> <?php
                        include 'koneksi.php';

                        $stmt = $db->prepare("SELECT COUNT(*) as total FROM member");
                        $stmt->execute();

                        if ($stmt) {
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            $stmt->close();
                        } else {
                            die("Query error: " . $db->error);
                        }
                        ?></span>
                    <span>Members</span>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="single-counter">
                    <div class="icon">
                        <img src="buku-image.png" alt="Buku">
                    </div>
                    <span class="count">
                        <?php
                        include 'koneksi.php';

                        $stmt = $db->prepare("SELECT COUNT(*) as total FROM books");
                        $stmt->execute();

                        if ($stmt) {
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            echo $row['total'];
                            $stmt->close();
                        } else {
                            die("Query error: " . $db->error);
                        }
                        ?>
                    </span>
                    <span>Buku</span>
                </div>
            </div>

        </div>
    </div>
</section>



<!--====== BAGIAN PRODUK UNGGULAN DIMULAI ======-->

<!--====== BAGIAN PRODUK UNGGULAN DIMULAI ======-->

<section class="feature-product-area bg_cover">
    <div class="container" style="overflow-x: hidden;">
        <div class="row justify-content-center">
            <div class="mx-auto col-lg-12 position-relative">
                <div class="text-center section-title mb-60">
                    <h1>BUKU TERBARU</h1>
                </div>
                <div class="post-item-wrapper" id="book-slider" style="overflow-x: hidden;">
                    <?php
                    include 'koneksi.php';

                    $stmt = $db->prepare("SELECT * FROM books 
                        INNER JOIN categories ON books.category_id = categories.id_kategori 
                        INNER JOIN pengarang ON books.pengarang_id = pengarang.id_pengarang 
                        INNER JOIN penerbit ON books.penerbit_id = penerbit.id_penerbit 
                        ORDER BY books.kode_buku LIMIT 4");

                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-3 mb-4">'; // Tambahkan kolom grid di sini
                            echo '<div class="card custom-card">';
                            echo '<a href="index.php?page=detail-buku&kode_buku=' . $row['kode_buku'] . '" class="card">';
                            echo '<img class="card-img-top" src="berkas/' . $row['sampul'] . '" alt="Sampul Buku">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title" data-toggle="modal" data-target="#DetailModal" data-id="' . $row['kode_buku'] . '" style="margin-bottom: 1px;">' . $row['judul'] . '</h5>';
                            echo '<p class="author" style="margin-top: 0; margin-bottom: 10px; font-size: 15px;">' . $row['nama_pengarang'] . '</p>';
                            echo '</div>';
                            echo '</a>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo 'Tidak ada data ditemukan.';
                    }

                    $stmt->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Tambahkan script JavaScript untuk fungsi Next dan Prev -->
<script>
    var currentSlide = 0;
    var totalSlides = <?php echo $result->num_rows; ?>;

    function nextSlide() {
        if (currentSlide < totalSlides - 4) {
            currentSlide += 1;
            updateSlider();
        }
    }

    function prevSlide() {
        if (currentSlide > 0) {
            currentSlide -= 1;
            updateSlider();
        }
    }

    function updateSlider() {
        var slider = document.getElementById("book-slider");
        slider.style.transform = "translateX(" + (-currentSlide * 280) + "px)";
    }
</script>

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