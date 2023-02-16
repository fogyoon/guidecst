<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
include("inc/utils.inc"); //그외 functions 
include("inc/sql.inc"); //mysql 관련 functions

$title = "양도양수";
$description = "건설업 양도 양수 상세";
$keywords = "건설업, 양도양수";

if (!check_connect_dbserver()) {
	$header = "Location: index.php";
	header($header);
}

if ($_GET['reg_number']) {
	$reg_number = $_GET['reg_number'];
	$transfer_info = get_transfer_info($reg_number);
	$performance_info_array = get_performance_info($reg_number);
	$transfer_sector_array = transfer_info_per_sector($performance_info_array);
	$finstatements_info = get_finstatements($reg_number);
} else {
	$header = "Location: ".$config['page_files']['양도양수'];
	header($header);
}

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- 카카오톡 공유하기 -->
<script src="https://t1.kakaocdn.net/kakao_js_sdk/2.1.0/kakao.min.js" integrity="sha384-dpu02ieKC6NUeKFoGMOKz6102CLEWi9+5RQjWSV0ikYSFFd8M3Wp2reIcquJOemx" crossorigin="anonymous"></script>
<script>
  Kakao.init('<?=$config['kakao_key']?>'); // 사용하려는 앱의 JavaScript 키 입력
</script>


<!-- Masthead-->
<header class="subhead text-center transfer-bg-img subhead-bright">
	<div class="container">
		<h1 class="subhead-heading">양도양수 물건 정보</h1>
		<p class="subhead-subheading">양도양수 안내 페이지입니다.</p>
	</div>
</header>

<section class="page-section pb-4 pt-5" id="transferPrint">
	<div class="container mb-5">
		<div class="clearfix mb-3">
			<button type="button" class="btn btn-warning float-end" onclick="location.href='<?=$config['page_other_files']['양도양수절차']?>'">양도양수 절차 확인</button>
		</div>
		<div class="row justify-content-between">
			<div class="col-auto"><h4><i class="bi bi-file-post"></i> 매물 정보
				<?php
				if ($transfer_info['tag']) {
					if ($transfer_info['tag'] == "추천") {
						echo "<span class=\"badge bg-info mb-1\">" . $transfer_info['tag'] . "</span>";
					} else if ($transfer_info['tag'] == "인기") {
						echo "<span class=\"badge bg-warning mb-1\">" . $transfer_info['tag'] . "</span>";
					} else if ($transfer_info['tag'] == "긴급") 	{
						echo "<span class=\"badge bg-danger mb-1\">" . $transfer_info['tag'] . "</span>";
					}
				}
				?>
				<?php if($userlogin) echo " 회사명 : ".$transfer_info['company_name']." ";?>
				<?php if (!$userlogin):?>
					<button class="btn btn-primary rounded-pill ms-4 py-1" data-bs-toggle="modal" data-bs-target="#inquiryThisModal">이 매물 문의하기</button>
				<?php endif;?>
			</h4>
			</div>
			<?php if ($userlogin):?>
				<div class="col col-md-3 col-lg-2 mb-3 mb-md-2 text-center">
					<button type="button" class="btn btn-info btn-sm px-5" onclick="location.href='<?=$config['page_other_files']['양도양수수정']?>?reg_number=<?=$reg_number?>'">수정</button>
				</div>
			<?php endif;?>
		</div>
		
		<div class="row text-center transfer-border">
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-3 bg-primary-subtle">등록번호</div>
					<div class="col p-3 "><?=$reg_number?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-3 bg-primary-subtle">상태</div>
					<div class="col p-3 <?php if($transfer_info['status']) echo "text-success"; else echo "text-muted";?>"><?php if($transfer_info['status']) echo "계약가능"; else echo "계약완료"; ?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 p-lg-3 bg-dark-subtle">수정일</div>
					<div class="col p-1 p-lg-3 "><?=date2ymd($transfer_info['modfied_date'])?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">상담원</div>
					<div class="col p-1"><?=$transfer_info['consultant']?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4 d-none d-md-block">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">전화</div>
					<div class="col p-1"><?=$transfer_info['phone']?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4 d-none d-md-block">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">HP</div>
					<div class="col p-1"><?=$transfer_info['mobile']?></div>
				</div>
			</div>
			<div class="col-12 d-block d-md-none">
				<div class="row transfer-border">
					<div class="col-3 p-1 bg-dark-subtle">연락처</div>
					<div class="col-9 p-1"><?=$transfer_info['phone']?> <?php if($transfer_info['mobile']) echo "(HP: ".$transfer_info['mobile'].")";?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="container mb-5">
		<div class="row justify-content-between">
			<div class="col"><h4><i class="bi bi-card-checklist"></i> 매물 개요</h4></div>
			<div class="col-5 col-md-3 col-lg-2 mb-3 mb-md-2 text-center">
				<button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#biddingModal">입찰가능금액 보기</button>
			</div>
		</div>
		<div class="row text-center transfer-border">
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">양도가</div>
					<div class="col p-1 text-danger"><?php if($transfer_info['transfer_price'] == 0) echo "협의"; else echo print_money($transfer_info['transfer_price']);?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">회사형태</div>
					<div class="col p-1"><?=$transfer_info['company_type']?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">설립연도</div>
					<div class="col p-1"><?=$transfer_info['year_founded']?>년</div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">자본금</div>
					<div class="col p-1"><?=print_money($transfer_info['capital'])?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">공제조합출자수</div>
					<div class="col p-1"><?=$transfer_info['deposit_bill']?>좌</div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">대출 후 남은 잔액</div>
					<div class="col p-1"><?=print_money($transfer_info['remaining_amount'])?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">협회 가입여부</div>
					<div class="col p-1"><?php if ($transfer_info['join_association']) echo "가입"; else echo "미가입";?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">진행중인 공사유무</div>
					<div class="col p-1"><?php if ($transfer_info['construction_in_progress']) echo "유"; else echo "무";?></div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="row transfer-border">
					<div class="col-3 col-lg-6 p-1 bg-dark-subtle">지역</div>
					<div class="col-9 col-lg-6 p-1"><?=$transfer_info['region']?></div>
				</div>
			</div>
			<div class="col-12">
				<div class="row transfer-border">
					<div class="col-3 col-lg-2 p-1 bg-dark-subtle"><span class="align-middel">특기사항</span></div>
					<div class="col-9 col-lg-10 p-1 px-3 text-start"><?=$transfer_info['note']?></div>
				</div>
			</div>
		</div>
	</div>

	<div class="container overflow-auto mb-5">
		<div class="row">
			<div class="col"><h4><i class="bi bi-clipboard-data"></i> 업종별 내용</h4></div>
		</div>
		<?php //print_r($transfer_sector_array);?>
		<table class="table table-hover table-bordered align-middle text-center">
			<thead class="table-light">
				<tr class="align-middle text-center">
					<th scope="col">업종</th>
					<th scope="col">등록년도</th>
					<th scope="col">시공능력</th>
					<?php foreach($performance_yesrs as $forEachYear):?>
					<th scope="col"><?=$forEachYear?>년</th>
					<?php endforeach;?>
					<th scope="col">최근3년실적</th>
					<th scope="col">최근5년실적</th>
					<th scope="col"><?=$performance_last_yesr?>년</th>
				</tr>
			</thead>
		<?php if ($transfer_sector_array):?>
			<?php if (count($transfer_sector_array) > 0):?>
			<tbody>
				<?php foreach ($transfer_sector_array as $eachsector) : ?>
					<tr>
						<td><?= $eachsector['sector'] ?></td>
						<td><?= $eachsector['year_licensed'] ?>년</td>
						<td><?= print_money($eachsector['construction_ability']) ?></td>
						<?php
						if(isset($eachsector['sales'])) {
							// each sales for each year
							foreach($performance_yesrs as $forEachYear){
								if (isset($eachsector['sales'][$forEachYear])) {
									echo "<td>".print_money($eachsector['sales'][$forEachYear])."</td>";
								} else {
									echo "<td></td>";
								}
							}
						}
						?>
						<td><?php if (isset($eachsector['three_year'])) echo print_money($eachsector['three_year']); ?></td>
						<td><?php if (isset($eachsector['five_year'])) echo print_money($eachsector['five_year']); ?></td>
						<?php
						if(isset($eachsector['sales'])) {
							// sales of latest year
							if (isset($eachsector['sales'][$performance_last_yesr])) {
								echo "<td>".print_money($eachsector['sales'][$performance_last_yesr])."</td>";
							} else {
								echo "<td></td>";
							}
						}
						?>
					</tr>
				<?php endforeach; ?>
			</tbody>
			<?php endif;?>
		<?php endif;?>
		</table>
	</div>

	<div class="container mb-5">
		<div class="row">
			<div class="col"><h4><i class="bi bi-graph-up-arrow"></i> 재무재표</h4></div>
		</div>
		<div class="row text-center transfer-border">
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">부채비율</div>
					<div class="col p-1"><?php if (isset($finstatements_info['debt_ratio'])) echo $finstatements_info['debt_ratio']."%";?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">고정부채</div>
					<div class="col p-1"><?php if (isset($finstatements_info['fixed_debt'])) echo print_money($finstatements_info['fixed_debt']);?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">유동비율</div>
					<div class="col p-1"><?php if (isset($finstatements_info['current_ratio'])) echo $finstatements_info['current_ratio']."%";?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">고정자산</div>
					<div class="col p-1"><?php if (isset($finstatements_info['fixed_assets'])) echo print_money($finstatements_info['fixed_assets']);?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">자본총계</div>
					<div class="col p-1"><?php if (isset($finstatements_info['total_capital'])) echo print_money($finstatements_info['total_capital']);?></div>
				</div>
			</div>
			<div class="col-6 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">매출액</div>
					<div class="col p-1"><?php if (isset($finstatements_info['revenue'])) echo print_money($finstatements_info['revenue']);?></div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">영업손익</div>
					<div class="col p-1"><?php if (isset($finstatements_info['operating_profit'])) echo print_money($finstatements_info['operating_profit']);?></div>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-4">
				<div class="row transfer-border">
					<div class="col p-1 bg-dark-subtle">법인세 차감손익</div>
					<div class="col p-1"><?php if (isset($finstatements_info['income_after_tax'])) echo print_money($finstatements_info['income_after_tax']);?></div>
				</div>
			</div>
			<div class="col-12 col-lg-4">
				<div class="row transfer-border">
					<div class="col-6 col-lg-6 p-1 bg-dark-subtle">부채와 자본총계</div>
					<div class="col-6 col-lg-6 p-1"><?php if (isset($finstatements_info['debt_equity'])) echo print_money($finstatements_info['debt_equity']);?></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- buttons -->
<section class="page-section pb-4 pt-0" id="transferButtons">
	<div class="container mb-5">
		<div class="row justify-content-end">	
			<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button type="button" class="btn btn-secondary px-4" onclick="location.href='<?=$config['page_files']['양도양수']?>'">목록으로</button></div>
			<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button type="button" class="btn btn-secondary py-1 pe-1" id="kakaotalk-sharing-btn" href="javascript:;">공유하기 <span class="badge"><img style="width:1.5em" src="https://developers.kakao.com/assets/img/about/logos/kakaotalksharing/kakaotalk_sharing_btn_medium.png" alt="카카오톡 공유 보내기 버튼" /></span></button>
			</div>
			<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button type="button" class="btn btn-secondary px-4" onclick="startPrint('transferPrint')">인쇄하기</button></div>
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
					<div class="row g-3 align-items-center mb-3 p-3">
						<div class="col-4 col-md-2">
							<label for="inquiryRegnumber">등록번호</label>
						</div>
						<div class="col-auto">
							<input name="inquiryRegnumber" value="<?=$reg_number?>" class="form-control" id="inquiryRegnumber" type="text" readonly />
						</div>
					</div>
					<div class="mb-3">
						<select name="inquiryClassfication" class="form-select" id="inquiryClassfication" style="height: calc(3.5rem + 2px);" placeholder="상담 문의 내용 선택" required>
							<option value="">문의사항 분류를 선택해 주세요.</option>
							<?php foreach ($config['inquiry_classfication'] as $inqiry_class) : ?>
								<option value="<?= $inqiry_class ?>" <?php if($inqiry_class == "양도양수") echo "selected";?>><?= $inqiry_class ?></option>
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


<!-- 입찰 시공경험 평가 modal -->
<div class="modal fade" id="biddingModal" tabindex="-1" aria-labelledby="biddingModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content" id="biddingModalContent">
			<div class="modal-header bg-primary justify-content-between">
				<div class="col px-1"></div>
				<div class="col text-center"><h3 class="modal-title" id="biddingModalLabel">입찰 시공경험 평가</h3></div>
				<div class="col d-inline-flex"><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="bg-dark-subtle p-3 text-center mb-4">
						<div>실적점수 = 실적계수 x 배점</div>
						<div>실적계수 = 실적합 / (기준액 x 실적배수)</div>	
					</div>
				</div>
				<div class="container overflow-auto">
					<table class="table table-bordered align-middle text-center">
						<thead class="table-light">
							<tr class="align-middle text-center">
								<th scope="col" rowspan="2" class="text-nowrap">발주처</th>
								<th scope="col" colspan="3" class="text-nowrap">추정가격</th>
								<th scope="col" rowspan="2" class="text-nowrap">실적합</th>
								<th scope="col" rowspan="2" class="text-nowrap">기준액</th>
								<th scope="col" rowspan="2" class="text-nowrap">실적배수</th>
								<th scope="col" rowspan="2" class="text-nowrap">배점</th>
							</tr>
							<tr class="align-middle text-center">
								<th scope="col" class="text-nowrap">일반</th>
								<th scope="col" class="text-nowrap">전문설비</th>
								<th scope="col" class="text-nowrap">전기 · 통신 · 소방</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td rowspan="6">조달청</td>
								<td>2억미만</td>
								<td>1억미만</td>
								<td>8천미만</td>
								<td>무관</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>2억~3억</td>
								<td>1억~3억</td>
								<td>8천~3억</td>
								<td rowspan="5">5년</td>
								<td rowspan="5">기초금액</td>
								<td>비제한 0.5</td>
								<td>5</td>
							</tr>
							<tr>
								<td>3억~10억</td>
								<td>-</td>
								<td>-</td>
								<td>비제한 0.5</td>
								<td>10</td>
							</tr>
							<tr>
								<td class="text-nowrap">10억~50억</td>
								<td colspan="2">3억~50억</td>
								<td>비제한 1</td>
								<td>15</td>
							</tr>
							<tr>
								<td colspan="3">50억~100억</td>
								<td>비제한2<br>	비제한 · 등급 · 토목 1<br>비제한 · 등급 · 건축 2</td>
								<td>15</td>
							</tr>
							<tr>
								<td colspan="3">100억~300억</td>
								<td class="text-nowrap">비제한3<br>비제한 · 등급 · 토목 1.3<br>비제한 · 등급 · 건축 2<br>비제한 · 준설 2</td>
								<td>12</td>
							</tr>
							<!-- next -->
							<tr>
								<td rowspan="7">지자체</td>
								<td>2억미만</td>
								<td>1억미만</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>2억~3억</td>
								<td>-</td>
								<td>1.5억</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
							</tr>
							<tr>
								<td>3억~10억</td>
								<td>1억~3억</td>
								<td>1.5억~3억</td>
								<td rowspan="5">3년</td>
								<td rowspan="5">추정가격</td>
								<td>제한 0.7</td>
								<td>1 x 업종비</td>
							</tr>
							<tr>
								<td class="text-nowrap">10억~50억</td>
								<td colspan="2">3억~50억</td>
								<td>제한 1.5</td>
								<td>1.5 x 업종비</td>
							</tr>
							<tr>
								<td colspan="3">30억~50억</td>
								<td>제한1.7</td>
								<td>1.5 x 업종비</td>
							</tr>
							<tr>
								<td colspan="3">50억~100억</td>
								<td class="text-nowrap">제한 1.7<br>비제한 1.7<br>비제한 · 등급 1.2</td>
								<td class="text-nowrap">0.7 x 업종비<br>15 x 업종비</td>
							</tr>
							<tr>
								<td colspan="3">100억~300억</td>
								<td>비제한 1.8<br>비제한 · 등급 1.2</td>
								<td>14 x 업종비</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
			</div>
		</div>
	</div>
</div>


<!-- 카카오톡 공유하기 -->
<script>
// https://developers.kakao.com 등록 필요
// https://developers.kakao.com/tool/demo/message/kakaolink?default_template=feed
// https://developers.kakao.com/docs/latest/ko/message/js-link
// 해결 안됨
Kakao.Share.createDefaultButton({
	container: '#kakaotalk-sharing-btn',
	objectType: 'feed',
	content: {
		title: '<?=$config['company_kr_name']." 양도양수 정보"?>',
		description: '#양도양수 #건설',
		imageUrl:
		'http://k.kakaocdn.net/dn/Q2iNx/btqgeRgV54P/VLdBs9cvyn8BJXB3o7N8UK/kakaolink40_original.png',
		link: {
			// [내 애플리케이션] > [플랫폼] 에서 등록한 사이트 도메인과 일치해야 함
			mobileWebUrl: '<?=$config['full_url']?>',
			webUrl: '<?=$config['full_url']?>',
		},
	},
	social: {
		likeCount: 286,
		commentCount: 45,
		sharedCount: 845,
	},
	buttons: [
	{
		title: '웹으로 보기',
		link: {
			mobileWebUrl: '<?=$config['full_url']."/".$thispage_filename."?reg_number=".$reg_number?>',
			webUrl: '<?=$config['full_url']."/".$thispage_filename."?reg_number=".$reg_number?>',
		},
	},
	{
		title: '앱으로 보기',
		link: {
			mobileWebUrl: '<?=$config['full_url']."/".$thispage_filename."?reg_number=".$reg_number?>',
			webUrl: '<?=$config['full_url']."/".$thispage_filename."?reg_number=".$reg_number?>',
		},
	},
	],
});
</script>

<!-- print -->
<script>
var prtContent; // 프린트 하고 싶은 영역
var initBody;  // body 내용 원본

// 프린트하고 싶은 영역의 id 값을 통해 출력 시작
function startPrint(div_id) {
	prtContent = document.getElementById(div_id);
	window.onbeforeprint = beforePrint;
	window.onafterprint = afterPrint;
	window.print();
	window.location.reload();
}

// 웹페이지 body 내용을 프린트하고 싶은 내용으로 교체
function beforePrint(){
	initBody = document.body.innerHTML;
	document.body.innerHTML = prtContent.innerHTML;
}

// 프린트 후, 웹페이지 body 복구
function afterPrint(){
	document.body.innerHTML = initBody;
}	

</script>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>
