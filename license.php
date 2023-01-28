<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
include("inc/utils.inc"); //그외 functions 
include("inc/sql.inc"); //mysql 관련 functions

$title = "신규건설업등록";
$description = "건설업 면허 등록 기준";
$keywords = "건설업, 면허, 면허등록, 신규건설업등록, 전문건설업, 종합건설업, 기타공사업";

$sector = "";
$category = "";
$subcategory = "";
$scrolltosector = false;

$fund_private = 0;
$fund_corporation = 0;
$fund_explain = "";
$cooperative_name = "";
$cooperative_private = 0;
$cooperative_corporation = 0;
$cooperative_explain = "";
$detail_head = "";
$detail = "";
$example_head = "";
$example = "";
$facility = "";
$ability_head = "";
$ability = "";
$technician = "";

$license_array = array(
	'fund_private' => $fund_private,
	'fund_corporation' => $fund_corporation,
	'fund_explain' => $fund_explain,
	'cooperative_name' => $cooperative_name,
	'cooperative_private' => $cooperative_private,
	'cooperative_corporation' => $cooperative_corporation,
	'cooperative_explain' => $cooperative_explain,
	'detail_head' => $detail_head,
	'detail' => $detail,
	'example_head' => $example_head,
	'example' => $example,
	'facility' => $facility,
	'ability_head' => $ability_head,
	'ability' => $ability,
	'technician' => $technician
);

if(isset($_GET['pro']) || (isset($_POST['category']) && $_POST['category'] == "전문건설업") || isset($_POST['subcategory'])) {
	$category = "전문건설업";
} elseif(isset($_GET['others']) || (isset($_POST['category']) && $_POST['category'] == "기타공사업")) {
	$category = "기타공사업";
} else {
	$category = "종합건설업";
}

if (isset($_POST['sector']) && $_POST['sector']) {
	$sector = $_POST['sector'];
	$category = get_category($sector);
	if ($category == "전문건설업") {
		$subcategory = get_pro_subcategory($sector);
		$scrolltosector = true;
	}
} else {
	if ($category == "전문건설업") {
		if (isset($_POST['subcategory']) && $_POST['subcategory']){
			$subcategory = $_POST['subcategory'];
			$sector = $config[$category][$subcategory][0];
		} else {
			foreach($config[$category] as $key => $value) {
				$sector = $value[0];
				$subcategory = $key;
				break;
			}
		}
	} else {
		$sector = $config[$category][0];
	}
}

if (is_license_exist($sector))
	$license_array = get_license_html($sector);

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img2 text-secondary">
	<div class="container">
		<h1 class="subhead-heading"><?=$category?> 면허 등록 기준</h1>
		<p class="subhead-subheading">면허 등록 기준을 업종별로 확인하세요.</p>
	</div>
</header>

<!-- 업종 선택 -->
<section class="page-section portfolio pt-5 pb-0" id="categorySelection">
	<div class="container">
		<form id="licenseForm" action="<?= $thispage_filename ?>" method="post">
			<div class="d-flex flex-row mx-md-3 justify-content-between">
				<div class="d-grid col-md-3 mb-2 <?php if($category == "종합건설업") echo "sticky-top bg-warning"; else echo "sticky-bottom bg-dark-subtle";?> text-center p-1" style="font-size: 1.2rem"><button type="submit" class="btn btn-block" name="category" value="종합건설업">종합건설업</button></div>
				<div class="d-grid col-md-3 mb-2 <?php if($category == "전문건설업") echo "sticky-top bg-warning"; else echo "sticky-bottom bg-dark-subtle";?> text-center p-1" style="font-size: 1.2rem"><button type="submit" class="btn btn-block" name="category" value="전문건설업">전문건설업</button></div>
				<div class="d-grid col-md-3 mb-2 <?php if($category == "기타공사업") echo "sticky-top bg-warning"; else echo "sticky-bottom bg-dark-subtle";?> text-center p-1" style="font-size: 1.2rem"><button type="submit" class="btn btn-block" name="category" value="기타공사업">기타공사업</button></div>
			</div>
			<div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 border border-warning sticky-top bg-dark-subtle px-4 pb-4 pt-3 g-3">
				<?php if($category == "전문건설업"): ?>
					<?php foreach ($config[$category] as $each_key => $each_sector):?>
						<div class="d-grid"><button type="submit" class="btn btn-block btn-success px-1 <?php if($subcategory == $each_key) echo "active";?>" name="subcategory" value="<?=$each_key?>"><?=$each_key?></button></div>
					<?php endforeach;?>
				<?php else:?>
					<?php foreach($config[$category] as $each_sector):?>
							<div class="d-grid"><button type="submit" class="btn btn-block btn-success px-1 <?php if($sector == $each_sector) echo "active";?>" name="sector" value="<?=$each_sector?>"><?=$each_sector?></button></div>
					<?php endforeach;?>
				<?php endif;?>
			</div>
		</form>
	</div>
</section>

<!-- 업종 등록 기준 상세 -->
<section class="page-section py-5" id="licenseContent">
	<div class="container">
		<div class="d-flex flex-row bg-dark opacity-75 text-white p-3 justify-content-between">
			<div class="d-inline-flex align-items-center me-3"><h3 class="my-0"><i class="bi bi-file-post"></i> <?php if($category == "전문건설업") echo $subcategory; else echo $sector;?></h3></div>
			<?php if($userlogin):?>
			<div class="col col-md-3 col-lg-2 text-center">
				<button type="button" class="btn btn-info btn-sm px-5" onclick="location.href='<?=$config['page_other_files']['신규건설업등록수정']?>?sector=<?=$sector?>'">수정</button>
			</div>
			<?php endif;?>
		</div>
		
		<!-- 전문 건설업 하부 업종 선택 -->
		<?php if($category == "전문건설업"):?>
			<form id="sectorForm" action="<?= $thispage_filename ?>" method="post">
			<div class="col-auto mt-4"><h5><i class="bi bi-tag-fill"></i> 주력 분야</h5></div>
			<div class="row row-cols-3 row-cols-md-4 px-4 pb-4 pt-2 g-3">
			<?php foreach ($config[$category][$subcategory] as $each_sector):?>
				<div class="d-grid"><button type="submit" class="btn btn-block btn-light px-1 <?php if($sector == $each_sector) echo "active";?>" name="sector" value="<?=$each_sector?>"><?=$each_sector?></button></div>
			<?php endforeach;?>
			</div>
			</form>
		<?php endif;?>
		
		<!-- 자금 및 공제조합 출자 -->
		<div class="col-auto mt-3"><h5><i class="bi bi-tag-fill"></i> 자금 및 공제조합 출자</h5></div>
		<div class="row row-cols-1 row-cols-md-2 g-3">
			<div class="col">
				<div class="row mx-md-2 mx-lg-3">
					<div class="col-5 d-flex align-items-center justify-content-center bg-primary-subtle">자금</div>
					<div class="col-7">
						<div class="row transfer-border">
							<div class="col d-flex align-items-center justify-content-center p-2 border-end"><i class="bi bi-building-fill"></i> 법인</div>
							<div class="col d-flex align-items-center justify-content-center p-2 "><?php if ($license_array['fund_corporation'] > 0) echo "<span class='text-danger fw-bold'>".print_money($license_array['fund_corporation'])."</span> 이상"; else echo "없음";?></div>
						</div>
						<div class="row transfer-border">
							<div class="col d-flex align-items-center justify-content-center p-2 border-end"><i class="bi bi-person-fill"></i> 개인</div>
							<div class="col d-flex align-items-center justify-content-center p-2 "><?php if ($license_array['fund_private'] > 0) echo "<span class='text-danger fw-bold'>".print_money($license_array['fund_private'])."</span> 이상"; else echo "없음";?></div>
						</div>
					</div>
				</div>
				<div class="row mx-md-2 mx-lg-3">
					<div class="px-2 opacity-75" style="font-size: 0.95em"><?php if ($license_array['fund_explain'] != "") echo $license_array['fund_explain'];?></div>
				</div>
			</div>
			<div class="col">
				<div class="row mx-md-2 mx-lg-3">
					<div class="col-5 d-flex align-items-center justify-content-center bg-primary-subtle">공제조합 출자<?php if($license_array['cooperative_name'] != "") echo "<br>(".$license_array['cooperative_name'].")";?></div>
					<div class="col-7">
						<div class="row transfer-border">
							<div class="col d-flex align-items-center justify-content-center p-2 border-end"><i class="bi bi-building-fill"></i> 법인</div>
							<div class="col d-flex align-items-center justify-content-center p-2">
								<?php 
									if (strpos($license_array['cooperative_corporation'], "원")) {
										echo "<p><span class='text-danger fw-bold'>".$license_array['cooperative_corporation']."</span> 이상의 좌수 출자</p>"; 
									} else {
										if ($license_array['cooperative_corporation'] > 0) { 
											echo "<span class='text-danger fw-bold'>".$license_array['cooperative_corporation']."좌</span>"; 
										} else {
											echo "없음";
										}
									}
								?>
							</div>
						</div>
						<div class="row transfer-border">
							<div class="col d-flex align-items-center justify-content-center p-2 border-end"><i class="bi bi-person-fill"></i> 개인</div>
							<div class="col d-flex align-items-center justify-content-center p-2">
								<?php 
									if (strpos($license_array['cooperative_private'], "원")) {
										echo "<p><span class='text-danger fw-bold'>".$license_array['cooperative_private']."</span> 이상의 좌수 출자</p>"; 
									} else {
										if ($license_array['cooperative_private'] > 0) { 
											echo "<span class='text-danger fw-bold'>".$license_array['cooperative_private']."좌</span>"; 
										} else {
											echo "없음";
										}
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row mx-md-2 mx-lg-3">
					<div class="px-2 license-content" style="font-size: 0.95em"><?php if ($license_array['cooperative_explain'] != "") echo $license_array['cooperative_explain'];?></div>
				</div>
			</div>
		</div>

		<!-- 기술 능력 -->
		<div class="col-auto mt-5"><h5><i class="bi bi-tag-fill"></i> 기술능력 <?php if($license_array['ability_head'] != "") echo "(".$license_array['ability_head'].")";?></h5></div>
		<div class="row row-cols-1">
			<div class="col mx-3 license-content">
				<?=$license_array['ability']?>
			</div>
			<?php if ($license_array['technician'] != ""):?>
			<div class="col mx-3 mt-2">
				<button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTechnician" aria-expanded="false" aria-controls="collapseTechnician">국가기술자격법에 따른 관련종목 기술자격 보기</button>
				<div class="collapse mt-2" id="collapseTechnician">
					<div class="card card-body license-content border-light">
						<?=$license_array['technician']?>
					</div>
				</div>
			</div>
			<?php endif;?>
		</div>

		<!-- 시설 및 장비 -->
		<div class="col-auto mt-5"><h5><i class="bi bi-tag-fill"></i> <?=$sector?>의 시설 및 장비</h5></div>
		<div class="row row-cols-1">
			<div class="col mx-3 license-content">
				<?=$license_array['facility']?>
			</div>
		</div>

		<!-- 업무 내용 -->
		<div class="col-auto mt-5"><h5><i class="bi bi-tag-fill"></i> <?=$sector?>의 업무 내용</h5></div>
		<div class="row row-cols-1">
			<div class="col mx-3 license-content">
				<?=$license_array['detail']?>
			</div>
			<?php if($license_array['detail_head']):?>
			<div class="col mx-3 license-content">
				<?=$license_array['detail_head']?>
			</div>
			<?php endif;?>
		</div>

		<!-- 예시 -->
		<?php if ($license_array['example'] != ""):?>
		<div class="col-auto mt-5"><h5><i class="bi bi-tag-fill"></i> 건설공사의 예시</h5></div>
		<div class="row row-cols-1">
			<div class="col mx-3 license-content">
				<?=$license_array['example']?>
			</div>
			<?php if($license_array['example_head']):?>
			<div class="col mx-3 license-content">
				<?=$license_array['example_head']?>
			</div>
			<?php endif;?>
		</div>
		<?php endif;?>



		<!-- pdf -->
		<!-- <div class="text-center"><object data="pdf/sample01.pdf" type="application/pdf" width="80%" height="1000"></object></div> -->
		<!-- About Section Button-->
	</div>
</section>

<?php if($scrolltosector):?>
<script>
	window.onload = function() {
		const element = document.getElementById("licenseContent");
		element.scrollIntoView();
	}
</script>
<?php endif;?>



<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>