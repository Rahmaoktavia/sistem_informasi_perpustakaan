<?php

session_start();

// cek user sudah login atau belum
if (!isset($_SESSION['login'])) {
	header("Location: login/login.php");
	exit;
}

include 'koneksi.php';
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
	<meta charset="UTF-8">


	<!--====== Title ======-->
	<title>PERPUSTAKAAN</title>

	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--====== Favicon Icon ======-->
	<link rel="shortcut icon" href="assets/images/favicon.png" type="image/png">

	<!--====== Animate CSS ======-->
	<link rel="stylesheet" href="assets/css/animate.css">

	<!--====== Tiny slider CSS ======-->
	<link rel="stylesheet" href="assets/css/tiny-slider.css">

	<!--====== glightbox CSS ======-->
	<link rel="stylesheet" href="assets/css/glightbox.min.css">

	<!--====== Line Icons CSS ======-->
	<link rel="stylesheet" href="assets/css/LineIcons.2.0.css">

	<!--====== Selectr CSS ======-->
	<link rel="stylesheet" href="assets/css/selectr.css">

	<!--====== Nouislider CSS ======-->
	<link rel="stylesheet" href="assets/css/nouislider.css">

	<!--====== Bootstrap CSS ======-->
	<link rel="stylesheet" href="assets/css/bootstrap-5.0.5-alpha.min.css">

	<!--====== Style CSS ======-->
	<link rel="stylesheet" href="assets/css/style.css">




</head>

<body style="display: flex; flex-direction: column; min-height: 100vh; margin: 0;">
	<!--[if IE]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

	<!--====== PRELOADER PART START ======-->

	<div class="preloader">
		<div class="loader">
			<div class="ytp-spinner">
				<div class="ytp-spinner-container">
					<div class="ytp-spinner-rotator">
						<div class="ytp-spinner-left">
							<div class="ytp-spinner-circle"></div>
						</div>
						<div class="ytp-spinner-right">
							<div class="ytp-spinner-circle"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--====== PRELOADER PART ENDS ======-->

	<!--====== HEADER PART START ======-->

	<header class="header_area">
		<div id="header_navbar" class="header_navbar">
			<div class="container position-relative">
				<div class="row align-items-center">
					<div class="col-xl-12">
						<nav class="navbar navbar-expand-lg">
							<a class="" href="index.html">
								<img id="logo" src="assets/images/Teknologi.png" alt="Logo" style="width: 150px; height: auto;">
							</a>

							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<span class="toggler-icon"></span>
								<span class="toggler-icon"></span>
								<span class="toggler-icon"></span>
							</button>
							<div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
								<ul id="nav" class="navbar-nav">
									<li class="nav-item">
										<a class="page-scroll" href="index.php" id="home">Home</a>
									</li>
									<?php
									if ($_SESSION['level'] == 'admin') {
										# code...
									
									?>
										<li class="nav-item">
										<a class="page-scroll" href="index.php?page=buku_tamu" id="datatamu">buku tamu</a>
									</li>
									<?php
										}
									?>
									
									<?php
									if ($_SESSION['level'] == 'admin') {
										# code...
									?>
										
										<li class="nav-item">
											<a class="page-scroll" href="index.php?page=peminjaman">data transaksi</a>
											<ul class="sub-menu collapse" id="sub-nav">
												<li><a href="index.php?page=peminjaman">peminjaman</a></li>
												<li><a href="index.php?page=pengembalian">pengembalian</a></li>
												
											</ul>
										</li>
									<?php
									}
									?>
									

									

									<?php
									if ($_SESSION['level'] == 'pustakawan') {
										# code...
									?>
										<li class="nav-item">
											<a class="page-scroll" href="index.php?page=databuku">data buku</a>
											<ul class="sub-menu collapse" id="sub-nav">
												<li><a href="index.php?page=books">books</a></li>
												<li><a href="index.php?page=categories">category</a></li>
												<li><a href="index.php?page=pengarang">pengarang</a></li>
												<li><a href="index.php?page=penerbit">penerbit</a></li>
											</ul>
										</li>
									<?php
									}

									?>

									


									<?php
									if ($_SESSION['level'] == 'admin') {
										# code...

									?>
										<li class="nav-item">
											<a class="page-scroll" href="">data member</a>
											<ul class="sub-menu collapse" id="sub-nav">
												<li><a href="index.php?page=datamember">member</a></li>
												<li><a href="index.php?page=dataprodi">prodi</a></li>
											</ul>
										</li>
									<?php
									}
									?>
								</ul>
							</div>
							
<ul class="header-btn d-md-flex">
    <li>
        <a href="#" class="main-btn account-btn">
            <span class="d-md-none"><i class="lni lni-user"></i></span>
            <span class="d-none d-md-block">
                <?php
                if (isset($_SESSION['email'])) {
                    echo $_SESSION['email'];
                } else {
                    echo "My Account";
                }
                ?>
            </span>
        </a>
        <ul class="dropdown-nav">
            <?php
            if (isset($_SESSION['email'])) {
                // Jika sudah login, tampilkan opsi log out
            ?>
                <li><a href="login/logout.php">Log Out</a></li>
            <?php
            } else {
                // Jika belum login, tampilkan opsi log in
            ?>
                <li><a href="login/login.php">Log In</a></li>
            <?php
            }
            ?>
        </ul>
    </li>
</ul>

						</nav> <!-- navbar -->
					</div>
				</div> <!-- row -->
			</div> <!-- container -->
		</div> <!-- header navbar -->
	</header>






	<!--====== BACK TOP TOP PART START ======-->
	<a href="#" class="back-to-top btn-hover"><i class="lni lni-chevron-up"></i></a>
	<!--====== BACK TOP TOP PART ENDS ======-->


	<script src="https://kit.fontawesome.com/28a41f9557.js" crossorigin="anonymous"></script>

	<!--====== Bootstrap js ======-->
	<script src="assets/js/bootstrap.bundle-5.0.0.alpha-min.js"></script>

	<!--====== Tiny slider js ======-->
	<script src="assets/js/tiny-slider.js"></script>

	<!--====== wow js ======-->
	<script src="assets/js/wow.min.js"></script>

	<!--====== glightbox js ======-->
	<script src="assets/js/glightbox.min.js"></script>

	<!--====== Selectr js ======-->
	<script src="assets/js/selectr.min.js"></script>

	<!--====== Nouislider js ======-->
	<script src="assets/js/nouislider.js"></script>

	<!--====== Main js ======-->
	<script src="assets/js/main.js"></script>

	<script>
		//========= glightbox
		const myGallery = GLightbox({
			'href': 'assets/video/Free App Landing Page Template - AppLand.mp4',
			'type': 'video',
			'source': 'youtube', //vimeo, youtube or local
			'width': 900,
			'autoplayVideos': true,
		});

		//======== tiny slider for feature-product-carousel
		tns({
			slideBy: 'page',
			autoplay: false,
			mouseDrag: true,
			gutter: 20,
			nav: false,
			controls: true,
			controlsPosition: 'bottom',
			controlsText: [
				'<span class="prev"><i class="lni lni-chevron-left"></i></span>',
				'<span class="next"><i class="lni lni-chevron-right"></i></span>'
			],
			container: ".feature-product-carousel",
			items: 1,
			center: false,
			autoplayTimeout: 5000,
			swipeAngle: false,
			speed: 400,
			responsive: {
				768: {
					items: 2,
				},

				992: {
					items: 2,
				},

				1200: {
					items: 3,
				}
			}
		});

		//======== tiny slider for testimonial
		tns({
			slideBy: 'page',
			autoplay: false,
			mouseDrag: true,
			gutter: 20,
			nav: true,
			controls: false,
			container: ".testimonial-carousel",
			items: 1,
			center: false,
			autoplayTimeout: 5000,
			swipeAngle: false,
			speed: 400,
			responsive: {
				768: {
					items: 2,
				},
				1200: {
					items: 3,
				}
			}
		});
	</script>

	<?php
	$p = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
	if ($p == 'dashboard') include 'dashboard.php';
	if ($p == 'buku_tamu') include 'kunjungan/bukutamu.php';
	if ($p == 'detail-buku') include 'detail-buku.php';
	if ($p == 'peminjaman') include 'peminjaman/peminjaman.php';
	if ($p == 'pengembalian') include 'pengembalian.php';
	if ($p == 'books') include 'buku/books.php';
	if ($p == 'categories') include 'buku/kategori.php';
	if ($p == 'pengarang') include 'buku/pengarang.php';
	if ($p == 'penerbit') include 'buku/penerbit.php';
	if ($p == 'dataprodi') include 'prodi/dataprodi.php';
	if ($p == 'bookcategory') include 'book-category.php';
	if ($p == 'book-list') include 'book-list.php';
	if ($p == 'datamember') include 'datamember/datamember.php';
	if ($p == 'logout') include 'login/logout.php';
	?>



</body>

</html>