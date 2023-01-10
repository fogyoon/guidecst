<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 
//include("inc/sql.inc"); //mysql 관련 functions
//include("inc/utils.inc"); //그외 functions 

$title = "Guide Consulting";
$description = "건설업 양도 양수";
$keywords = "건설업, ";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="masthead text-center back-img01">
	<div class="container d-flex align-items-center flex-column">
		<!-- Icon Divider-->
		<div class="divider-custom-icon" style="color:#00a0e9; margin-bottom:1%;">
			<i class="fas fa-star"></i>
			<i class="fas fa-star"></i>
			<i class="fas fa-star"></i>
			<i class="fas fa-star"></i>
			<i class="fas fa-star"></i>
		</div>
		<h1 class="masthead-heading text-uppercase mb-0 sr-icon-1">! Best of Best !</h1>

		<!-- Masthead Subheading-->
		<p class="masthead-subheading font-weight-light sr-icon-4" style="margin-top:1%; margin-bottom:10%;"><b>가이드컨설팅</b>에서는 <b>가능성의 문</b>을 열어갑니다.</p>

		<!-- Masthead Avatar Image-->
		<div class="row justify-content-md-center gy-3 mt-md-5">
			<div class="col"><a href="<?= $config['page_files']['양도양수'] ?>"><img class="my_img" src="assets/img/go1.svg"></a></div>
			<div class="col"><a href="<?= $config['page_files']['면허등록기준'] ?>"><img class="my_img" src="assets/img/go2.svg"></a></div>
			<div class="col d-none d-md-block" data-bs-toggle="modal" data-bs-target="#inquirykModal"><img class="my_img" src="assets/img/go3.svg"></div>
		</div>

		<!-- Masthead Heading-->
	</div>
</header>
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
		<div class="row justify-content-center">
			<!-- Portfolio Item 1-->
			<div class="col-md-6 col-lg-4 mb-5">
				<div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
					<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
						<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
					</div>
					<img class="img-fluid" src="assets/img/portfolio/cabin.png" alt="..." />
				</div>
			</div>
			<!-- Portfolio Item 2-->
			<div class="col-md-6 col-lg-4 mb-5">
				<div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
					<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
						<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
					</div>
					<img class="img-fluid" src="assets/img/portfolio/cake.png" alt="..." />
				</div>
			</div>
			<!-- Portfolio Item 3-->
			<div class="col-md-6 col-lg-4 mb-5">
				<div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
					<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
						<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
					</div>
					<img class="img-fluid" src="assets/img/portfolio/circus.png" alt="..." />
				</div>
			</div>
			<!-- Portfolio Item 4-->
			<div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
				<div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal4">
					<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
						<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
					</div>
					<img class="img-fluid" src="assets/img/portfolio/game.png" alt="..." />
				</div>
			</div>
			<!-- Portfolio Item 5-->
			<div class="col-md-6 col-lg-4 mb-5 mb-md-0">
				<div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal5">
					<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
						<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
					</div>
					<img class="img-fluid" src="assets/img/portfolio/safe.png" alt="..." />
				</div>
			</div>
			<!-- Portfolio Item 6-->
			<div class="col-md-6 col-lg-4">
				<div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal6">
					<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
						<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
					</div>
					<img class="img-fluid" src="assets/img/portfolio/submarine.png" alt="..." />
				</div>
			</div>
		</div>
	</div>
</section>
<!-- About Section-->
<section class="page-section bg-primary text-white mb-0" id="about">
	<div class="container">
		<!-- About Section Heading-->
		<h2 class="page-section-heading text-center text-uppercase text-white sr-icon-1">VISION OF US</h2>
		<!-- Icon Divider-->
		<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>
		<!-- About Section Content-->
		<div class="row">
			<div class="col-lg-4 ms-auto">
				<p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional SASS stylesheets for easy customization.</p>
			</div>
			<div class="col-lg-4 me-auto">
				<p class="lead">You can create your own custom avatar for the masthead, change the icon in the dividers, and add your email address to the contact form to make it fully functional!</p>
			</div>
		</div>
		<!-- About Section Button-->
		<div class="text-center mt-4">
			<a class="btn btn-xl btn-outline-light" href="https://startbootstrap.com/theme/freelancer/">
				<i class="fas fa-download me-2"></i>
				Free Download!
			</a>
		</div>
	</div>
</section>

<!-- Portfolio Modals-->
<!-- Portfolio Modal 1-->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
			<div class="modal-body text-center pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<!-- Portfolio Modal - Title-->
							<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Log Cabin</h2>
							<!-- Icon Divider-->
							<div class="divider-custom">
								<div class="divider-custom-line"></div>
								<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
								<div class="divider-custom-line"></div>
							</div>
							<!-- Portfolio Modal - Image-->
							<img class="img-fluid rounded mb-5" src="assets/img/portfolio/cabin.png" alt="..." />
							<!-- Portfolio Modal - Text-->
							<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
							<button class="btn btn-primary" data-bs-dismiss="modal">
								<i class="fas fa-xmark fa-fw"></i>
								Close Window
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Portfolio Modal 2-->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
			<div class="modal-body text-center pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<!-- Portfolio Modal - Title-->
							<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Tasty Cake</h2>
							<!-- Icon Divider-->
							<div class="divider-custom">
								<div class="divider-custom-line"></div>
								<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
								<div class="divider-custom-line"></div>
							</div>
							<!-- Portfolio Modal - Image-->
							<img class="img-fluid rounded mb-5" src="assets/img/portfolio/cake.png" alt="..." />
							<!-- Portfolio Modal - Text-->
							<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
							<button class="btn btn-primary" data-bs-dismiss="modal">
								<i class="fas fa-xmark fa-fw"></i>
								Close Window
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Portfolio Modal 3-->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
			<div class="modal-body text-center pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<!-- Portfolio Modal - Title-->
							<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Circus Tent</h2>
							<!-- Icon Divider-->
							<div class="divider-custom">
								<div class="divider-custom-line"></div>
								<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
								<div class="divider-custom-line"></div>
							</div>
							<!-- Portfolio Modal - Image-->
							<img class="img-fluid rounded mb-5" src="assets/img/portfolio/circus.png" alt="..." />
							<!-- Portfolio Modal - Text-->
							<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
							<button class="btn btn-primary" data-bs-dismiss="modal">
								<i class="fas fa-xmark fa-fw"></i>
								Close Window
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Portfolio Modal 4-->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" aria-labelledby="portfolioModal4" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
			<div class="modal-body text-center pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<!-- Portfolio Modal - Title-->
							<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Controller</h2>
							<!-- Icon Divider-->
							<div class="divider-custom">
								<div class="divider-custom-line"></div>
								<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
								<div class="divider-custom-line"></div>
							</div>
							<!-- Portfolio Modal - Image-->
							<img class="img-fluid rounded mb-5" src="assets/img/portfolio/game.png" alt="..." />
							<!-- Portfolio Modal - Text-->
							<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
							<button class="btn btn-primary" data-bs-dismiss="modal">
								<i class="fas fa-xmark fa-fw"></i>
								Close Window
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Portfolio Modal 5-->
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" aria-labelledby="portfolioModal5" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
			<div class="modal-body text-center pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<!-- Portfolio Modal - Title-->
							<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Locked Safe</h2>
							<!-- Icon Divider-->
							<div class="divider-custom">
								<div class="divider-custom-line"></div>
								<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
								<div class="divider-custom-line"></div>
							</div>
							<!-- Portfolio Modal - Image-->
							<img class="img-fluid rounded mb-5" src="assets/img/portfolio/safe.png" alt="..." />
							<!-- Portfolio Modal - Text-->
							<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
							<button class="btn btn-primary" data-bs-dismiss="modal">
								<i class="fas fa-xmark fa-fw"></i>
								Close Window
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Portfolio Modal 6-->
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" aria-labelledby="portfolioModal6" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
			<div class="modal-body text-center pb-5">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-lg-8">
							<!-- Portfolio Modal - Title-->
							<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Submarine</h2>
							<!-- Icon Divider-->
							<div class="divider-custom">
								<div class="divider-custom-line"></div>
								<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
								<div class="divider-custom-line"></div>
							</div>
							<!-- Portfolio Modal - Image-->
							<img class="img-fluid rounded mb-5" src="assets/img/portfolio/submarine.png" alt="..." />
							<!-- Portfolio Modal - Text-->
							<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia neque assumenda ipsam nihil, molestias magnam, recusandae quos quis inventore quisquam velit asperiores, vitae? Reprehenderit soluta, eos quod consequuntur itaque. Nam.</p>
							<button class="btn btn-primary" data-bs-dismiss="modal">
								<i class="fas fa-xmark fa-fw"></i>
								Close Window
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<!-- * *                               SB Forms JS                               * *-->
<!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
<!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>


<script src="js/scrollreveal.min.js"></script>

<script>
	(function($) {
		"use strict"; // Start of use strict

		// Scroll reveal calls
		window.sr = ScrollReveal();

		sr.reveal('.sr-icon-1', {
			delay: 200,
			scale: 0
		});
		sr.reveal('.sr-icon-2', {
			delay: 300,
			scale: 0
		});
		sr.reveal('.sr-icon-3', {
			delay: 400,
			scale: 0
		});
		sr.reveal('.sr-icon-4', {
			delay: 500,
			scale: 0
		});
		sr.reveal('.sr-button', {
			delay: 200,
			distance: '15px',
			origin: 'bottom',
			scale: 0.8
		});
		sr.reveal('.sr-contact-1', {
			delay: 200,
			scale: 0
		});
		sr.reveal('.sr-contact-2', {
			delay: 400,
			scale: 0
		});

	})(jQuery); // End of use strict
</script>




<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>