<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = "연말 정산 / 잔고 증명";
$description = "건설업 연말 정산 잔고 증명";
$keywords = "건설업, 연말정산, 잔고증명, 건설연말정산, 건설잔고증명";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img6">
	<div class="container">
		<h1 class="subhead-heading">연말 정산 / 잔고 증명</h1>
		<p class="subhead-subheading">연말 정산 / 잔고 증명 페이지입니다.</p>
	</div>
</header>
<!-- Portfolio Section-->
<section class="page-section portfolio mb-0" id="portfolio">
	<div class="container">
		<!-- Portfolio Section Heading-->
        <div class="row gx-0 mb-lg-0 justify-content-center">
            <div class="col-lg-6"><img class="img-fluid" src="assets/img/6-01.jpg" alt="..." /></div>
            <div class="col-lg-6">
                <div class="bg-black bg-opacity-50 text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left p-4">
                            <h4 class="text-white text-M sr-icon-4">자본금 계정별 인정기준</h4>
                            <p class="mb-0 text-white-50" style="font-size:1.2rem;">건설업 연말결산 자본금 안내
건설업체에 대한 자본금 등록기준 부실업체의 상시정검하는 시스템의 강화로 인하여 행정처분을 받는 사례가 빈번하게 발생되고 잇습니다. 하여 수시로 건설업 관리규정에 의한 실질 자본금 인정기준을 확인하여 자본금 미달이 발생하지 않도록 대비하셔야 합니다.
                        </div>
                    </div>
                </div>
            </div>
	</div>
</section>





<section class="page-section bg-primary text-white mb-0" id="about">
	<div class="container">
		<!-- About Section Heading-->
		<h2 class="project-text text-center text-M text-white sr-icon-1">기업진단이 필요할 때</h2>
		<!-- Icon Divider-->
		<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>

		<table class="table table-striped text-L bg-white table-bordered text-center" style="line-height: 2.5rem;">
			<thead>
				<tr>
				    <th scope="col" style="width=100px;">자산항목</th>
					<th scope="col">실질자산 인정여부</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>현금</td>
<td>
자본 총계의 100분의 1을 초과하는 현금은 부실자산
</td>
				</tr>
				<tr>
					<td>예금</td>
					<td>일시조달예금, 허위예금, 사용이 제한된 예금(질권설정, 인출제한 등) 불인정<br>
- 결산일 기준 잔액증명서와 결산일 포함한 60일간 거래실적증명 확인<br>
단 경영상 경영자금으로 진행된 사업비는 증빙확인을 통해 차감하지 아니함</td>
				</tr>
				<tr>
					<td>유가증권</td>
					<td>실질자산으로 인정되는 유가증권<br>
1. 사회기반사업 또는 특정건설사업의 시공등에 참여하기 위해 계약상 취득한 특수목적법인(SPC 또는 PFV)의 지분 증권<br>
2. 건설업과 관련하여 출자한 공제조합 출자금<br>
3. 한국금융투자협회 회원사(증권사)로부터 발급 받은 잔고증명서를 제출한 경우 
<br>(사용제한 여부, 60일간 거래실적 확인 평가)<br>
4. 시공관련 취득한 국·공채<br>
- 증권회사에 입고 관리하는 경우 증권사 발행 잔액증명서로 인정<br> 
- 소액의 국·공채, 지방채 등을 증권회사에 입고하지 않고 실물로 보관하고 있는 경우, <br>
매입증서 원본(매입확인증 아님) 실사 후 예외적으로 인정·무기명 채권(산금채, 중금채, 표지어음 등) 불인정<br>
 - 단, 금융기관의 잔액증명서가 있으면 인정</td>
				</tr>
				<tr>
					<td>항목</td>
					<td>내용</td>
				</tr>
				<tr>
					<td>항목</td>
					<td>내용</td>
				</tr>
				<tr>
					<td>항목</td>
					<td>내용</td>
				</tr>
				<tr>
					<td>항목</td>
					<td>내용</td>
				</tr>
			</tbody>
		</table>

		(신설법인과 기존법인의 기업진단발급 구비서류는 다소 차이가 있을 수 있습니다.)



    </div>
</section>






















<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>