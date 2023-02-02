<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = "회사소개";
$description = "건설업 회사소개";
$keywords = "건설업, 회사소개";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img subhead-bright">
	<div class="container">
		<h1 class="subhead-heading">회사소개</h1>
		<p class="subhead-subheading">최상의 서비스 & 앞선 컨설팅</p>
	</div>
</header>





<br>
<br>




        
        <!-- Content section 1-->
        <section id="scroll">
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/01.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-4">
                            <h2 class="display-4 text-M sr-icon-4">건설업의 앞선 컨설팅</h2>
                            <p class="text-L">유원건설정보는 빠르게 변화하는 건설업에서 다년간의 경험과 축적된 노하우을 가지고 각각의 기업상황에 맞는 정보를 제공하고있습니다.
양도양수, 기업진단, 신규건설업등록, 경영운영의 전반에 걸친 정확하고 믿을수 있는 맞춤형정보로 앞선 컨설팅을 해드립니다. <br><br>유원건설정보 임직원일동</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 2-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/02.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6">
                        <div class="p-4">
                            <h2 class="display-4 text-M sr-icon-4">사업영역</h2>
							<p class="text-L">양도양수(M&A), 면허신규등록, 면허추가등록, 법인설립, 합병 및 분할, 기업진단, 건설업 실태조사 자문 컨설팅, 관련법규 및 회계상담, 운영관련 행정업무 상담, 연말결산 등 건설업만의 경영컨설팅을 제공해드립니다.                         
						</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Content section 3-->
        <section>
            <div class="container px-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-lg-2">
                        <div class="p-5"><img class="img-fluid rounded-circle" src="assets/img/03.jpg" alt="..." /></div>
                    </div>
                    <div class="col-lg-6 order-lg-1">
                        <div class="p-4">
                            <h2 class="display-4 text-M sr-icon-4">최상의 서비스</h2>
							<p class="text-L">저희 유원건설정보는 축적된 경험과 노하우로 고객분들께 정확하고 최상의 서비스를 지원하여 성공적인 성장의 원동력이 되겠습니다. 고객의 입장에서 함께 노력할것을 약속드립니다.                       
						</div>
                    </div>
                </div>
            </div>
        </section>

        <br>

<section class="page-section portfolio" id="portfolio">
	<div class="container">
		<!-- Portfolio Section Heading-->
		<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0 sr-icon-1">Location</h2>
		<!-- Icon Divider-->
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>
        <iframe class="border" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3763.423705101777!2d126.7232351641401!3d37.51618401044245!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357b7ddc31b20e45%3A0xf3ecb74e912462b9!2z7J247LKc7YWM7YGs64W467C466asVTHshLzthLA!5e0!3m2!1sko!2skr!4v1674790141284!5m2!1sko!2skr" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
</section>







<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>