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

<!-- Footer-->
<footer class="footer text-center">
	<div class="container">
		<div class="row justify-content-center mb-3">
			<!-- Footer Social Icons-->
			<div class="col-lg-4">
				<a class="btn btn-outline-light btn-social mx-1" href="<?=$config['blog_link']?>" title="<?=$config['company_kr_name_short']?> 블로그"><img src="assets/img/naver_blog.png" alt="u1info 네이버 블로그"></img></a>
				<a class="btn btn-outline-light btn-social mx-1" href="<?=$config['facebook_link']?>" title="<?=$config['company_kr_name_short']?> 페이스북"><i class="fab fa-fw fa-facebook-f"></i></a>
				<a class="btn btn-outline-light btn-social mx-1" href="<?=$config['twitter_link']?>" title="<?=$config['company_kr_name_short']?> 트위터"><i class="fab fa-fw fa-twitter"></i></a>
				<a class="btn btn-outline-light btn-social mx-1" href="<?=$config['insta_link']?>" title="<?=$config['company_kr_name_short']?> 인스타그램"><i class="bi bi-instagram" style="font-size:1.1em"></i></a>
			</div>
		</div>
		<nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">상호</span>: <?= $config['company_kr_name'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">주소</span>: <?= $config['company_address'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">전화</span>: <?= $config['company_tel'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">사업자등록번호</span>: <?= $config['company_license'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">팩스</span>: <?= $config['company_fax'] ?></li>
				<li class="breadcrumb-item footer-info"><span class="fw-bolder">개인정보처리담당자</span>: <?= $config['company_privacy_manager'] ?></li>
			</ol>
		</nav>
	</div>
</footer>
<!-- Copyright Section-->
<div class="copyright py-4 text-center text-white">
	<div class="container text-cetner">
		<div class="row">
			<div class="col-12 mb-2">Copyright &copy; 2022 <?= $config['company_en_name'] ?>. ALL RIGHT RESERVED</div>
			<div class="col-12">
				<nav style="--bs-breadcrumb-divider: '|';" aria-label="breadcrumb">
					<ol class="breadcrumb d-flex flex-row justify-content-center">
						<li class="breadcrumb-item d-flex "><a class="footer-link" id="PrivacyPlicy_link" class="footer_link" data-bs-toggle="modal" data-bs-target="#PrivacyPlicy" style="cursor: pointer">개인정보처리방침</a></li>
						<li class="breadcrumb-item d-flex "><a class="footer-link" id="emailCollectionReject_link" class="footer_link" data-bs-toggle="modal" data-bs-target="#emailCollectionReject" style="cursor: pointer">이메일무단수집거부</a></li>
						<li class="breadcrumb-item d-flex "><a class="footer-link" id="singin_link" class="footer_link" data-bs-toggle="modal" data-bs-target="#signinModal" style="cursor: pointer"><?php if(!$userlogin) echo "관리자 로그인"; else echo "관리자 비밀번호 변경";?></a></li>
					</ol>
				</nav>
			</div>
		</div>
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
<div class="modal fade" id="inquiryModal" tabindex="-1" aria-labelledby="inquiryModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content px-md-3 px-lg-5 py-3" id="inquiryModalContent">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="inquiryModalLabel">문의하실 내용을 입력해 보내주시면 연락 드리겠습니다.</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="inquiryForm" action="<?= $thispage_filename ?>" method="post">
					<div class="mb-3">
						<select name="inquiryClassfication" class="form-select" id="inquiryClassfication" style="height: calc(3.5rem + 2px);" placeholder="상담 문의 내용 선택" required>
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
						<input name="inquiryPhone" class="form-control" id="inquiryPhone" type="tel" placeholder="(123) 456-7890" required />
						<label for="inquiryPhone">전화번호</label>
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
					<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" id="inquirySendButton" type="submit" name="send_inquiry">문의 내용 보내기</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>

<!-- 문의하기 결과 modal -->
<div class="modal fade" id="inquiryResultModal" tabindex="-1" aria-labelledby="inquiryResultModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content px-md-3 px-lg-5 py-3" id="inquiryResultModalContent">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="inquiryResultModalLabel">상담 문의 전송 결과</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="d-flex align-items-center  justify-content-center">
					<div>
						<?php if($send_inquiry_result) {
							echo "<div class='mb-2'>접수되었습니다.</div><div>빠른 시간내에 연락드리겠습니다.</div>";
						} else {
							echo "<div class='mb-2'>죄송합니다. 전송에 실패했습니다.</div><div>잠시 후 다시 이용 부탁드립니다.</div>";
						}?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>

<!-- sign in modal -->
<div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content px-md-3 px-lg-5 py-3" id="signinModalContent">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="signinModalLabel"><?php if($userlogin) echo "관리자 비밀번호 변경"; else echo "관리자 로그인";?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="signinForm" action="loginprocess.php" method="post">
					<?php if($userlogin):?>
						<input type="hidden" name="action" value="changepass">
						<input type="hidden" name="return_page" value="<?php if($thispage_filename == $config['page_other_files']['양도양수정보']) echo $config['page_files']['양도양수']; else echo $thispage_filename;?>">
						<div class="form-floating mb-3">
							<input name="username" class="form-control" id="signinname" type="text" placeholder="아이디..." required />
							<label for="signinname">아이디</label>
						</div>
						<div class="form-floating mb-3">
							<input name="password" class="form-control" id="signinpass" type="password" placeholder="비밀번호..." required />
							<label for="signinpass">비밀번호</label>
						</div>
						<div class="form-floating mb-3">
							<input name="password1" class="form-control" id="signinpass1" type="password" placeholder="비밀번호..." required />
							<label for="signinpass">새 비밀번호 입력</label>
						</div>
						<div class="form-floating mb-3">
							<input name="password2" class="form-control" id="signinpass2" type="password" placeholder="비밀번호..." required />
							<label for="signinpass">새 비밀번호 한번더 입력</label>
						</div>
						<!-- Submit Button-->
						<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" id="signinButton" type="submit" name="signin">비밀번호 변경</button>
					<?php else:?>
						<input type="hidden" name="action" value="login">
						<input type="hidden" name="return_page" value="<?php if($thispage_filename == $config['page_other_files']['양도양수정보']) echo $config['page_files']['양도양수']; else echo $thispage_filename;?>">
						<div class="form-floating mb-3">
							<input name="username" class="form-control" id="signinname" type="text" placeholder="아이디..." required />
							<label for="signinname">아이디</label>
						</div>
						<div class="form-floating mb-3">
							<input name="password" class="form-control" id="signinpass" type="password" placeholder="비밀번호..." required />
							<label for="signinpass">비밀번호</label>
						</div>
						<!-- Submit Button-->
						<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" id="signinButton" type="submit" name="signin">로그인</button>
					<?php endif;?>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>

<!-- Signin 결과 modal -->
<?php if ($signinresult):?>
<div class="modal fade" id="singinResultModal" tabindex="-1" aria-labelledby="singinResultModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content px-md-3 px-lg-5 py-3" id="singinResultModalContent">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="singinResultModalLabel"><?php if($signinresult == $singinfail) echo "로그인 결과"; else echo "비밀번호 변경 결과";?></h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="d-flex align-items-center  justify-content-center">
					<div>
						<?php 
						if($signinresult == $singinfail) {
							echo "<div class='mb-2'>로그인에 실패했습니다.</div>";
						} else if($signinresult == $passchangefail) {
							echo "<div class='mb-2'>비밀번호 변경에 실패했습니다.</div><div>죄송합니다. 잠시 후 다시 이용 부탁드립니다.</div>";
						} else if($signinresult == $passchangefaillogin) {
							echo "<div class='mb-2'>비밀번호 변경에 실패했습니다.</div><div>기존 로그인 정보가 정확하지 않습니다.</div>";
						} else if($signinresult == $passchangediff) {
							echo "<div class='mb-2'>새로 입력한 두개의 비밀번호가 일치하지 않습니다.</div>";
						} else if($signinresult == $passchangesuccess) {
							echo "<div class='mb-2'>비밀번호가 성공적으로 변경되었습니다.</div><div>새 비밀번호로 다시 로그인하세요.</div>";
						}
						?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>
<?php endif;?>

<?php if ($now_send_inquiry):?>
<script language="javaScript">
let inquiryResultModal = new bootstrap.Modal(document.getElementById('inquiryResultModal'), {})
inquiryResultModal.toggle()
</script>
<?php endif;?>

<?php if ($signinresult):?>
<script language="javaScript">
let signinResultModal = new bootstrap.Modal(document.getElementById('singinResultModal'), {})
signinResultModal.toggle()
</script>
<?php endif;?>


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