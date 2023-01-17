<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
include("inc/utils.inc"); //그외 functions 
include("inc/sql.inc"); //mysql 관련 functions

$title = "상담문의";
$description = "건설업 양도 양수 상담 문의";
$keywords = "건설양도양수, 문의, 상담";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

$error_log = false;
/* if (!check_connect_dbserver()) {
	$error_log = read_log();
} else {
	$result = create_tables();
	$error_log = read_log();
}
 */
?>

<!-- Header-->
<header class="plainhead text-center bg-dark">
	<div class="container">
		<h1 class="plainhead-heading">상담 문의</h1>
		<p class="plainhead-subheading"><small>상담 문의 페지입니다.</small></p>
	</div>
</header>


<?php if ($error_log) : ?>
	<section>
		<div class="container">
			<h3><?php echo $result; ?></h3>
			<p><?php echo $error_log; ?></p>
		</div>
	</section>
<?php endif; ?>


<section class="page-section page-section-1" id="contact">
	<div class="container">
		<!-- Contact Section Heading-->
		<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0" style="margin-top:5%;">상담문의</h2>
		<!-- Icon Divider-->
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>
		<!-- Contact Section Form-->
		<div class="row justify-content-center">
			<div class="col-lg-8 col-xl-7">
				<!-- * * * * * * * * * * * * * * *-->
				<!-- * * SB Forms Contact Form * *-->
				<!-- * * * * * * * * * * * * * * *-->
				<!-- This form is pre-integrated with SB Forms.-->
				<!-- To make this form functional, sign up at-->
				<!-- https://startbootstrap.com/solution/contact-forms-->
				<!-- to get an API token!-->
				<form id="inquiryForm" action="<?= $thispage_filename ?>" method="post">
					<div class="mb-3">
						<select name="inquiryClassfication" class="form-select" style="height: calc(3.5rem + 2px);" id="Select" type="text" placeholder="상담 문의 내용 선택" data-sb-validations="required">
							<option selected>문의사항 분류를 선택해 주세요.</option>
							<option value=""></option>
							<?php foreach ($config['inquiry_classfication'] as $inqiry_class) : ?>
								<option value="<?= $inqiry_class ?>"><?= $inqiry_class ?></option>
							<?php endforeach; ?>
						</select>

					</div>


					<!-- Name input-->
					<div class="form-floating mb-3">
						<input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
						<label for="name">이름 or 회사명</label>
						<div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
					</div>
					<!-- Email address input-->
					<div class="form-floating mb-3">
						<input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
						<label for="email">Email 주소</label>
						<div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
						<div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
					</div>
					<!-- Phone number input-->
					<div class="form-floating mb-3">
						<input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
						<label for="phone">전화번호</label>
						<div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
					</div>
					<!-- Message input-->
					<div class="form-floating mb-3">
						<textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
						<label for="message">문의내용</label>
						<div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
					</div>
					<!-- Submit success message-->
					<!---->
					<!-- This is what your users will see when the form-->
					<!-- has successfully submitted-->
					<div class="d-none" id="submitSuccessMessage">
						<div class="text-center mb-3">
							<div class="fw-bolder">Form submission successful!</div>
							To activate this form, sign up at
							<br />
							<a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
						</div>
					</div>
					<!-- Submit error message-->
					<!---->
					<!-- This is what your users will see when there is-->
					<!-- an error submitting the form-->
					<div class="d-none" id="submitErrorMessage">
						<div class="text-center text-danger">Error sending message!</div>
					</div>
					<!-- Submit Button-->
					<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" id="submitButton" type="submit">문의 내용 보내기</button>
				</form>
			</div>
		</div>
	</div>
</section>








<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>