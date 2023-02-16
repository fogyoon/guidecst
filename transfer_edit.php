<?php
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
include("inc/utils.inc"); //그외 functions 
include("inc/sql.inc"); //mysql 관련 functions

if(!$userlogin) {
	$header = "Location: index.php";
	header($header);
	exit;
}

$title = "양도양수 매물 수정";
$description = "건설업 양도양수 매물 수정";
$keywords = "건설업, 양도양수, 양도양수 수정";
$errro_message = false;

$transfer_info_default = array(
	'company_name' => "", // 상호
	'company_type' => $config['transfer_companytype_array'][0], // 회사형태 // select
	'year_founded' => "", //설립연도
	'year_corporation' => "", // ?? 필요 없음 
	'capital' => "", // 자본금
	'deposit_bill' => "", // 공제조합출자수
	'remaining_amount' => "", //대출 후 남은 잔액
	'join_association' => 1, //협회 가입여부 //select
	'region' => $config['transfer_region_array'][0], //지역 //select
	'construction_in_progress' => 1, //진행중인 공사유무  //select
	'transfer_price' => "", // 양도가
	'status' => 1, //상태 //select
	'consultant' => $config['company_kr_name'], //상담원
	'phone' => $config['company_tel'], //전화
	'mobile' => $config['company_hp'], //HP
	'tag' => $config['transfer_tag_array'][0], //Tag //select
	'note' => "" //특기사항
);
$performance_info_array_default = array();
$transfer_sector_array_default = array();
$finstatements_info_default = array();

$mode = "add";
if(isset($_GET['reg_number']) && $_GET['reg_number']) {
	$reg_number = $_GET['reg_number'];
	$transfer_info = get_transfer_info($reg_number);
	$performance_info_array = get_performance_info($reg_number);
	$transfer_sector_array = transfer_info_per_sector($performance_info_array);
	if (!$transfer_sector_array)
		$transfer_sector_array = array();
	$finstatements_info = get_finstatements($reg_number);
	$mode = "edit";
} else if (isset($_POST['delete'])) {
	$mode = $_POST['mode'];
	$reg_number = $_POST['reg_number'];
	remove_transfer($reg_number);
	remove_performance_info($reg_number);
	remove_finstatements($reg_number);
	/* go to 양도양수 페이지 */
	$header = "Location: ".$config['page_files']['양도양수'];
	header($header);
	exit;
} else if (isset($_POST['save'])) {
	$mode = $_POST['mode'];
	$reg_number = $_POST['reg_number'];
	$company_name = $_POST['company_name'];
	if ($mode == "add") {
		$does_exist = is_atransfer_exist($company_name);
		if ($does_exist) {
			$errro_message = "같은 상호의 업체가 존재합니다. 등록번호: ".$does_exist;
		}
	}

	if (!$errro_message) {
		/* transfer */
		remove_transfer($reg_number); // remove previous transfer

		$company_type = $_POST['company_type'];
		$year_founded = $_POST['year_founded'];
		$year_corporation = $_POST['year_corporation'];
		$capital = $_POST['capital'];
		$deposit_bill = $_POST['deposit_bill'];
		$remaining_amount = $_POST['remaining_amount'];
		$join_association = $_POST['join_association'];
		$region = $_POST['region'];
		$construction_in_progress = $_POST['construction_in_progress'];
		$transfer_price = $_POST['transfer_price'];
		$status = $_POST['status'];
		if ($_POST['consultant'])
			$consultant = $_POST['consultant'];
		else
			$consultant = $config['company_kr_name'];
		if ($_POST['phone'])
			$phone = $_POST['phone'];
		else
			$phone = $config['company_tel'];
		if ($_POST['mobile'])
			$mobile = $_POST['mobile'];
		else
			$mobile = $config['company_hp'];
		$tag = $_POST['tag'];
		$note = save_textarea($_POST['note']);
		
		add_transfer_list($reg_number, $company_name, $company_type, $year_founded, $year_corporation, $capital, $deposit_bill, $remaining_amount, $join_association, $region, $construction_in_progress, $transfer_price, $status, $consultant, $phone, $mobile, $tag, $note);



		/* performance */
		remove_performance_info($reg_number);  // remove previous record

		$sector_array = $_POST['sector'];
		foreach($sector_array as $sector_key => $sector_value) {
			$sector = trim($sector_value, " \t\n\r\0\x0B");
			if ($sector == "")
				continue;
			$year_licensed = $_POST['year_licensed'][$sector_key];
			$construction_ability = $_POST['construction_ability'][$sector_key];
			foreach($performance_yesrs as $forEachYear) {
				if (isset($_POST['sales'][$sector_key][$forEachYear])) {
					$year = $forEachYear;
					$annual_sales = $_POST['sales'][$sector_key][$forEachYear];
					if ($annual_sales > 0) {
						add_performance_list($reg_number, $sector, $year_licensed, $construction_ability, $annual_sales, $year);
					}
				}
			}
			$year = $performance_last_yesr;
			$annual_sales = $_POST['sales'][$sector_key][$performance_last_yesr];
			add_performance_list($reg_number, $sector, $year_licensed, $construction_ability, $annual_sales, $year);
		}


		/* finstatements */
		remove_finstatements($reg_number); // remove previous record

		$debt_ratio = $_POST['debt_ratio'];
		$fixed_debt = $_POST['fixed_debt'];
		$current_ratio = $_POST['current_ratio'];
		$fixed_assets = $_POST['fixed_assets'];
		$total_capital = $_POST['total_capital'];
		$revenue = $_POST['revenue'];
		$operating_profit = $_POST['operating_profit'];
		$income_after_tax = $_POST['income_after_tax'];
		$debt_equity = $_POST['debt_equity'];

		add_finstatements($reg_number, $debt_ratio, $fixed_debt, $current_ratio, $fixed_assets, $total_capital, $revenue, $operating_profit, $income_after_tax, $debt_equity);


		/* go to 양도양수정보 페이지 */
		$header = "Location: ".$config['page_other_files']['양도양수정보']."?reg_number=".$reg_number;
		header($header);
		exit;
	}
}

if ($mode == "add") {
	$reg_number = get_new_regnumber();
	$transfer_info = $transfer_info_default;
	$performance_info_array = $performance_info_array_default;
	$transfer_sector_array = $transfer_sector_array_default;
	$finstatements_info = $finstatements_info_default;
}


//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc"); // header에서 로그인 상태 확인합니다.
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝
?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img2 subhead-bright">
	<div class="container">
		<h1 class="subhead-heading">양도양수 매물 수정</h1>
		<p class="subhead-subheading">양도양수 매물을 추가 또는 수정합니다.</p>
	</div>
</header>

<section class="page-section pb-4 pt-5" id="transferPrint">
	<div class="container mb-5">
		<form id="treanferForm" action="<?= $thispage_filename ?>" method="post">
			<input type="hidden" name="mode" value="<?=$mode?>">
			<?php if ($errro_message):?>
				<div class="alert alert-danger" role="alert"><?=$errro_message?></div>
			<?php endif;?>
			<?php if ($mode == "edit"):?>
			<div class="clearfix mb-3">
				<button type="submit" class="btn btn-danger float-end" onclick="return confirm('삭제하면 다시 복원할 수 없습니다. 삭제하시겠습니까?')" name="delete">이 양도 매물 삭제</button>
			</div>
			<?php endif;?>
			<!-- 회사 정보 -->
			<div class="d-flex flex-row bg-dark-subtle p-3 mb-3">
				<div class="d-inline-flex align-items-center me-3"><span style="font-size: 1.2rem"><i class="bi bi-file-post"></i> 등록번호</span></div>
				<div class="d-inline-flex text-center me-3"><input type="text" name="reg_number" value="<?=$reg_number?>" class="form-control" id="reg_number" readonly></div>
				<div class="d-inline-flex align-items-center me-3"><span style="font-size: 1.2rem">회사명</span></div>
				<div class="d-inline-flex text-center"><input type="text" name="company_name" value="<?php if (isset($transfer_info['company_name'])) echo $transfer_info['company_name'];?>" class="form-control" id="company_name" required></div>
			</div>
			<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="status" class="form-label">상태</label>
					<select class="form-select" name="status" id="status">
						<option value="1" <?php if($transfer_info['status'] == 1) echo "selected";?>>계약가능</option>
						<option value="0" <?php if($transfer_info['status'] == 0) echo "selected";?>>계약완료</option>
					</select>
				</div>
				<div class="col">
					<label for="tag" class="form-label">Tag</label>
					<select class="form-select" name="tag" id="tag">
						<?php foreach($config['transfer_tag_array'] as $etag):?>
							<option value="<?=$etag?>" <?php if($etag == $transfer_info['tag']) echo "selected";?>><?=$etag?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="col">
					<label for="transfer_price" class="form-label">양도가 (백만원, 0은 협의)</label>
					<input type="text" name="transfer_price" value="<?=$transfer_info['transfer_price']?>" class="form-control" id="transfer_price" required>
				</div>
				<div class="col">
					<label for="company_type" class="form-label">회사형태</label>
					<select class="form-select" name="company_type" id="company_type">
						<?php foreach($config['transfer_companytype_array'] as $etype):?>
							<option value="<?=$etype?>" <?php if($etype == $transfer_info['company_type']) echo "selected";?>><?=$etype?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="col">
					<label for="year_founded" class="form-label">설립연도</label>
					<input type="text" name="year_founded" value="<?=$transfer_info['year_founded']?>" class="form-control" id="year_founded" required>
				</div>
				<div class="col">
					<label for="capital" class="form-label">자본금 (백만원)</label>
					<input type="text" name="capital" value="<?=$transfer_info['capital']?>" class="form-control" id="capital" required>
				</div>
			</div>
			<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="deposit_bill" class="form-label">공제조합출자수</label>
					<input type="text" name="deposit_bill" value="<?=$transfer_info['deposit_bill']?>" class="form-control" id="deposit_bill" required>
				</div>
				<div class="col">
					<label for="remaining_amount" class="form-label">대출 후 남은 잔액 (백만원)</label>
					<input type="text" name="remaining_amount" value="<?=$transfer_info['remaining_amount']?>" class="form-control" id="remaining_amount" required>
				</div>
				<div class="col">
					<label for="join_association" class="form-label">협회 가입여부</label>
					<select class="form-select" name="join_association" id="join_association">
						<option value="1" <?php if($transfer_info['join_association'] == 1) echo "selected";?>>가입</option>
						<option value="0" <?php if($transfer_info['join_association'] == 0) echo "selected";?>>미가입</option>
					</select>
				</div>
				<div class="col">
					<label for="construction_in_progress" class="form-label">진행중인 공사유무</label>
					<select class="form-select" name="construction_in_progress" id="construction_in_progress">
						<option value="1" <?php if($transfer_info['construction_in_progress'] == 1) echo "selected";?>>유</option>
						<option value="0" <?php if($transfer_info['construction_in_progress'] == 0) echo "selected";?>>무</option>
					</select>
				</div>
				<div class="col">
					<label for="region" class="form-label">지역</label>
					<select class="form-select" name="region" id="region">
						<?php foreach($config['transfer_region_array'] as $eregion):?>
							<option value="<?=$eregion?>" <?php if($eregion == $transfer_info['region']) echo "selected";?>><?=$eregion?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>
			<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="consultant" class="form-label">상담원</label>
					<input type="text" name="consultant" value="<?=$transfer_info['consultant']?>" class="form-control" id="consultant">
				</div>
				<div class="col">
					<label for="phone" class="form-label">전화</label>
					<input type="text" name="phone" value="<?=$transfer_info['phone']?>" class="form-control" id="phone">
				</div>
				<div class="col-auto">
					<label for="mobile" class="form-label">HP</label>
					<input type="text" name="mobile" value="<?=$transfer_info['mobile']?>" class="form-control" id="mobile">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="note" class="form-label">특기사항</label>
					<textarea type="text" name="note" class="form-control" id="note" rows="5"><?php if($transfer_info['note'] != "") echo get_textarea($transfer_info['note']);?></textarea>
				</div>
			</div>

			<!-- 업종별 실적 -->
			<div class="d-flex flex-row bg-dark-subtle p-3 mt-5 mb-3">
				<div class="d-inline-flex align-items-center me-3"><span style="font-size: 1.2rem"><i class="bi bi-clipboard-data"></i> 업종별 내용 (백만원)</span></div>
			</div>
			<table class="table table-hover table-bordered align-middle text-center">
				<thead class="table-light">
					<tr class="align-middle text-center">
						<th scope="col">업종분류</th>
						<th scope="col">업종</th>
						<th scope="col">등록년도</th>
						<th scope="col">시공능력</th>
						<?php foreach($performance_yesrs as $forEachYear):?>
						<th scope="col"><?=$forEachYear?>년</th>
						<?php endforeach;?>
						<th scope="col"><?=$performance_last_yesr?>년</th>
					</tr>
				</thead>
				
				<?php $sectori = 0;?>
				<tbody>
					<?php if (count($transfer_sector_array) > 0):?>
					<?php foreach ($transfer_sector_array as $eachsector) : ?>
						<tr>
							<td>
								<select class="form-select" name="category<?=$sectori?>" id="category<?=$sectori?>">
								</select>
							</td>
							<td>
								<select class="form-select" name="sector[<?=$sectori?>]" id="sector<?=$sectori?>">
								</select>
							</td>
							<td>
								<input type="text" name="year_licensed[<?=$sectori?>]" value="<?=$eachsector['year_licensed']?>" class="form-control" id="year_licensed[<?=$sectori?>]">
							</td>
							<td>
								<input type="text" name="construction_ability[<?=$sectori?>]" value="<?=$eachsector['construction_ability']?>" class="form-control" id="construction_ability[<?=$sectori?>]">
							</td>
							<?php
							if(isset($eachsector['sales'])) {
								// each sales for each year
								foreach($performance_yesrs as $forEachYear){
									if (isset($eachsector['sales'][$forEachYear])) {
										echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$forEachYear}]\" value=\"{$eachsector['sales'][$forEachYear]}\" class=\"form-control\" id=\"sales[{$sectori}][{$forEachYear}]\"></td>";
									} else {
										echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$forEachYear}]\" value=\"\" class=\"form-control\" id=\"sales[{$sectori}][{$forEachYear}]\"></td>";
									}
								}
								if (isset($eachsector['sales'][$performance_last_yesr])) {
									echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$performance_last_yesr}]\" value=\"{$eachsector['sales'][$performance_last_yesr]}\" class=\"form-control\" id=\"sales[{$sectori}][{$performance_last_yesr}]\"></td>";
								} else {
									echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$sectori}][{$performance_last_yesr}]\" value=\"\" class=\"form-control\" id=\"sales[{$sectori}][{$performance_last_yesr}]\"></td>";
								}
							} else {
								foreach($performance_yesrs as $forEachYear){
									echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$forEachYear}]\" value=\"\" class=\"form-control\" id=\"sales[{$sectori}][{$forEachYear}]\"></td>";
								}
								echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$performance_last_yesr}]\" value=\"\" class=\"form-control\" id=\"sales[{$sectori}][{$performance_last_yesr}]\"></td>";
							}
							?>
						</tr>
					<?php $sectori++; endforeach; ?>
					<?php endif;?>
					<?php for($i=$sectori; $i < $config['max_sectors_per_company']; $i++):?>
						<tr>
							<td>
								<select class="form-select" name="category<?=$sectori?>" id="category<?=$sectori?>">
								</select>
							</td>
							<td>
								<select class="form-select" name="sector[<?=$sectori?>]" id="sector<?=$sectori?>">
								</select>
							</td>
							<td>
								<input type="text" name="year_licensed[<?=$sectori?>]" value="" class="form-control" id="year_licensed[<?=$sectori?>]">
							</td>
							<td>
								<input type="text" name="construction_ability[<?=$sectori?>]" value="" class="form-control" id="construction_ability[<?=$sectori?>]">
							</td>
							<?php
								foreach($performance_yesrs as $forEachYear){
									echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$forEachYear}]\" value=\"\" class=\"form-control\" id=\"sales[{$sectori}][{$forEachYear}]\"></td>";
								}
								echo "<td><input type=\"text\" name=\"sales[{$sectori}][{$performance_last_yesr}]\" value=\"\" class=\"form-control\" id=\"sales[{$sectori}][{$performance_last_yesr}]\"></td>";
							?>
						</tr>
					<?php $sectori++; endfor;?>
				</tbody>
			</table>

			
			<!-- 재무재표 -->
			<div class="d-flex flex-row bg-dark-subtle p-3 mt-5 mb-3">
				<div class="d-inline-flex align-items-center me-3"><span style="font-size: 1.2rem"><i class="bi bi-graph-up-arrow"></i> 재무재표</span></div>
			</div>
			<div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-2 g-lg-3 mb-4">
				<div class="col">	
					<label for="debt_ratio" class="form-label">부채비율 (%)</label>
					<input type="text" name="debt_ratio" value="<?php if(isset($finstatements_info['debt_ratio'])) echo $finstatements_info['debt_ratio'];?>" class="form-control" id="debt_ratio">
				</div>
				<div class="col">
					<label for="fixed_debt" class="form-label">고정부채</label>
					<input type="text" name="fixed_debt" value="<?php if(isset($finstatements_info['fixed_debt'])) echo $finstatements_info['fixed_debt'];?>" class="form-control" id="fixed_debt">
				</div>
				<div class="col">
					<label for="current_ratio" class="form-label">유동비율 (%)</label>
					<input type="text" name="current_ratio" value="<?php if(isset($finstatements_info['current_ratio'])) echo $finstatements_info['current_ratio'];?>" class="form-control" id="current_ratio">
				</div>
				<div class="col">
					<label for="fixed_assets" class="form-label">고정자산</label>
					<input type="text" name="fixed_assets" value="<?php if(isset($finstatements_info['fixed_assets'])) echo $finstatements_info['fixed_assets'];?>" class="form-control" id="fixed_assets">
				</div>
				<div class="col">
					<label for="total_capital" class="form-label">자본총계</label>
					<input type="text" name="total_capital" value="<?php if(isset($finstatements_info['total_capital'])) echo $finstatements_info['total_capital'];?>" class="form-control" id="total_capital">
				</div>
				<div class="col">
					<label for="revenue" class="form-label">매출액</label>
					<input type="text" name="revenue" value="<?php if(isset($finstatements_info['revenue'])) echo $finstatements_info['revenue'];?>" class="form-control" id="revenue">
				</div>
				<div class="col">
					<label for="operating_profit" class="form-label">영업손익</label>
					<input type="text" name="operating_profit" value="<?php if(isset($finstatements_info['operating_profit'])) echo $finstatements_info['operating_profit'];?>" class="form-control" id="operating_profit">
				</div>
				<div class="col">
					<label for="income_after_tax" class="form-label">법인세차감손익</label>
					<input type="text" name="income_after_tax" value="<?php if(isset($finstatements_info['income_after_tax'])) echo $finstatements_info['income_after_tax'];?>" class="form-control" id="income_after_tax">
				</div>
				<div class="col">
					<label for="debt_equity" class="form-label">부채와자본총계</label>
					<input type="text" name="debt_equity" value="<?php if(isset($finstatements_info['debt_equity'])) echo $finstatements_info['debt_equity'];?>" class="form-control" id="debt_equity">
				</div>
			</div>


			<!-- buttons -->
			<div class="row justify-content-end">	
				<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button  type="submit" class="btn btn-primary px-4" name="save">저장</button></div>
				<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button type="button" class="btn btn-secondary px-4" onclick="location.href='<?php if($mode == "edit") echo $config['page_other_files']['양도양수정보']."?reg_number=".$reg_number; else echo $config['page_files']['양도양수']; ?>'">취소</button></div>
			</div>
		</form>
	</div>
</section>

<!-- cascading selection -->
<script>
	var sectorObject = {
		"종합건설업": [<?php for($i=0; $i<count($config['종합건설업']); $i++) {
				echo "\"".$config['종합건설업'][$i]."\"";
				if ($i < (count($config['종합건설업']) - 1)) echo ",";
			}?>],
		"전문건설업": [<?php $pro_constructor_sectors = get_pro_sectors();
			for($i=0; $i<count($pro_constructor_sectors); $i++) {
				echo "\"".$pro_constructor_sectors[$i]."\"";
				if ($i < (count($pro_constructor_sectors) - 1)) echo ",";
			}?>],
		"기타공사업": [<?php for($i=0; $i<count($config['기타공사업']); $i++) {
				echo "\"".$config['기타공사업'][$i]."\"";
				if ($i < (count($config['기타공사업']) - 1)) echo ",";
			}?>],
	}
	window.onload = function () {
	<?php for($i=0; $i < $config['max_sectors_per_company']; $i++):?>
		<?php if(isset($transfer_sector_array[$i]['sector'])):?>
			let selectedcategory<?=$i?> = '<?=get_category($transfer_sector_array[$i]['sector'])?>';
			let selectedsector<?=$i?> = '<?=$transfer_sector_array[$i]['sector']?>';
		<?php else:?>
			let selectedcategory<?=$i?> = '';
			let selectedsector<?=$i?> = '';
		<?php endif;?>
		let category<?=$i?> = document.getElementById("category<?=$i?>");
		let sector<?=$i?> = document.getElementById("sector<?=$i?>");
		for (let category in sectorObject) {
			let catselected<?=$i?> = false;
			if (category == selectedcategory<?=$i?>) {
				catselected<?=$i?> = true;
			}
			category<?=$i?>.options[category<?=$i?>.options.length] = new Option(category, category, false, catselected<?=$i?>);
		}
		category<?=$i?>.onchange = function () {
			sector<?=$i?>.length = 1; // remove all options bar first
			//if (this.selectedIndex < 1) return; // done
			let sectors<?=$i?> = sectorObject[this.value];
			for (let seci = 0; seci < sectors<?=$i?>.length; seci++) {
				let selected<?=$i?> = false;
				if (sectors<?=$i?>[seci] == selectedsector<?=$i?>) {
					selected<?=$i?> = true;
				}
				sector<?=$i?>.options[sector<?=$i?>.options.length] = new Option(sectors<?=$i?>[seci], sectors<?=$i?>[seci], false, selected<?=$i?>);
			}
		}
		category<?=$i?>.onchange(); // reset in case page is reloaded
	<?php endfor;?>
	}
</script>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>