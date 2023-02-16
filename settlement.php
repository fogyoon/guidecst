<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
//include("inc/utils.inc"); //그외 functions 
//include("inc/sql.inc"); //mysql 관련 functions

$title = "연말 결산 / 잔고 증명";
$description = "건설업 연말결산 잔고 증명";
$keywords = "건설업, 연말결산, 잔고증명, 건설연말결산, 건설잔고증명, 연말결산";

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img6">
	<div class="container">
		<h1 class="subhead-heading">연말 결산</h1>
		<p class="subhead-subheading">연말 결산 페이지입니다.</p>
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
                            <p class="mb-0 text-white-50" style="font-size:1.2rem;">건설업 연말 결산 자본금 안내
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
		<h2 class="project-text text-center text-M text-white sr-icon-1">건설업 관리규정 자본금 인정기준</h2>
		<!-- Icon Divider-->
		<div class="divider-custom divider-light">
			<div class="divider-custom-line"></div>
			<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
			<div class="divider-custom-line"></div>
		</div>

		<table class="table table-striped bg-white table-bordered mb-5">
			<thead>
				<tr>
				    <th scope="col"></th>
					<th scope="col">실질자산 인정여부</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>현금</td>
<td>
<span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">자본 총계의 100분의 1을 초과하는 현금은 부실자산</span>
</td>
				</tr>
				<tr>
					<td>예금</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">일시조달예금, 허위예금, 사용이 제한된 예금(질권설정, 인출제한 등) 불인정<br>
- 결산일 기준 잔액증명서와 결산일 포함한 60일간 거래실적증명 확인<br>
단 경영상 경영자금으로 진행된 사업비는 증빙확인을 통해 차감하지 아니함</span></td>
				</tr>
				<tr>
					<td>유가증권</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;"><b>실질자산으로 인정되는 유가증권</b><br>
1. 사회기반사업 또는 특정건설사업의 시공등에 참여하기 위해 계약상 취득한 특수목적법인(SPC 또는 PFV)의 지분 증권<br>
2. 건설업과 관련하여 출자한 공제조합 출자금<br>
3. 한국금융투자협회 회원사(증권사)로부터 발급 받은 잔고증명서를 제출한 경우 
<br>(사용제한 여부, 60일간 거래실적 확인 평가)<br>
4. 시공관련 취득한 국·공채<br>
 - 증권회사에 입고 관리하는 경우 증권사 발행 잔액증명서로 인정<br> 
 - 소액의 국·공채, 지방채 등을 증권회사에 입고하지 않고 실물로 보관하고 있는 경우, <br>
   매입증서 원본(매입확인증 아님) 실사 후 예외적으로 인정·무기명 채권(산금채, 중금채, 표지어음 등) 불인정<br>
 - 단, 금융기관의 잔액증명서가 있으면 인정</span></td>
				</tr>
				<tr>
					<td>매출채권<br>미수금</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					<b>실질자산으로 불인정되는 것</b><br>
- 부도어음, 2년 이상 경과한 매출채권<br>
- 건설업과 관련 없는 것<br>
<b>실질자산으로 인정되는 것</b><br>
- 국가, 지자체, 공공기관에 대한 받을 채권(대손충당금 차감 후)<br>
- 법원 확정판결 또는 소송진행 중인 받을채권(채권회수를 위한 담보제공이 있고, 그 담보물을 통해 회수 가능한 금액에 한함)<br>
- 2년 이내의 건설업 관련 매출채권으로서 증빙자료를 통해 소명된 경우<br>
- 사대금을 건물(부속토지 포함)로 받은 경우, 취득일로부터 2년간 실질자산 인정
					</span></td>
				</tr>
				<tr>
					<td>재고자산</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
<b>재고자산 인정 가능</b><br>
- 취득일로부터 1년 이내 재고자산(취득일, 취득사유, 금융자료, 현장일지, 실사 등으로 확인)<br>
- 조경/조경식재공사업을 위한 수목자산, 주택·상가·오피스텔 등 건설업과 연관있고 판매를 위한 신축용자산(시공한 경우에 한함)의<br> 
재고자산은 보유기간에 관계없이 실질자산으로 인정<br>
<b>재고자산 불인정</b><br>
- 건설업과 관계없는 재고자산, 부동산 매매업을 위한 재고자산<br>
- 취득일로부터 1년 이상인 재고 자산
					</span></td>
				</tr>
				<tr>
					<td>대여금<br>가지급금</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					<b>대여금, 가지급금, 주임종 단기채권 등 불인정</b><br>
					<b>종업원에 대한 주택자금 대여금, 우리사주조합에 대한 대여금은 인정</b><br>
- 단 계약서, 금융자료, 주택취득현황, 조합결산서 등의 확인을 통해 실재성 확인 및 사회통념상 합리적인 경우에 한해 인정
					</span></td>
				</tr>
				<tr>
					<td>선급금</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					<b>건설공사에 대한 것 중</b>
- 기성금 미정산액, 건설업을 위한 자재(재료,기계,장비)구입선금, 건설업관련 주택건설용지를 취득 하기 위한 선금,<br> 
선급공사 원가로 대체될 선급금의 경우 인정 <br>(계약서, 금융자료 등 증빙자료와 계약이행 여부 및 진행상황 검토 후 실재성 확인된 경우)
					</span></td>
				</tr>
				<tr>
					<td>선납세금</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					환금결정 된 조세채권에 한해 인정(환급통보서 등)
					</span></td>
				</tr>
				<tr>
					<td>보증금</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					<b>임차보증금 불인정</b><br>
- 실제성 없는 것, 시가를 초가하여 과다계상 된 금액, 임직원용 주택보증금, 임차 부동산이 본·지점 또는 사업장 소재지 및<br> 
인접지역이 아닌 경우
- 임차목적물이 부동산이 아닌 경우(리스보증금은 제외)<br>
<b>사업장소재지 외의 지역에 발생한 건설공사와 관련한 일시적 현장숙소인 임직원용 주택임차 보증금은 인정<br>
건설공사 예치 보증금(출처가 불분명한 것, 실재성이 없는 것)불인정<br>
법원예치 공탁금(현재 소송결과 등을 반영한 회수 가능한 금액 인정)</b>
					</span></td>
				</tr>
				<tr>
					<td>유형자산</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					<b>토지, 건물</b><br>
- 임대자산, 운휴자산 등 건설업과 관련 없는 것 불인정<br>
- 본사 업무용 건축물(부속 토지 포함)이 임대자산의 경우는 인정<br>
<b>차량, 건설기계, 비품 등</b><br>
- 감가상각 후 잔약 인정<br>
<b>건설 중인 자산</b><br>
- 계약서, 금융자료, 장부 등 실재성 확인 후 인정<br>
- 실재하지 않는 계약, 계약일로부터 1년이 초과되었으나 그 사유를 객관적으로 소명하지 못하는 경우, 계약이 해제된 경우 불인정
					</span></td>
				</tr>
				<tr>
					<td>무형자산</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					<b>영업권, 개발비, 창업비, 건설업과 관련없는 산업권 재산권 등 불인정<br>
건설업과 관련하여 취득한 산업재산권(특허권, 신기술권 등)</b><br>
- 취득원가에 감가상각 후 평가
					</span></td>
				</tr>
				<tr>
					<td>미수수익</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					불인정
					</span></td>
				</tr>
				<tr>
					<td>선급비용</td>
					<td><span style="font-size: 0.9rem; line-height: 1.5rem; text-align: left;">
					불인정
					</span></td>
				</tr>

			</tbody>
</table>

		<!-- About Section Button-->
		<div class="text-center mt-4">
			<a class="btn btn-xl btn-outline-light" data-bs-toggle="modal" data-bs-target="#inquiryThisModal" href="#">
				<i class="fas fa-download me-2"></i>
				연말결산 문의하기
			</a>
		</div>



    </div>
</section>



<!-- 이 매물 문의하기 modal -->
<div class="modal fade" id="inquiryThisModal" tabindex="-1" aria-labelledby="inquiryThisModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content px-md-3 px-lg-5 py-3" id="inquiryThisModalContent">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="inquiryThisModalLabel">문의하실 내용을 입력해 보내주시면 연락 드리겠습니다.</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="inquiryForm" action="<?= $thispage_filename ?>" method="post">
					<!-- Name input-->
					<div class="mb-3">
						<select name="inquiryClassfication" class="form-select" id="inquiryClassfication" style="height: calc(3.5rem + 2px);" placeholder="상담 문의 내용 선택" required>
							<option value="">문의사항 분류를 선택해 주세요.</option>
							<?php foreach ($config['inquiry_classfication'] as $inqiry_class) : ?>
								<option value="<?= $inqiry_class ?>" <?php if($inqiry_class == "연말결산") echo "selected";?>><?= $inqiry_class ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<!-- Name input-->
					<div class="form-floating mb-3">
						<input name="inquiryName" class="form-control" id="inquiryname" type="text" placeholder="신청자명..." required />
						<label for="inquiryname">신청자명 or 회사명</label>
					</div>
					<!-- Phone number input-->
					<div class="form-floating mb-3">
						<input name="inquiryPhone" class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" required />
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
					<button class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto;" id="inquirySendButton" type="submit" name="send_inquiry">문의 내용 보내기</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>

