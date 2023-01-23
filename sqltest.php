<?php

// 모든 파일의 상단에 반드시 포함해야 할 사향:: 시작
include("inc/config.inc"); // 가장 먼전 include 해야 설정을 문제 없이 가져옵니다.
include("inc/text.inc");
//필요시 아래 두개 function 파일은 여기에 include합니다. 순서를 지켜야합니다. 
include("inc/utils.inc"); //그외 functions 
include("inc/sql.inc"); //mysql 관련 functions

$error_log = false;
if (!check_connect_dbserver()) {
	$error_log = read_log();
} else {
	//create_my_function();
	//make_test_environments();

	//$en_result = make_test_environments();
	/* 
	$fiters_array = (
		'need_filter' => true or false, // 필터가 필요하지 않는 경우 모두로 처리
		'sectors' => array("업종a", "업종b"),
		'new_licensed' => true or false,
		'includeOronly' =>  true or false // 이거는 필요 없을 듯
	)
	$filters_array = array('need_filter' => true, 'sectors' => array("토목","조경"), 'new_licensed' => false);
	$result_array = get_transfer_list($filters_array);
	 */
	//$filters_array = array('need_filter' => false, 'sectors' => array("토목","건축"), 'new_licensed' => false, 'offset' => 1);
	//$reg_number = "10001";
	$no_col = count_transfer_list($filters_array);
	//$result_array = get_transfer_list($filters_array);
	//$error_log = read_log();
	add_user_info("uoneinfo", "u8rt*gn30", "admin");

}

//head와 로고, navbar는 아래 파일에서 수정하세요.
include("header.inc");
// 모든 파일의 상단에 반드시 포함해야 할 사향:: 끝
?>

<!-- Masthead-->
<header class="subhead text-center transfer-bg-img">
	<div class="container">
		<h1 class="subhead-heading">SQL Test</h1>
		<p class="subhead-subheading">SQL Test Page</p>
	</div>
</header>

<?php if ($error_log) : ?>
	<section>
		<div class="container">
			<p><?php print_r($result_array); ?></p>
			<p><?php echo $error_log; ?></p>
		</div>
	</section>
<?php endif; ?>

<!-- Portfolio Section-->
<section class="page-section portfolio" id="portfolio">
	<div class="container">
		<h1>Total: <?=$no_col?> (homeip: <?=$homeip?>)</h1>
		<?php
		if (is_array($result_array) && count($result_array) > 0) {
			foreach ($result_array as $eachar) {
				foreach ($eachar as $key => $value) {
					echo $key . "^" . $value . " ";
				}
				echo "<br><br>";
			}
		}
		/*
			if (is_array($result) && count($result) > 0) {
				foreach($result as $key => $value) {
					echo $key."^".$value."<br>";
				}
			}
			*/

		?>
	</div>
</section>


<?php

// 모든 파일의 하단에 반드시 포함해야 할 사향:: 시작
//head와 로고, navbar는 아래 파일에서 수정하세요.
include("footer.inc");
// 모든 파일의 하단에 반드시 포함해야 할 사향:: 끝

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<div>
		<h1>실행 결과</h1>
		<p><?php
			if (is_array($result) && count($result) > 0) {
				foreach ($result as $eachar) {
					foreach ($eachar as $key => $value) {
						echo $key . "^" . $value . " ";
					}
					echo "<br><br>";
				}
			}
			/*
			if (is_array($result) && count($result) > 0) {
				foreach($result as $key => $value) {
					echo $key."^".$value."<br>";
				}
			}
			*/

			?>
		</p>
	</div>
	<div>
		<h1>Error Log</h1>
		<p><?= $error_log ?></p>
	</div>
</body>

</html>