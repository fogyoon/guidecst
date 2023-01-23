<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = "기업 진단";
$description = "건설업 기업 진단";
$keywords = "건설업, 기업진단";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img4">
	<div class="container">
		<h1 class="subhead-heading">기업 진단</h1>
		<p class="subhead-subheading">기업회계 기준 또는 관할관청에서 정한 규정</p>
	</div>
</header>

<!-- Portfolio Section-->
<section class="page-section portfolio mb-0" id="portfolio">
	<div class="container">
		<!-- Portfolio Section Heading-->
        <div class="row gx-0 mb-lg-0 justify-content-center">
            <div class="col-lg-6"><img class="img-fluid" src="assets/img/4-01.jpg" alt="..." /></div>
            <div class="col-lg-6">
                <div class="bg-black bg-opacity-50 text-center h-100 project">
                    <div class="d-flex h-100">
                        <div class="project-text w-100 my-auto text-center text-lg-left p-4">
                            <h4 class="text-white text-M sr-icon-4">기업진단</h4>
                            <p class="mb-0 text-white-50" style="font-size:1.2rem;">기업경영의 불합리성을 시정하고 건전한 기업의 유지 · 발전을 위해서 전문가인 제3자에게 의뢰하여, 기업경영실태를 조사 · 분석케 하여 그 결과에 따라 결함을 개선하기 위한 적절한 대책을 마련하고 권고 · 지도를 행하게 하는 것을 말한다.
                            <hr class="d-none d-lg-primary mb-0 ms-0" />
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
		<!-- About Section Content-->
		<div class="row">
			<div class="col-lg-11 ms-auto font-nanumgothic">
				<div class="lead">
                    - 건설업(공사업) 신규 등록
                    - 실질자본금 확인 (실태조사, 입찰 등)
                    - 등록기준신고 (전기공사업)
                    - 건설업(공사업) 업종 추가 등록
                    - 법인양도양수 (분할합병, 법인전환)
                </div>
			</div>
		</div>
    </div>
</section>



<section class="page-section portfolio mb-0" id="portfolio">
	<div class="container">

		<!-- Portfolio Section Heading-->
		<h2 class="project-text text-center text-secondary mb-0 text-M sr-icon-3">기업진단 진행절차

</h2>
		<!-- Icon Divider-->
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>


		<!-- Section Heading-->

		<table class="table table-striped text-L" style="line-height: 4rem;">
			<thead>
				<tr>
					<th scope="col"></th>
					<th scope="col"></th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><b>진단목적 확인</b></td>
					<td>신규등록, 추가등록, 양도양수, 입찰 등</td>
				</tr>
				<tr>
					<td><i class="fa-sharp fa-solid fa-clipboard"></i> </td>
					<td><b>증빙서류 제출</b></td>
					<td>재무제표, 부속명세서, 관련증빙 등</td>
				</tr>
				<tr>
					<td><i class="fa-sharp fa-solid fa-gears"></i> </td>
					<td><b>기업진단 실시</b></td>
					<td>증빙서류 및 업종별 진단기준 검토 확인</td>
				</tr>
				</tr>
				<tr>
				<td><i class="fa-sharp fa-solid fa-comment"></i></td>
					<td><b>기업진단 완료</b></td>
					<td>적격, 부적격, 진단불능 등 결과 확인</td>
				</tr>

				<tr>
				<td><i class="fa-sharp fa-solid fa-bag-shopping"></i></td>
					<td><b> 기업진단 제출</b></td>
					<td>허가관청 또는 협회 1부 제출</td>
				</tr>

				
			</tbody>
		</table>

</div>
</section>





<section class="page-section bg-primary text-dark bg-opacity-10 mb-0" id="about">
	<div class="container">
		<!-- About Section Heading-->



		<h2 class="project-text text-center text-secondary mb-0 text-M sr-icon-3">기업진단시 필요서류</h2>
		<!-- Icon Divider-->
		<div class="divider-custom">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>


		<table class="table table-striped text-L bg-white table-bordered text-center" style="line-height: 2.5rem;">
			<thead>
				<tr>
				    <th scope="col">목록</th>
					<th scope="col">법인</th>
					<th scope="col">개인</th>
					<th scope="col">비고</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>사업자등록증사본</td>
					<td><i class="fa-sharp fa-solid fa-check"></i> </td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td></td>
				</tr>
				<tr>
					<td>법인등기부등본</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>재무제표(비교식)</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>진단기준일 현재</td>
				</tr>
				</tr>
				<tr>
					<td>손익계산서</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>진단기준일 현재</td>
				</tr>
				<tr>
					<td>공사원가명세서</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>진단기준일 현재</td>
				</tr>

				<tr>
					<td>공제조합 출자좌수 증명원</td>
					<td><i class="fa-sharp fa-solid fa-check"></i> </td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>진단기준일 현재</td>
				</tr>
				<tr>
					<td>공제조합 융자금잔액 확인원</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>진단기준일 현재</td>
				</tr>
				<tr>
					<td>진단기준일 현재의 잔액증명서</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>예금이 있는 경우</td>
				</tr>
				</tr>
				<tr>
					<td>금융거래확인서(부채확인서)</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td></td>
				</tr>
				<tr>
					<td>거래사실증명원(통장사본)</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td></td>
				</tr>

				<tr>
					<td>거래처별원장(잔액,내용)</td>
					<td><i class="fa-sharp fa-solid fa-check"></i> </td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>매출채권이 있는 경우</td>
				</tr>
				<tr>
					<td>세금계산서 사본, 입금통장 사본</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td></td>
				</tr>
				<tr>
					<td>임대차 계약서</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td></td>
				</tr>
				</tr>
				<tr>
					<td>자산취득 증빙서류, 감가상각명세서</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>유형자산이 있는 경우</td>
				</tr>
				<tr>
					<td>업종별 등록증 사본</td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td><i class="fa-sharp fa-solid fa-check"></i></td>
					<td>업종별 등록기준 확인</td>
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