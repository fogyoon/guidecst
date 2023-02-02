<?php
// head와 로고, navbar는 여기서 수정하세요.

require_once("inc/utils.inc");

// 로그인 결과
if (isset($_POST['signinresult'])){
	$signinresult = $_POST['signinresult'];
} else {
	$signinresult = false;
}

// 상당문의 이메일 보내기
$now_send_inquiry = false;
$send_inquiry_result= false;
if (isset($_POST['send_inquiry'])) {
	$now_send_inquiry = true;
	if (isset($_POST['inquiryRegnumber'])) {
		$transferNo = isset($_POST['inquiryRegnumber']);
	} else {
		$transferNo = "";
	}
	$send_inquiry_result = send_inquiry($_POST['inquiryClassfication'], $_POST['inquiryName'], $_POST['inquiryPhone'], $_POST['inquiryEmail'], $_POST['inquiryMessage'], $transferNo);
}

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
	<meta property="og:image" content="http://<?=$config['home_url']?>/assets/img/Logo_u2.svg">
	<meta property="og:url" content="<?= $config['full_url'] ?><?php echo $_SERVER['PHP_SELF']; ?>">
	<meta name="naver-site-verification" content="" />
	<meta name="msvalidate.01" content="" />
	<link rel="apple-touch-icon" href="assects/apple-touch-icon.png" />
	<link rel="shortcut icon" href="assets/favicon.ico" />
	<title><?= $title ?></title>
	<!-- Favicon-->
	<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
	<!-- bootstrap icons -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet" />
	<link href="css/guidecst.css" rel="stylesheet" />

	<!-- We may no need jquery	-->
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"> </script> -->
	<!-- Bootstrap core JS-->
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Core theme JS-->
	<script src="js/scripts.js"></script>

	<link rel="stylesheet" href="css/Full_Division_iconSlide.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
	<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


</head>

<body id="page-top">
	<!-- Navigation-->
	<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
		<div class="container">
			<!-- <a class="navbar-brand" href="index.php"> <img src="assets/img/Logo-u1.svg" alt="..." /></a> -->
			<a class="text-logo" href="index.php"><img class="my_img" src="/assets/img/Logo_u2.svg"></a>
			<button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				Menu
				<i class="fas fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ms-auto">
					<?php foreach ($config['page_files'] as $page_name => $page_file) : ?>
						<?php if($page_name == "신규건설업등록"):?>
							<li class="nav-item dropdown mx-0 mx-lg-1">
								<a class="nav-link dropdown-toggle py-3 px-0 px-lg-3 rounded <?php if ($thispage_filename == $page_file || ($thispage_filename == $config['page_other_files']['신규건설업등록수정'])) echo "active"; ?>" href="#" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false"><?= $page_name ?></a>
								<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
									<li><a class="dropdown-item" href="<?= $page_file ?>?general">종합건설업</a></li>
									<li><a class="dropdown-item" href="<?= $page_file ?>?pro">전문건설업</a></li>
									<li><a class="dropdown-item" href="<?= $page_file ?>?others">기타공사업</a></li>
								</ul>
							</li>
						<?php else:?>
							<li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded <?php if ($thispage_filename == $page_file || (($thispage_filename == $config['page_other_files']['양도양수정보'] || $thispage_filename == $config['page_other_files']['양도양수수정'] || $thispage_filename == $config['page_other_files']['양도양수절차']) && $page_file == $config['page_files']['양도양수'])) echo "active"; ?>" href="<?= $page_file ?>"><?= $page_name ?></a></li>
						<?php endif;?>
					<?php endforeach; ?>
					<li class="nav-item mx-0 mx-lg-1">
						<button class="btn btn-primary rounded-pill  my-2" data-bs-toggle="modal" data-bs-target="#inquiryModal">
							<span class="d-flex align-items-center"><i class="bi-chat-text-fill me-2"></i>상담문의</span>
						</button>
					</li>
					<?php if ($userlogin):?>
						<li class="nav-item mx-0 mx-lg-1">
							<button class="btn btn-warning my-2" onclick="location.href='loginprocess.php?signout&retpage=<?=$thispage_filename?>'">로그아웃</button>
						</li>
					<?php endif;?>

				</ul>
			</div>
		</div>
	</nav>