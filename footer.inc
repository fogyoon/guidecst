<?php
// footer는 여기서 수정하세요.

?>

<section id="Full_Division_iconSlide">
	<h1 style="display:none">Full_Division_iconSlide</h1>
	<div class="sectionWrap">
		<div class="prevWrap">
			<div class="swiper-button-prev iconSlidePrev"> <i class="fa-solid fa-arrow-left"></i> </div>
		</div>
		<div class="swiper iconSlide">
			<div class="swiper-wrapper">
				<div class="swiper-slide">
					<a href="http://www.cak.or.kr/main.do" target="_blank"><img src="assets/img/iconSlide_01.png" alt="대한건설협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.kosca.or.kr/" target="_blank"><img src="assets/img/iconSlide_02.png" alt="대한전문건설협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.kosca.or.kr/" target="_blank"><img src="assets/img/iconSlide_03.png" alt="대한기계설비협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.khba.or.kr/khbaGo.do" target="_blank"><img src="assets/img/iconSlide_04.png" alt="대한주택건설협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.keca.or.kr/main" target="_blank"><img src="assets/img/iconSlide_05.png" alt="한국전기공사협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.kica.or.kr/index" target="_blank"><img src="assets/img/iconSlide_06.png" alt="한국정보통신공사협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="http://www.koda.or.kr" target="_blank"><img src="assets/img/iconSlide_07.png" alt="한국부동산개발협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.ekffa.or.kr/front" target="_blank"><img src="assets/img/iconSlide_08.png" alt="한국소방시설협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://homenet.kocea.or.kr:1443/home/index.do" target="_blank"><img src="assets/img/iconSlide_09.png" alt="한국건설기술인협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.keea.or.kr/head/main/main.do" target="_blank"><img src="assets/img/iconSlide_10.png" alt="한국전기기술인협회"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.cgbest.co.kr/cgbest/index.do" target="_blank"><img src="assets/img/iconSlide_11.png" alt="건설공제조합"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.kscfc.co.kr/index.jsp" target="_blank"><img src="assets/img/iconSlide_12.png" alt="전문건설공제조합"></a>
				</div>
				<div class="swiper-slide">
					<a href="http://www.seolbi.com/main.do" target="_blank"><img src="assets/img/iconSlide_13.png" alt="기계설비건설공제조합"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.ecfc.co.kr/main.do" target="_blank"><img src="assets/img/iconSlide_14.png" alt="전기공사공제조합"></a>
				</div>
				<div class="swiper-slide">
					<a href="https://www.icfc.or.kr:7443/new_ver/main.jsp" target="_blank"><img src="assets/img/iconSlide_15.png" alt="정보통신공제조합"></a>
				</div>
				<div class="swiper-slide">
					<a href="http://www.figu.or.kr/main.do?" target="_blank"><img src="assets/img/iconSlide_16.png" alt="소방산업공제조합"></a>
				</div>
				<div class="swiper-slide">
					<a href="http://www.molit.go.kr/portal.do" target="_blank"><img src="assets/img/iconSlide_17.png" alt="국토부"></a>
				</div>
				<div class="swiper-slide">
					<a href="http://www.iros.go.kr/PMainJ.jsp" target="_blank"><img src="assets/img/iconSlide_18.png" alt="인터넷등기소"></a>
				</div>
			</div>
		</div>
		<div class="nextWrap">
			<div class="swiper-button-next iconSlideNext"> <i class="fa-solid fa-arrow-right"></i> </div>
		</div>
	</div>
</section>

<script>
	const iconSlide = new Swiper(".iconSlide", {
		loop: true,
		navigation: {
			nextEl: ".swiper-button-next.iconSlideNext",
			prevEl: ".swiper-button-prev.iconSlidePrev",
		},
		autoplay: { // 자동 슬라이드 설정 , 비 활성화 시 false
			delay: 3000, // 시간 설정
			disableOnInteraction: false, // false로 설정하면 스와이프 후 자동 재생이 비활성화 되지 않음
		},
		breakpoints: { // 반응형 설정이 가능 width값으로 조정
			0: {
				slidesPerView: 1,
				spaceBetween: 10,
			},
			700: {
				slidesPerView: 3,
				spaceBetween: 30,
			},
			1025: {
				slidesPerView: 4,
				spaceBetween: 40,
			},
			1548: {
				slidesPerView: 6,
				spaceBetween: 60,
			},
		},
	});
</script>

<script src="js/scripts.js"></script>
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


<!-- Footer-->
<footer class="footer text-center">
	<div class="container">
		<div class="row justify-content-center mb-3">
			<!-- Footer Social Icons-->
			<div class="col-lg-4">
				<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
				<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
				<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-linkedin-in"></i></a>
				<a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-dribbble"></i></a>
			</div>
		</div>
		<nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">상호</span>: <?= $config['company_kr_name'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">주소</span>: <?= $config['company_address'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">전화</span>: <?= $config['company_tel'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">사업자등록번호</span>: <?= $config['company_license'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">팩스</span>: <?= $config['company_fax'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">이메일</span>: <?= $config['company_email'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">개인정보처리담당자</span>: <?= $config['company_privacy_manager'] ?></li>
			</ol>
		</nav>
	</div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
	<div class="container">
		<small>Copyright &copy; 2022 <?= $config['company_en_name'] ?>. ALL RIGHT RESERVED
			<div class="row justify-content-center mt-2">
				<div class="col col-lg-2 col-md-4"><a class="footer-link" id="PrivacyPlicy_link" class="footer_link" data-bs-toggle="modal" data-bs-target="#PrivacyPlicy">개인정보처리방침</a></div>
				|
				<div class="col col-lg-2 col-md-4"><a class="footer-link" id="emailCollectionReject_link" class="footer_link" data-bs-toggle="modal" data-bs-target="#emailCollectionReject">이메일무단수집거부</a></div>
			</div>
		</small>
	</div>
</div>

<!-- 개인정보취급방침 이메일무단수집거부 modal -->
<div class="modal fade" id="PrivacyPlicy" tabindex="-1" aria-labelledby="PrivacyPlicyLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="PrivacyPlicyLabel">개인정보 취급방침</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?= $privacypolicy ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="emailCollectionReject" tabindex="-1" aria-labelledby="emailCollectionRejectLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="emailCollectionRejectLabel">이메일 무단수집 거부</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?= $emailcollectionreject ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>

<!-- 문의하기 modal -->
<div class="modal fade" id="inquirykModal" tabindex="-1" aria-labelledby="inquirykModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content px-md-3 px-lg-5 py-3" id="inquirykModalContent">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="inquirykModalLabel">문의하실 내용을 입력해 보내주시면 연락 드리겠습니다.</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="inquiryForm" action="<?= $thispage_filename ?>" method="post">
					<div class="mb-3">
						<select name="inquiryClassfication" class="form-select" id="Select" style="height: calc(3.5rem + 2px);" type="text" placeholder="상담 문의 내용 선택" required>
							<option value="">문의사항 분류를 선택해 주세요.</option>
							<?php foreach ($config['inquiry_classfication'] as $inqiry_class) : ?>
								<option value="<?= $inqiry_class ?>"><?= $inqiry_class ?></option>
							<?php endforeach; ?>
						</select>
						<!-- <label for="Select">상담 구분</label> -->
					</div>
					<!-- Name input-->
					<div class="form-floating mb-3">
						<input name="inquiryName" class="form-control" id="inquiryname" type="text" placeholder="신청자명..." required />
						<label for="inquiryname">신청자명 or 회사명</label>
					</div>
					<!-- Phone number input-->
					<div class="form-floating mb-3">
						<input name="" class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" required />
						<label for="phone">전화번호</label>
					</div>
					<!-- Email address input-->
					<div class="form-floating mb-3">
						<input name="inquiryEmail" class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" required />
						<label for="email">이메일 주소</label>
					</div>
					<!-- Message input-->
					<div class="form-floating mb-3">
						<textarea name="inquiryMessage" class="form-control" id="message" type="text" placeholder="문의 내용..." style="height: 10rem" required></textarea>
						<label for="message">문의 내용</label>
					</div>
					<!-- Submit Button-->
					<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" id="submitButton" type="submit">문의 내용 보내기</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>  -->
<!-- Core theme JS-->
<script src="js/scripts.js"></script>

<!-- 아래 form.js는 필요 없을 듯합니다. -->
<!-- <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> -->


<!-- Global site tag (gtag.js) - Google Ads: 10927073323 -->
<!--
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-10927073323"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', 'AW-10927073323');
	</script>
	-->


</body>

</html>