<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
include("inc/utils.inc"); //그외 functions 
include("inc/sql.inc"); //mysql 관련 functions

$title = "양도양수";
$description = "건설업 양도 양수";
$keywords = "건설업, 양도양수";

//make_test_environments();

$filters_array = array('need_filter' => false, 'new_licensed' => false);
$sector_filter = array();
$pre_searchType = "sector";

if ($_POST) {
	$pre_searchType = $_POST['searchType'];
	if ($_POST['searchType'] == "sector") { 
		if (isset($_POST['checked_new_sectors'])) {
			if (count($_POST['checked_new_sectors']) > 0) {
				$sector_filter = array_values($_POST['checked_new_sectors']);
				$filters_array['new_licensed'] = true;
				$pre_checked_new_sectors = $_POST['checked_new_sectors'];
			}
		} elseif (isset($_POST['checked_sectors'])) {
			if (count($_POST['checked_sectors']) > 0) {
				$sector_filter = array_values($_POST['checked_sectors']);
				$pre_checked_sectors = $_POST['checked_sectors'];
			}
		}
		if (count($sector_filter) > 0) {
			$filters_array['need_filter'] = true;
			$filters_array['sectors'] = $sector_filter;
		}
	} else if ($_POST['searchType'] == "reg_number" && isset($_POST['reg_number'])) {
		$filters_array['need_filter'] = true;
		$filters_array['reg_number'] = $_POST['reg_number'];
		$pre_reg_number = $_POST['reg_number'];
	}
}

$db_fail = false;
$error_log = false;
if (!check_connect_dbserver()) {
	$db_fail = true;
} else {
	$pro_constructor_sectors = get_pro_sectors();
	$other_sectors = get_other_sectors();
	$transfer_list_array = get_transfer_list($filters_array);
	if (!$transfer_list_array)
		$error_log = read_log();
}

// pagination
if (!isset ($_GET['page']) ) {  
	$page = 1;  
} else {  
	$page = $_GET['page'];  
}
$results_per_page = $config['transfer_max_col'];
$page_first_result = ($page-1) * $results_per_page;  


//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img">
	<div class="container">
		<h1 class="subhead-heading">양도양수 리스트</h1>
		<p class="subhead-subheading">양도양수 안내 페이지입니다.</p>
	</div>
</header>

<?php if ($for_test && $error_log) : ?>
	<section>
		<div class="container">
			<h3>Error LOG</h3>
			<p><?php echo $error_log; ?></p>
		</div>
	</section>
<?php endif; ?>

<script language="JavaScript">
function constructor_check(checkAll)  {
<?php for($i=0;$i<count($config['constructor_type_filter']);$i++):?>
	document.getElementById('constructor_<?=$i?>').checked = checkAll.checked;
<?php endfor;?>
}

function new_constructor_check(checkAll)  {
<?php for($i=0;$i<count($config['new_constructor_type_filter']);$i++):?>
	document.getElementById('new_constructor_<?=$i?>').checked = checkAll.checked;
<?php endfor;?>
}

function pro_constructor_check(checkAll)  {
<?php for($i=0;$i<count($pro_constructor_sectors);$i++):?>
	document.getElementById('pro_constructor_<?=$i?>').checked = checkAll.checked;
<?php endfor;?>
}

function other_constructor_check(checkAll)  {
<?php for($i=0;$i<count($other_sectors);$i++):?>
	document.getElementById('other_constructor_<?=$i?>').checked = checkAll.checked;
<?php endfor;?>
}
</script>

<?php if($db_fail):?>
<section class="page-section">
	<div class="container text-center">
		<h3>죄송합니다. 오류가 발생하였습니다. 잠시 후 이용해 주세요.</h3>
	</div>
</section>

<?php else:?>
<section class="page-section pb-4 pt-5">
	<div class="container">
		<?php if($for_test) print_r($filters_array);?>
		<form action="<?= $thispage_filename ?>" method="post">
			<?php $sector_no = 0;?>
			<div class="row border">
				<div class="col-3 col-md-2 p-3 border-end bg-dark-subtle">종합건설</div>
				<div class="col-9 col-md-10 p-3 select-table">
					<div class="row d-flex gx-3 justify-content-start">
					<?php $idname = "constructor_";?> 
						<div class="col col-6 col-md-4 col-lg-2 form-check">
							<input type="checkbox" class="form-check-input" name="<?=$idname?>checllAll" id="<?=$idname?>checkAll" onclick='<?=$idname?>check(this)'>
							<label class="form-check-label text-primary" for="<?=$idname?>checllAll">모두 선택</label>
						</div>
					<?php $checki = 0; foreach($config['constructor_type_filter'] as $efilter_check):?>
						<div class="col col-6 col-md-4 col-lg-2 form-check">
							<input type="checkbox" class="form-check-input" name="checked_sectors[<?=$sector_no?>]]" id="<?=$idname.$checki?>" value="<?=$efilter_check?>" <?php if(isset($pre_checked_sectors[$sector_no])) echo "checked";?>>
							<label class="form-check-label" for="<?=$idname.$checki?>"><?=$efilter_check?></label>
						</div>
					<?php $checki++; $sector_no++; endforeach;?>
					</div>
				</div>
			</div>
			<div class="row border border-top-0">
				<div class="col-3 col-md-2 p-3 border-end bg-dark-subtle">신규건설</div>
				<div class="col-9 col-md-10 p-3 select-table">
					<div class="row d-flex gx-3 justify-content-start">
					<?php $idname = "new_constructor_";?> 
						<div class="col col-6 col-md-4 col-lg-2 form-check">
							<input type="checkbox" class="form-check-input" name="<?=$idname?>checllAll" id="<?=$idname?>checkAll" onclick='<?=$idname?>check(this)'>
							<label class="form-check-label text-primary" for="<?=$idname?>checllAll">모두 선택</label>
						</div>
					<?php $checki = 0; foreach($config['new_constructor_type_filter'] as $efilter_check):?>
						<div class="col col-6 col-md-4 col-lg-2 form-check">
							<input type="checkbox" class="form-check-input" name="checked_new_sectors[<?=$sector_no?>]]" id="<?=$idname.$checki?>" value="<?=$efilter_check?>" <?php if(isset($pre_checked_new_sectors[$sector_no])) echo "checked";?>>
							<label class="form-check-label" for="<?=$idname.$checki?>">신규면허-<?=$efilter_check?></label>
						</div>
					<?php $checki++; $sector_no++; endforeach;?>
					</div>
				</div>
			</div>
			<div class="row border border-top-0">
				<div class="col-3 col-md-2 p-3 border-end bg-dark-subtle">전문건설</div>
				<div class="col-9 col-md-10 p-3 select-table">
					<div class="row d-flex gx-3 justify-content-start">
					<?php $idname = "pro_constructor_";?> 
						<div class="col-12 form-check">
							<input type="checkbox" class="form-check-input" name="<?=$idname?>checllAll" id="<?=$idname?>checkAll" onclick='<?=$idname?>check(this)'>
							<label class="form-check-label text-primary" for="<?=$idname?>checllAll">모두 선택</label>
						</div>
					<?php $checki = 0; $keyi = 0; foreach($config['pro_constructor_type_filter'] as $efilter_key => $efilter_value):?>
						<div class="row col-lg-6 d-flex flex-row">
							<div class="col-md-6 pe-0 opacity-75"><?=$efilter_key?></div>
							<div class="col-md-6 ps-0 d-flex flex-row">
								(
							<?php foreach($efilter_value as $efilter_check):?>
								<div class="form-check mx-1">
									<input type="checkbox" class="form-check-input" name="checked_sectors[<?=$sector_no?>]]" id="<?=$idname.$checki?>" value="<?=$efilter_check?>" <?php if(isset($pre_checked_sectors[$sector_no])) echo "checked";?>>
									<label class="form-check-label" for="<?=$idname.$checki?>"><?=$efilter_check?></label>
								</div>
							<?php $checki++; $sector_no++; endforeach;?>
								)
							</div>
						</div>
					<?php $keyi++; endforeach;?>
					</div>
				</div>
			</div>
			<div class="row border border-top-0">
				<div class="col-3 col-md-2 p-3 border-end bg-dark-subtle">기타 공사업</div>
				<div class="col-9 col-md-10 p-3 select-table">
					<div class="row d-flex gx-3 justify-content-start">
					<?php $idname = "other_constructor_";?> 
						<div class="col col-6 col-md-4 col-lg-2 form-check">
							<input type="checkbox" class="form-check-input" name="<?=$idname?>checllAll" id="<?=$idname?>checkAll" onclick='<?=$idname?>check(this)'>
							<label class="form-check-label text-primary" for="<?=$idname?>checllAll">모두 선택</label>
						</div>
					<?php $checki = 0; foreach($other_sectors as $efilter_check):?>
						<div class="col col-6 col-md-4 col-lg-2 form-check">
							<input type="checkbox" class="form-check-input" name="checked_sectors[<?=$sector_no?>]]" id="<?=$idname.$checki?>" value="<?=$efilter_check?>" <?php if(isset($pre_checked_sectors[$sector_no])) echo "checked";?>>
							<label class="form-check-label" for="<?=$idname.$checki?>"><?=$efilter_check?></label>
						</div>
					<?php $checki++; $sector_no++; endforeach;?>
					</div>
				</div>
			</div>
			<div class="row mt-3 d-flex align-items-center justify-content-end">
				<div class="col col-md-4 col-lg-3 form-check">
					<input class="form-check-input" type="radio" name="searchType" id="searchType1" value="sector" <?php if($pre_searchType == "sector") echo "checked";?>>
					<label class="form-check-label" for="searchType1">선택한 업종 검색</label>
				</div>
				<div class="col col-md-auto form-check">
					<input class="form-check-input" type="radio" name="searchType" id="searchType2" value="reg_number" <?php if($pre_searchType == "reg_number") echo "checked";?>>
					<label class="form-check-label" for="searchType2">등록 번호로 검색</label>
				</div>
				<div class="col-3 col-lg-2">
					<input type="text" class="form-control" name="reg_number" id="reg_number" aria-describedby="등록번호" value="<?php if(isset($pre_reg_number)) echo $pre_reg_number;?>">
				</div>
				<div class="col-3 col-lg-2 p-3"><button type="submit" class="btn btn-primary">검색</button></div>
				<?php if($filters_array['need_filter']):?>
				<div class="col-3 col-lg-2 p-3"><a class="btn btn-secondary" role="button" href="<?=$thispage_filename?>">검색 초기화</a></div>
				<?php endif;?>
			</div>
		</form>
	</div>
</section>



<!-- List table Section-->
<section class="page-section pt-4" id="listtable">
	<div class="container overflow-auto">
		<table class="table table-hover table-bordered align-middle text-center">
			<thead class="table-light">
				<tr class="align-middle text-center">
					<th scope="col" rowspan="2">등록 NO</th>
					<th scope="col" rowspan="2">상태</th>
					<th scope="col" rowspan="2">업종</th>
					<th scope="col" rowspan="2">법인년도</th>
					<th scope="col" rowspan="2">면허년도</th>
					<th scope="col" rowspan="2">자본금</th>
					<th scope="col" colspan="2">실적</th>
					<th scope="col" rowspan="2">시공능력</th>
					<th scope="col" rowspan="2">양도가</th>
					<th scope="col" rowspan="2">수정일</th>
				</tr>
				<tr class="align-middle text-center">
					<th scope="col">3년실적</th>
					<th scope="col">5년실적</th>
				</tr>
			</thead>
			<tbody>
				<?php $sn = 0;
				foreach ($transfer_list_array as $eachtransfer) : ?>
					<tr onClick="location.href='transfer_edit.php'" style="cursor:pointer;" data-bs-container="body" data-bs-toggle="popover" data-bs-custom-class="custom-popover" data-bs-trigger="hover focus" data-bs-html="true" data-bs-content="<?= $eachtransfer['note'] ?>" data-bs-placement="<?php if ($sn < 1) echo "bottom"; else echo "top"; ?>">
						<td><?= $eachtransfer['reg_number'] ?>
							<?php
							if ($eachtransfer['sales_five_ar'] == "") echo "<br><span class=\"text-primary\">신규</span>";
							if ($eachtransfer['tag']) {
								if ($eachtransfer['tag'] == "추천") {
									echo "<br><span class=\"badge bg-info\">" . $eachtransfer['tag'] . "</span>";
								} else if ($eachtransfer['tag'] == "인기") {
									echo "<br><span class=\"badge bg-warning\">" . $eachtransfer['tag'] . "</span>";
								} else if ($eachtransfer['tag'] == "긴급") {
									echo "<br><span class=\"badge bg-danger\">" . $eachtransfer['tag'] . "</span>";
								}
							}
							?>
						</td>
						<td><?php if ($eachtransfer['status']) echo "계약가능";
							else echo "계약불능"; ?>
						</td>
						<td class="text-success">
							<?php $sector_array = explode("|", $eachtransfer['sector_ar']);
							$numberofar = count($sector_array);
							for ($i = 0; $i < $numberofar; $i++) {
								echo $sector_array[$i];
								if ($i < $numberofar - 1)
									echo "<br>";
							}
							?>
						</td>
						<td><?= $eachtransfer['year_founded'] ?></td>
						<td>
							<?php $licensed_array = explode("|", $eachtransfer['licensed_ar']);
							$numberofar = count($licensed_array);
							for ($i = 0; $i < $numberofar; $i++) {
								echo $licensed_array[$i];
								if ($i < $numberofar - 1)
									echo "<br>";
							}
							?>
						</td>
						<td><?php echo print_money($eachtransfer['capital']); ?></td>
						<td class="text-info">
							<?php
							if ($eachtransfer['sales_three_ar'] != "") {
								$sales_three_array = explode("|", $eachtransfer['sales_three_ar']);
								$numberofar = count($sales_three_array);
								for ($i = 0; $i < $numberofar; $i++) {
									echo print_money(intval($sales_three_array[$i]));
									if ($i < $numberofar - 1)
										echo "<br>";
								}
							}
							?>
						</td>
						<td class="text-info">
							<?php
							if ($eachtransfer['sales_five_ar'] != "") {
								$sales_five_array = explode("|", $eachtransfer['sales_five_ar']);
								$numberofar = count($sales_five_array);
								for ($i = 0; $i < $numberofar; $i++) {
									echo print_money(intval($sales_five_array[$i]));
									if ($i < $numberofar - 1)
										echo "<br>";
								}
							}
							?>
						</td>
						<td>
							<?php
							if ($eachtransfer['ablility_ar'] != "") {
								$ablility_array = explode("|", $eachtransfer['ablility_ar']);
								$numberofar = count($ablility_array);
								for ($i = 0; $i < $numberofar; $i++) {
									echo print_money(intval($ablility_array[$i]));
									if ($i < $numberofar - 1)
										echo "<br>";
								}
							}
							?>
						</td>
						<td class="text-danger"><?php echo print_money($eachtransfer['transfer_price']); ?></td>
						<td><?php echo date("Y-m-d", strtotime($eachtransfer['modfied_date'])); ?></td>
					</tr>
				<?php $sn++;
				endforeach; ?>
			</tbody>
		</table>
		
		<!-- Pagination -->
		<?php 

		?>
		<?php if (count($transfer_list_array) > $config['transfer_max_col']): ?>
		<nav aria-label="Page navigation">
			<ul class="pagination justify-content-center">
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
				</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
				</a>
				</li>
			</ul>
		</nav>
		<?php endif;?>

	</div>
</section>
<?php endif;?>

<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>

<!-- Enable Popover -->
<script>
	document.querySelectorAll('[data-bs-toggle="popover"]')
		.forEach(popover => {
			new bootstrap.Popover(popover)
		})
</script>