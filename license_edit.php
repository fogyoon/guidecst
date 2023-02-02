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

$title = "면허 등록 기준 수정";
$description = "건설업 면허 등록 기준 수정";
$keywords = "건설업, 면허, 면허등록, 신규건설업등록, 전문건설업, 종합건설업, 기타공사업";

$errro_message = false;

$sector = "";
$category = "";
$subcategory = "";

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

if(isset($_GET['sector']) && $_GET['sector']) {
	$sector = $_GET['sector'];
}
if(isset($_POST['sector']) && $_POST['sector']) {
	$sector = $_POST['sector'];
}

$mode = "add";
if ($sector != ""){
	$all_sectors_array = get_all_sectors();
	if(!in_array($sector, $all_sectors_array)) {
		$errro_message = "유효하지않는 업종입니다.";
	} else {
		$category = get_category($sector);
		if ($category == "전문건설업") {
			$subcategory = get_pro_subcategory($sector);
		}
		$mode = "edit";
	}
}

if(isset($_POST['save']) && $sector != "") {
	$fund_private = $_POST['fund_private'];
	$fund_corporation = $_POST['fund_corporation'];
	$fund_explain = $_POST['fund_explain'];
	$cooperative_name = $_POST['cooperative_name'];
	$cooperative_private = $_POST['cooperative_private'];
	$cooperative_corporation = $_POST['cooperative_corporation'];
	$cooperative_explain = $_POST['cooperative_explain'];
	$detail_head = $_POST['detail_head'];
	$detail = $_POST['detail'];
	$example_head = $_POST['example_head'];
	$example = $_POST['example'];
	$facility = $_POST['facility'];
	$ability_head = $_POST['ability_head'];
	$ability = $_POST['ability'];
	$technician = $_POST['technician'];
	write_license($sector, $fund_private, $fund_corporation, $fund_explain, $cooperative_name, $cooperative_private, $cooperative_corporation, $cooperative_explain, $detail_head, $detail, $example_head, $example, $facility, $ability_head, $ability, $technician);

	$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$config['page_files']['신규건설업등록']}'>
<input type='hidden' name='sector' value='{$sector}'>
</form></body></html>
EOD;

	echo $post_page;
	exit;
} elseif(isset($_POST['cancel'])) {
	if($sector != "") {
		$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$config['page_files']['신규건설업등록']}'>
<input type='hidden' name='sector' value='{$sector}'>
</form></body></html>
EOD;

		echo $post_page;
		exit;
	} else {
		$header = "Location: {$config['page_files']['신규건설업등록']}";
		header($header);
		exit;
	}

}

if ($sector != "") {
	if (is_license_exist($sector))
		$license_array = get_license($sector);
}


//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img2 text-secondary subhead-bright">
	<div class="container">
		<h1 class="subhead-heading">면허 등록 기준 수정</h1>
		<p class="subhead-subheading"><?php if($sector != "") echo $sector."의 ";?>면허 등록 기준을 수정합니다.</p>
	</div>
</header>

<!-- 면허 등록 기준 수정 -->
<section class="page-section py-5" id="about">
	<div class="container">
		<!-- form -->
		<form id="licenseForm" action="<?= $thispage_filename ?>" method="post">
			<?php if ($errro_message):?>
				<div class="alert alert-danger" role="alert"><?=$errro_message?></div>
			<?php endif;?>
			<!-- header -->
			<?php if($mode == "edit"):?>
			<input type="hidden" name="sector" value="<?=$sector?>">
			<?php endif;?>
			<div class="d-flex flex-row bg-dark p-3 mb-3 text-white">
				<div class="d-inline-flex align-items-center me-3"><span style="font-size: 1.2rem">분류</span></div>
				<div class="d-inline-flex text-center me-3"><select class="form-select" name="category" id="category" <?php if($mode == "edit") echo "disabled";?>></select></div>
				<div class="d-inline-flex align-items-center me-3"><span style="font-size: 1.2rem">업종</span></div>
				<div class="d-inline-flex text-center"><select class="form-select" name="sector" id="sector" <?php if($mode == "edit") echo "disabled";?>></select></div>
			</div>

			<!-- 자본금 공제조합 -->
			<div class="d-flex flex-row bg-dark-subtle mb-3 px-3 py-2">자금 및 공제조합 출자</div>

			<div class="row row-cols-4 row-cols-md-4 row-cols-lg-4 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="fund_corporation" class="form-label">자금 법인(백만원, 0은 없음)</label>
					<input type="text" name="fund_corporation" value="<?=$license_array['fund_corporation']?>" class="form-control" id="fund_corporation">
				</div>
				<div class="col">
					<label for="fund_private" class="form-label">자금 개인(백만원, 0은 없음)</label>
					<input type="text" name="fund_private" value="<?=$license_array['fund_private']?>" class="form-control" id="fund_private">
				</div>
				<div class="col">
					<label for="fund_explain" class="form-label">자금 부가설명</label>
					<input type="text" name="fund_explain" value="<?=$license_array['fund_explain']?>" class="form-control" id="fund_explain">
				</div>
			</div>

			<div class="row row-cols-4 row-cols-md-4 row-cols-lg-4 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="cooperative_name" class="form-label">공제조합 이름</label>
					<input type="text" name="cooperative_name" value="<?=$license_array['cooperative_name']?>" class="form-control" id="cooperative_name">
				</div>
				<div class="col">
					<label for="cooperative_corporation" class="form-label">출자 법인(좌, 0은 없음)</label>
					<input type="text" name="cooperative_corporation" value="<?=$license_array['cooperative_corporation']?>" class="form-control" id="cooperative_corporation">
				</div>
				<div class="col">
					<label for="cooperative_private" class="form-label">출자 개인(좌, 0은 없음)</label>
					<input type="text" name="cooperative_private" value="<?=$license_array['cooperative_private']?>" class="form-control" id="cooperative_private">
				</div>
				<div class="col">
					<label for="cooperative_explain" class="form-label">공제조합 부가설명</label>
					<textarea type="text" name="cooperative_explain" class="form-control" id="cooperative_explain" rows="1"><?=$license_array['cooperative_explain']?></textarea>
				</div>
			</div>
			
			<!-- 업무내용 -->
			<div class="d-flex flex-row bg-dark-subtle mb-3 px-3 py-2">업무 내용</div>

			<div class="row row-cols-2 row-cols-md-2 row-cols-lg-2 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="detail" class="form-label">업무내용</label>
					<textarea type="text" name="detail" class="form-control" id="detail" rows="5"><?=$license_array['detail']?></textarea>
				</div>
				<div class="col">
					<label for="detail_head" class="form-label">업무내용 부가 설명</label>
					<input type="text" name="detail_head" value="<?=$license_array['detail_head']?>" class="form-control" id="detail_head">
				</div>
			</div>
			
			<!-- 업무 예시 -->
			<div class="d-flex flex-row bg-dark-subtle mb-3 px-3 py-2">업무예시</div>

			<div class="row row-cols-2 row-cols-md-2 row-cols-lg-2 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="example" class="form-label">예시</label>
					<textarea type="text" name="example" class="form-control" id="example" rows="5"><?=$license_array['example']?></textarea>
				</div>
				<div class="col">
					<label for="example_head" class="form-label">예시 부가 설명</label>
					<input type="text" name="example_head" value="<?=$license_array['example_head']?>" class="form-control" id="example_head">
				</div>
			</div>
			
			<!-- 기술 능력 -->
			<div class="d-flex flex-row bg-dark-subtle mb-3 px-3 py-2">기술능력</div>

			<div class="row row-cols-2 row-cols-md-2 row-cols-lg-2 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="ability" class="form-label">기술능력</label>
					<textarea type="text" name="ability" class="form-control" id="ability" rows="5"><?=$license_array['ability']?></textarea>
				</div>
				<div class="col">
					<label for="ability_head" class="form-label">기술능력 부가 설명</label>
					<input type="text" name="ability_head" value="<?=$license_array['ability_head']?>" class="form-control" id="ability_head">
				</div>
			</div>

			
			<!-- 기술 자격 -->
			<div class="d-flex flex-row bg-dark-subtle mb-3 px-3 py-2">기술자격</div>

			<div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="technician" class="form-label">기술자격(html table tag 까지 입력)</label>
					<textarea type="text" name="technician" class="form-control" id="technician" rows="5"><?=$license_array['technician']?></textarea>
				</div>
			</div>

			
			<!-- 시설 및 장비 -->
			<div class="d-flex flex-row bg-dark-subtle mb-3 px-3 py-2">시설 및 장비</div>

			<div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 g-2 g-lg-3 mb-4">
				<div class="col">
					<label for="facility" class="form-label">시설 및 장비</label>
					<textarea type="text" name="facility" class="form-control" id="facility" rows="5"><?=$license_array['facility']?></textarea>
				</div>
			</div>

			<!-- button -->
			<div class="row justify-content-end">	
				<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button  type="submit" class="btn btn-primary px-4" name="save">저장</button></div>
				<div class="col-4 col-md-3 col-lg-2 mb-3 text-center"><button  type="submit" class="btn btn-secondary px-4" name="cancel">취소</button></div>
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
		let selectedcategory = '';
		let selectedsector = '';
		<?php if(isset($sector)):?>
			selectedcategory = '<?=get_category($sector)?>';
			selectedsector = '<?=$sector?>';
		<?php endif;?>
		let categoryElement = document.getElementById("category");
		let sectorElement = document.getElementById("sector");
		for (let category in sectorObject) {
			let catselected = false;
			if (category == selectedcategory) {
				catselected = true;
			}
			categoryElement.options[categoryElement.options.length] = new Option(category, category, false, catselected);
		}
		category.onchange = function () {
			sector.length = 1; // remove all options bar first
			let sectors = sectorObject[this.value];
			for (let seci = 0; seci < sectors.length; seci++) {
				let selected = false;
				if (sectors[seci] == selectedsector) {
					selected = true;
				}
				sectorElement.options[sectorElement.options.length] = new Option(sectors[seci], sectors[seci], false, selected);
			}
		}
		category.onchange(); // reset in case page is reloaded
	}
</script>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>