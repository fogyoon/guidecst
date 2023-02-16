<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다.
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = $config['company_kr_name_short'];
$description = "건설업 양도 양수";
$keywords = "건설업, ";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<div id="carouselMasthead" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-pause="none">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#carouselMasthead" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#carouselMasthead" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#carouselMasthead" data-bs-slide-to="2" aria-label="Slide 3"></button>
	</div>
	<div class="carousel-inner">
		<header class="carousel-item active mastheadcarousel back-img01" data-bs-interval="6000">
			<div class="carousel-caption d-flex align-items-center flex-column">
				<!-- <div class="d-flex align-items-center flex-column"> -->
				<!-- Icon Divider-->
				<div class="divider-custom-icon" style="color:#00a0e9; margin-top:18%; margin-bottom:3vh;">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
				</div>
				<h1 class="masthead-heading text-uppercase mb-2 sr-icon-1">Best of the Best</h1>

				<!-- Masthead Subheading-->
				<div class="masthead-subheading font-weight-light sr-icon-4" style="margin-top:1vh; margin-bottom:15vh;"><b>유원건설정보</b>에서는 <b>가능성의 문</b>을 열어갑니다.<br>
				<div class="mb-2 mt-3"><i class="fas fa-phone"></i> <b>032-209-1422</b></div>
				</div>
				<!-- Masthead Avatar Image-->
				<div class="row justify-content-md-center gy-3 mt-md-4 mb-2">
					<div class="col"><a href="<?= $config['page_files']['양도양수'] ?>"><img class="my_img" src="assets/img/go1.svg"></a></div>
					<div class="col"><a href="<?= $config['page_files']['신규건설업등록'] ?>"><img class="my_img" src="assets/img/go2.svg"></a></div>
					<div class="col d-none d-md-block" data-bs-toggle="modal" data-bs-target="#inquiryModal"><img class="my_img" src="assets/img/go3.svg"></div> 
					<?php //<div class="col d-none d-md-block"><a href="/contact.php"><img class="my_img" src="assets/img/go3.svg"></a></div>?>
				</div>
				<!-- </div> -->
			</div>
		</header>

		<header class="carousel-item active mastheadcarousel back-img02" data-bs-interval="6000">
			<div class="carousel-caption d-flex align-items-center flex-column">
				<!-- <div class="d-flex align-items-center flex-column"> -->
				<!-- Icon Divider-->
				<div class="divider-custom-icon" style="color:#00a0e9; margin-top:18%; margin-bottom:3vh;">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
				</div>
				<h1 class="masthead-heading text-uppercase mb-2 sr-icon-1">open mind</h1>

				<!-- Masthead Subheading-->
				<div class="masthead-subheading font-weight-light sr-icon-4" style="margin-top:1vh; margin-bottom:15vh;"><b>보다나은 세상</b>을 위한 새로운 <b>미래창조</b><br>
				<div class="mb-2 mt-3"><i class="fas fa-phone"></i> <b>032-209-1422</b></div>
				</div>
				<!-- Masthead Avatar Image-->
				<div class="row justify-content-md-center gy-3 mt-md-4 mb-2">
					<div class="col"><a href="<?= $config['page_files']['양도양수'] ?>"><img class="my_img" src="assets/img/go1.svg"></a></div>
					<div class="col"><a href="<?= $config['page_files']['신규건설업등록'] ?>"><img class="my_img" src="assets/img/go2.svg"></a></div>
					<div class="col d-none d-md-block" data-bs-toggle="modal" data-bs-target="#inquiryModal"><img class="my_img" src="assets/img/go3.svg"></div> 
					<?php //<div class="col d-none d-md-block"><a href="/contact.php"><img class="my_img" src="assets/img/go3.svg"></a></div>?>
				</div>
				<!-- </div> -->
			</div>
		</header>


		<header class="carousel-item active mastheadcarousel back-img03" data-bs-interval="6000">
			<div class="carousel-caption d-flex align-items-center flex-column">
				<!-- <div class="d-flex align-items-center flex-column"> -->
				<!-- Icon Divider-->
				<div class="divider-custom-icon" style="color:#00a0e9; margin-top:18%; margin-bottom:3vh;">
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
					<i class="fas fa-star"></i>
				</div>
				<h1 class="masthead-heading text-uppercase mb-2 sr-icon-1">fly to the sky</h1>

				<!-- Masthead Subheading-->
				<div class="masthead-subheading font-weight-light sr-icon-4" style="margin-top:1vh; margin-bottom:15vh;"><b>유원건설정보</b>에서 <b>날개</b>를 달아드립니다.<br>
				<div class="mb-2 mt-3"><i class="fas fa-phone"></i> <b>032-209-1422</b></div>
				</div>
				<!-- Masthead Avatar Image-->
				<div class="row justify-content-md-center gy-3 mt-md-4 mb-2">
					<div class="col"><a href="<?= $config['page_files']['양도양수'] ?>"><img class="my_img" src="assets/img/go1.svg"></a></div>
					<div class="col"><a href="<?= $config['page_files']['신규건설업등록'] ?>"><img class="my_img" src="assets/img/go2.svg"></a></div>
					<div class="col d-none d-md-block" data-bs-toggle="modal" data-bs-target="#inquiryModal"><img class="my_img" src="assets/img/go3.svg"></div> 
					<?php //<div class="col d-none d-md-block"><a href="/contact.php"><img class="my_img" src="assets/img/go3.svg"></a></div>?>
				</div>
				<!-- </div> -->
			</div>
		</header>



	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselMasthead" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselMasthead" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>

<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
	<div class="container">
		<!-- Portfolio Section Heading-->
		<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 sr-icon-1">WHAT WE DO</h2>
		<!-- Icon Divider-->
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>
		<!-- Portfolio Grid Items-->
		<div class="row gy-3 gy-md-3 gy-lg-5 justify-content-around">
			<!-- Portfolio Item 1-->
			<div class="card px-0" style="width: 25rem;">
				<a href="<?= $config['page_files']['양도양수'] ?>" class="img-hover-zoom"><img src="/assets/img/what06.jpg" class="card-img-top" alt="..."></a>
				<div class="card-body">
					<h5 class="card-title sr-icon-1">양도양수 안내</h5>
					<p class="card-text font-nanumgothic">특정회사의 주식을 소유한 주주가 주식을 다른 사람에게 양도하고, 이를 증명하기 위해 작성하는 문서</p>
					<a href="<?= $config['page_files']['양도양수'] ?>" class="btn btn-primary"><i class="fas fa-magnifying-glass  me-2"></i>자세히 알아보기</a>
				</div>
			</div>
			<!-- Portfolio Item 2-->
			<div class="card px-0" style="width: 25rem;">
				<a href="<?= $config['page_files']['신규건설업등록'] ?>" class="img-hover-zoom"><img src="/assets/img/what01.jpg" class="card-img-top" alt="..."></a>
				<div class="card-body">
					<h5 class="card-title sr-icon-1">신규건설업등록 안내</h5>
					<p class="card-text font-nanumgothic">다양한 공사의 업무내용에 따라 신규건설업등록이 상이하여 자본금, 공제조합, 기술인력, 등을 안내합니다. </p>
					<a href="<?= $config['page_files']['신규건설업등록'] ?>" class="btn btn-primary"><i class="fas fa-magnifying-glass  me-2"></i>자세히 알아보기</a>
				</div>
			</div>
			<!-- Portfolio Item 3-->
			<div class="card px-0" style="width: 25rem;">
				<a href="<?= $config['page_files']['기업진단'] ?>" class="img-hover-zoom"><img src="/assets/img/what03.jpg" class="card-img-top" alt="..."></a>
				<div class="card-body">
					<h5 class="card-title sr-icon-1">기업진단 정보</h5>
					<p class="card-text font-nanumgothic">관할관청에 등록을 필요로 하는 업종에 한하여 진단 대상 사업 실질자본금을 산출하는 과정의 결과입니다.</p>
					<a href="<?= $config['page_files']['기업진단'] ?>" class="btn btn-primary"><i class="fas fa-magnifying-glass  me-2"></i>자세히 알아보기</a>
				</div>
			</div>
			<!-- Portfolio Item 4-->
			<div class="card px-0" style="width: 25rem;">
				<a href="<?= $config['page_files']['분할합병 및 법인전환'] ?>" class="img-hover-zoom"><img src="/assets/img/what02.jpg" class="card-img-top" alt="..."></a>
				<div class="card-body">
					<h5 class="card-title sr-icon-2">분할합병 및 법인전환</h5>
					<p class="card-text  font-nanumgothic">상법, 세법, 건설산업기본법 등 각종 공사업법을 알아야하므로 경험이 많은 전문가의 자문이 필요합니다. </p>
					<a href="<?= $config['page_files']['분할합병 및 법인전환'] ?>" class="btn btn-primary"><i class="fas fa-magnifying-glass  me-2"></i>자세히 알아보기</a>
				</div>
			</div>
			<!-- Portfolio Item 5-->
			<div class="card px-0" style="width: 25rem;">
				<a href="<?= $config['page_files']['연말결산'] ?>" class="img-hover-zoom"><img src="/assets/img/what07.jpg" class="card-img-top" alt="..."></a>
				<div class="card-body">
					<h5 class="card-title sr-icon-2">연말결산 / 잔고증명</h5>
					<p class="card-text font-nanumgothic">건설업 관리규정에 의한 실질 자본금 인정기준을 확인해서 자본금 미달이 발생하지 않도록 대비해야합니다.</p>
					<a href="<?= $config['page_files']['연말결산'] ?>" class="btn btn-primary"><i class="fas fa-magnifying-glass  me-2"></i>자세히 알아보기</a>
				</div>
			</div>
			<!-- Portfolio Item 6-->
			<div class="card px-0" style="width: 25rem;">
				<a href="<?= $config['page_files']['회사소개'] ?>" class="img-hover-zoom"><img src="/assets/img/what05.jpg" class="card-img-top" alt="..."></a>
				<div class="card-body">
					<h5 class="card-title sr-icon-2">회사소개</h5>
					<p class="card-text  font-nanumgothic">유원건설정보는 창업부터 성장, 경영운영, 양도양수 등 건설업의 전문적이고 앞선 컨설팅을 자부합니다. </p>
					<a href="<?= $config['page_files']['회사소개'] ?>" class="btn btn-primary"><i class="fas fa-magnifying-glass  me-2"></i>자세히 알아보기</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
	<div class="container">
		<!-- About Section Heading-->
		<h2 class="page-section-heading text-center text-uppercase text-white sr-icon-1">profession</h2>
		<!-- Icon Divider-->
		<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>
		<!-- About Section Content-->
		<div class="row">
			<div class="col-lg-11 ms-auto font-nanumgothic">
				<p class="lead">유원건설정보는 빠르게 변화하는 건설업에서 다년간의 경험과 축적된 노하우을 가지고 각각의 기업상황에 맞는 정보를 제공하고있습니다.<br>
					양도양수, 기업진단, 신규건설업등록, 경영운영의 전반에 걸친 정확하고 믿을수 있는 맞춤형정보로 앞선 컨설팅을 해드립니다.</p>
			</div>

		</div>
		<!-- About Section Button-->
		
		<div class="text-center mt-4 mb-0">
			<a class="btn btn-xl btn-outline-light"  data-bs-toggle="modal" data-bs-target="#inquiryModal">
				<i class="fas fa-pen-to-square  me-2"></i>
				상담문의 남기기
			</a>
		</div>
	</div>
</section>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>