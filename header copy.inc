<?php
// head와 로고, navbar는 여기서 수정하세요.
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="<?= $description ?>">
	<meta name="author" content="PrindDesign">
	<meta name="keywords" content="<?= $keywords ?>" />
	<meta property="og:type" content="website">
	<meta property="og:title" content="<?= $title ?>">
	<meta property="og:description" content="<?= $description ?>">
	<meta property="og:image" content="http://www.guideconsulting.co.kr/assets/img/G_Logo.svg">
	<meta property="og:url" content="<?= $config['full_url'] ?><?php echo $_SERVER['PHP_SELF']; ?>">
	<meta name="naver-site-verification" content="" />
	<meta name="msvalidate.01" content="" />
	<link rel="apple-touch-icon" href="assects/apple-touch-icon.png" />
	<link rel="shortcut icon" href="assets/favicon.ico" />
	<title><?= $title ?></title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- bootstrap icons -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
	<!-- Font Awesome icons (free version)-->
	<script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
	<!-- Google fonts-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet">
	<!-- Gmarketsans fonts-->
	<link href="https://webfontworld.github.io/gmarket/GmarketSans.css" rel="stylesheet">
	<!-- Core theme CSS (includes Bootstrap)-->
	<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/guidecst.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

	<!-- We may no need jquery
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	-->

	<link rel="stylesheet" href="css/Full_Division_iconSlide.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

</head>

<body id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
		<div class="container">
			<a href="index.php"> <img src="assets/img/G_Logo.svg" alt="..." /></a>
			<button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ms-auto">
					<?php foreach ($config['page_files'] as $page_name => $page_file) : ?>
						<li class="nav-item mx-0 mx-lg-1 my_img"><a class="nav-link py-3 px-0 px-lg-3 rounded <?php if ($thispage_filename == $page_file) echo "active"; ?>" href="<?= $page_file ?>"><?= $page_name ?></a></li>
					<?php endforeach; ?>
				</ul>
				<button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#inquirykModal">
					<span class="d-flex align-items-center"><i class="bi-chat-text-fill me-2"></i>상담 문의</span>
				</button>
			</div>
		</div>
	</nav>

