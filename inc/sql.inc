<?php

/* 
MYSQL 설명

MYSQL 내장 함수
https://www.skyer9.pe.kr/wordpress/?p=4988

MYSQL 함수 만들기
https://techblog-history-younghunjo1.tistory.com/149

*/

$need_logging = true;

$dbserver = $config['home_url'];
$dbuser = $config['db_user'];
$dbpassword = $config['db_password'];
$dbname = $config['db_name'];
$charset = ";charset=utf8";

// Check if it is available to connect to mysql db server.
function check_connect_dbserver()
{
	global $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$error_message = false;
	$retmsg = false;
	$dsn = "mysql:host={$dbserver};port=3306";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 5));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: check_connect_dbserver(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retmsg = true;
	return $retmsg;
}

// Check if it is available to connect to mysql db server and database.
function check_connect_db()
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$error_message = false;
	$retmsg = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 5));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: check_connect_db(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retmsg = true;
	return $retmsg;
}

function connect_db()
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$error_message = false;
	$retmsg = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 5));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: connect_db(), " . $error_message);
	}
	if (!$error_message)
		$retmsg = $pdo;
	else
		$pdo = null;
	return $retmsg;
}
//connect_db() 사용 예
/*
$pdo = connect_db();
$sql = "select * from userinfo where username = 'gipany001'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$result[] = $row;
}
print_r($result);
*/

function check_db_exist($dbname)
{
	global $charset, $dbserver, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$dsn = "mysql:host={$dbserver};port=3306";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 5));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":dbname", $dbname);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if ($result > 0)
			$retval = true;
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: " . $error_message);
	}
	$pdo = null;
	if (!$error_message) {
		$retval = true;
	}
	return $retval;
}

function drop_table($table_name)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$drop_qly = "DROP TABLE if exists " . $table_name;
		$stmt = $pdo->prepare($drop_qly);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: remove_tables(" . $table_name . "), " . $error_message);
	}
	$pdo = null;
	if (!$error_message) {
		$retval = true;
	}
	return $retval;
}

function create_tables($test = false)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	// drop the existed tales to make test environments
	if ($test) {
		$tables = array("transfer", "performance");
		foreach ($tables as $table_name) {
			if (!drop_table($table_name))
				return $retval;
		}
	}

	$qly_transfer = "
CREATE TABLE transfer (
sn int(16) NOT NULL auto_increment,
reg_number int(16) NOT NULL,
company_name varchar(32) NULL,
company_type varchar(16) NULL,
year_founded year,
year_corporation year,
capital int(12),
deposit_bill int(12),
remaining_amount int(12),
join_association tinyint(1),
region varchar(16) NULL,
construction_in_progress tinyint(1),
transfer_price int(16),
status tinyint(1),
consultant varchar(16) NULL,
phone varchar(16) NULL,
mobile varchar(16) NULL,
tag varchar(16) NULL,
note varchar(500) NULL,
created_date datetime,
modfied_date datetime,
PRIMARY KEY (sn),
KEY (reg_number)
)";

	$qly_performance = "
CREATE TABLE performance (
sn int(16) unsigned NOT NULL auto_increment,
reg_number int(16) NOT NULL,
sector varchar(32) NOT NULL,
year_licensed year,
construction_ability int(12),
annual_sales int(12),
year year,
created_date datetime,
modfied_date datetime,
PRIMARY KEY (sn),
KEY (reg_number)
)";

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $pdo->prepare($qly_transfer);
		$stmt->execute();
		$stmt = $pdo->prepare($qly_performance);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: create_tables(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message) {
		$retval = true;
		//create_stored_procedures();
	}
	return $retval;
}

function create_my_function()
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	//qly_getSectors
	$qly_getSectors1 = "DROP FUNCTION IF EXISTS getSectors";
	$qly_getSectors2 = "
CREATE FUNCTION getSectors(
	InputRegnum INT
) RETURNS VARCHAR(32)
BEGIN
	RETURN (SELECT GROUP_CONCAT(DISTINCT sector SEPARATOR '|') FROM performance WHERE reg_number = InputRegnum);
END
";

	//qly_getLicensedYears
	$qly_getLicensedYears1 = "DROP FUNCTION IF EXISTS getLicensedYears";
	$qly_getLicensedYears2 = "
CREATE FUNCTION getLicensedYears(
	InputRegnum INT
) RETURNS VARCHAR(32)
BEGIN
	RETURN (SELECT GROUP_CONCAT(DISTINCT year_licensed SEPARATOR '|') FROM performance WHERE reg_number = InputRegnum);
END
";

	//qly_getLicensedYears
	$qly_getAbility1 = "DROP FUNCTION IF EXISTS getAbility";
	$qly_getAbility2 = "
CREATE FUNCTION getAbility(
	InputRegnum INT
) RETURNS VARCHAR(32)
BEGIN
	RETURN (SELECT GROUP_CONCAT(DISTINCT construction_ability SEPARATOR '|') FROM performance WHERE reg_number = InputRegnum);
END
";

	//qly_getPerformances
	$qly_getPerformanceSum1 = "DROP FUNCTION IF EXISTS getPerformanceSum";
	$qly_getPerformanceSum2 = "
CREATE FUNCTION getPerformanceSum(
	InputRegnum INT,
	InputSector VARCHAR(16),
	InputDuring INT,
	StandardYear INT
) RETURNS INT
BEGIN
	DECLARE salebyYear INT;
	DECLARE saleSum INT;
	DECLARE i INT;
	DECLARE byYear INT;
	SET SaleSum = 0;
	SET i = 0;
	SET byYear = StandardYear;
	WHILE (i < InputDuring) DO
		SELECT annual_sales INTO SalebyYear FROM performance WHERE reg_number = InputRegnum AND sector = InputSector AND year = byYear;
		SET SaleSum = SaleSum + SalebyYear;
		SET byYear = byYear - 1;
		SET i = i + 1;
	END WHILE;
	RETURN SaleSum;
END
";

	//qly_getPerformances
	$qly_getPerformanceConcat1 = "DROP FUNCTION IF EXISTS getPerformanceConcat";
	$qly_getPerformanceConcat2 = "
CREATE FUNCTION getPerformanceConcat(
	InputRegnum INT,
	InputDuring INT,
	StandardYear INT
) RETURNS VARCHAR(32)
BEGIN
	RETURN (SELECT GROUP_CONCAT(DISTINCT getPerformanceSum(InputRegnum, sector, InputDuring, StandardYear) SEPARATOR '|') FROM performance WHERE reg_number = InputRegnum);
END
";

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword);
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$pdo->exec($qly_getSectors1);
		$pdo->exec($qly_getSectors2);

		$pdo->exec($qly_getLicensedYears1);
		$pdo->exec($qly_getLicensedYears2);

		$pdo->exec($qly_getAbility1);
		$pdo->exec($qly_getAbility2);

		$pdo->exec($qly_getPerformanceSum1);
		$pdo->exec($qly_getPerformanceSum2);

		$pdo->exec($qly_getPerformanceConcat1);
		$pdo->exec($qly_getPerformanceConcat2);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: create_my_function(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;
	return $retval;
}


function add_transfer_list($reg_number, $company_name, $company_type, $year_founded, $year_corporation, $capital, $deposit_bill, $remaining_amount, $join_association, $region, $construction_in_progress, $transfer_price, $status, $consultant, $phone, $mobile, $tag, $note)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO transfer VALUES (0
,'" . $reg_number . "'
,'" . $company_name . "'
,'" . $company_type . "'
,'" . $year_founded . "'
,'" . $year_corporation . "'
,'" . $capital . "'
,'" . $deposit_bill . "'
,'" . $remaining_amount . "'
,'" . $join_association . "'
,'" . $region . "'
,'" . $construction_in_progress . "'
,'" . $transfer_price . "'
,'" . $status . "'
,'" . $consultant . "'
,'" . $phone . "'
,'" . $mobile . "'
,'" . $tag . "'
,'" . $note . "'
,now()
,now()
)";
		//write_log("sql.inc: add_transfer_list(), ".$sql);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: add_transfer_list(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function add_performance_list($reg_number, $sector, $year_licensed, $construction_ability, $annual_sales, $year)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO performance VALUES (0
,'" . $reg_number . "'
,'" . $sector . "'
,'" . $year_licensed . "'
,'" . $construction_ability . "'
,'" . $annual_sales . "'
,'" . $year . "'
,now()
,now()
)";
		//write_log("sql.inc: add_performance_list() , query:".$sql);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: add_performance_list(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function make_test_environments()
{
	$retval = false;
	if (check_connect_dbserver()) {
		if (create_tables(true)) {
			create_my_function();
			$transfer_testlist_array = array(
				array("10001", "을지건설", "주식회사", "2005", "2006", "560", "15", "150", "1", "수도권", "1", "450", "1", "홍길동", "02-1234-1234", "010-1234-1234", "추천", "21년 자체 결산<br>공제조합 미대출<br>기술자 5인 승계가능"),
				array("10002", "건실건설", "유한회사", "2003", "2004", "700", "94", "450", "1", "지방", "0", "650", "1", "홍길동", "02-4321-1234", "010-4321-1234", "긴급", "매년 년말 현금 및 자체결산<br>22년 년말 양도사 현금 및 자체결산(23년 2월 초 잔금 가능)<br>공제조합 미대출 잔액 포함(약 1.43억)<br>기술인력 일부 승계가능(별도 협의)"),
				array("10003", "신규건설", "유한회사", "2021", "2021", "4500", "75", "", "1", "지방", "0", "650", "1", "홍길동", "02-4321-1234", "010-4321-1234", "추천", "9월 법인, 10월 면허<br>공제조합 출자금 포함<br>양도가 협의 가능 (저렴)<br>기술자 미포함(전원 포함도 가능함)<br>8월 결산법인"),
				array("10004", "모름건설", "유한회사", "2021", "2022", "4900", "88", "", "1", "지방", "0", "650", "1", "홍길동", "02-4321-1234", "010-4321-1234", "인기", "전문 88좌, 약 0.35억<br>설비 48좌, 약 0.2억<br>매년 연말 현금 및 자체결산<br>21년 기준 미처분 이익잉여금 약 1.4억<br>부채 2프로, 유동 3,313프로")
			);
			$performance_testlist_array = array(

				array("10001", "건축", "2006", "4500", "456", "2022"),
				array("10001", "건축", "2006", "4500", "300", "2021"),
				array("10001", "건축", "2006", "4500", "250", "2020"),
				array("10001", "건축", "2006", "4500", "200", "2019"),
				array("10001", "건축", "2006", "4500", "150", "2018"),
				array("10001", "건축", "2006", "4500", "200", "2017"),

				array("10001", "토목", "2007", "6500", "256", "2022"),
				array("10001", "토목", "2007", "6500", "300", "2021"),
				array("10001", "토목", "2007", "6500", "400", "2020"),
				array("10001", "토목", "2007", "6500", "110", "2019"),
				array("10001", "토목", "2007", "6500", "300", "2018"),
				array("10001", "토목", "2007", "6500", "240", "2017"),
				array("10001", "토목", "2007", "6500", "190", "2016"),

				array("10002", "건축", "2008", "5500", "400", "2022"),
				array("10002", "건축", "2008", "5500", "300", "2021"),
				array("10002", "건축", "2008", "5500", "300", "2020"),
				array("10002", "건축", "2008", "5500", "200", "2019"),

				array("10003", "건축", "2008", "5500", "", ""),

				array("10004", "모름", "2008", "5500", "150", "2021"),

			);

			$add_error = false;
			foreach ($transfer_testlist_array as $elist) {
				$transfer_result = add_transfer_list($elist[0], $elist[1], $elist[2], $elist[3], $elist[4], $elist[5], $elist[6], $elist[7], $elist[8], $elist[9], $elist[10], $elist[11], $elist[12], $elist[13], $elist[14], $elist[15], $elist[16], $elist[17]);
				if (!$transfer_result) {
					$add_error = true;
					break;
				}
			}
			if (!$add_error) {
				foreach ($performance_testlist_array as $elist) {
					$performance_result = add_performance_list($elist[0], $elist[1], $elist[2], $elist[3], $elist[4], $elist[5]);
					if (!$performance_result) {
						$add_error = true;
						break;
					}
				}
			}
			if (!$add_error)
				$retval = true;
		}
	}
	return $retval;
}

function get_transfer_list($filters_array)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $performance_from_year, $need_logging, $config;
	$retval = false;
	$error_message = false;
	/* 
	[필터링 할 것 들]
	업종: sector from performance table
	신규면허(건축, 토목, 전문 만 해당): 해당 업종의 모든 performance가 0 도는 null from performance table
	업종 포함 또는 해당 업종만
	$fiters_array = (
		'need_filter' => true or false, // 필터가 필요하지 않는 경우 모두로 처리
		'reg_number' => false or reg_number,
		'sectors' => array("업종a", "업종b"),
		'new_licensed' => true or false,
		'offset' => number, // page 시작점
		'includeOronly' =>  true or false // 이거는 필요 없을 듯
	)
	*/

	if (!is_array($filters_array)) {
		if ($need_logging)
			write_log("sql.inc: get_transfer_list(), Need array filter.");
		return $retval;
	} else {
		$offset = $filters_array['offset'];
		$limit = $config['transfer_max_col'];

		if (!$filters_array['need_filter']) { // 필터링 없이 모두
			$sql = "SELECT *, getSectors(reg_number) as sector_ar, getLicensedYears(reg_number) as licensed_ar, getPerformanceConcat(reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(reg_number) as ablility_ar FROM transfer GROUP BY reg_number ORDER BY reg_number DESC";
			if ($need_logging)
				write_log("query: " . $sql);
		} else if (isset($filters_array['reg_number']) && $filters_array['reg_number']) { // reg_number 필터링
			$sql = "SELECT *, getSectors(reg_number) as sector_ar, getLicensedYears(reg_number) as licensed_ar, getPerformanceConcat(reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(reg_number) as ablility_ar FROM transfer WHERE reg_number = '{$filters_array['reg_number']}' GROUP BY reg_number ORDER BY reg_number DESC";
			if ($need_logging)
				write_log("query: " . $sql);
		} else if (is_array($filters_array['sectors']) && count($filters_array['sectors']) > 0) { // Sector 필터링
			$sql_filter = "AND (";
			for ($i = 0; $i < count($filters_array['sectors']); $i++) {
				$sql_filter .= "t2.sector = '" . $filters_array['sectors'][$i] . "'";
				if ($i < (count($filters_array['sectors']) - 1)) {
					$sql_filter .= " OR ";
				}
			}
			$sql_filter .= ")";
			if ($filters_array['new_licensed']) {  // 신규만 검색하는 경우 (신규는 5년간 실적이 없는 경우)
				$sql = "SELECT t1.*, getSectors(t1.reg_number) as sector_ar, getLicensedYears(t1.reg_number) as licensed_ar, getPerformanceConcat(t1.reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(t1.reg_number) as ablility_ar FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) AND getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) IS NULL GROUP BY t1.reg_number ORDER BY t1.reg_number DESC";
				// sector를 제외한 다른 것들은 모두 t1 으로 해야한다. 
				if ($need_logging)
					write_log("query: " . $sql);
			} else { // 신규와 실적이 있는 것 모두
				$sql = "SELECT t1.*, getSectors(t1.reg_number) as sector_ar, getLicensedYears(t1.reg_number) as licensed_ar, getPerformanceConcat(t1.reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(t1.reg_number) as ablility_ar FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) GROUP BY t1.reg_number ORDER BY t1.reg_number DESC";
				// sector를 제외한 다른 것들은 모두 t1 으로 해야한다. 
	
				/* 
				AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) 이거는 빼도 되지않을까? 
				쿼리 처리에 약간의 부하를 더 주겠지만.
				이것이 실수로 performance에는 입력이되지않은 업체는 보이지 않게해 오류를 줄여줄 수 있을 듯하다. 
				아래 쿼리는 삭제한 경우의 예
				*/
				//$sql = "SELECT t1.*, getSectors(t1.reg_number) as sector_ar, getLicensedYears(t1.reg_number) as licensed_ar, getPerformanceConcat(t1.reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(t1.reg_number) as ablility_ar FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} GROUP BY t1.reg_number ORDER BY t1.reg_number";
				if ($need_logging)
					write_log("query: " . $sql);
			}
		} else { // sector 가 array이 오지 않는 경우 오류 로그와 return false
			if ($need_logging)
				write_log("sql.inc: get_transfer_list(), Need array filter.");
			return $retval;
		}
	}

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_transfer_list(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $result_list;

	return $retval;
}

function count_transfer_list($filters_array)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $performance_from_year, $need_logging;
	$retval = false;
	$error_message = false;
	if (!is_array($filters_array) || !$filters_array['need_filter']) { // 필터링 없이 모두
		$sql = "SELECT count(sn) FROM transfer";
		if ($need_logging)
			write_log("query: " . $sql);
	} else if (is_array($filters_array['sectors']) && count($filters_array['sectors']) > 0) { // 필터링 필요
		$sql_filter = "AND (";
		for ($i = 0; $i < count($filters_array['sectors']); $i++) {
			$sql_filter .= "t2.sector = '" . $filters_array['sectors'][$i] . "'";
			if ($i < (count($filters_array['sectors']) - 1)) {
				$sql_filter .= " OR ";
			}
		}
		$sql_filter .= ")";
		if ($filters_array['new_licensed']) {  // 신규만 검색하는 경우 (신규는 5년간 실적이 없는 경우)
			$sql = "SELECT COUNT(DISTINCT t1.sn) FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) AND getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) IS NULL";
			if ($need_logging)
				write_log("query: " . $sql);
		} else { // 신규와 실적이 있는 것 모두
			$sql = "SELECT COUNT(DISTINCT t1.sn) FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance)";
			if ($need_logging)
				write_log("query: " . $sql);
		}
	} else { // sector 가 array이 오지 않는 경우 오류 로그와 return false
		if ($need_logging)
			write_log("sql.inc: get_transfer_list(), Need array filter.");
		return $retval;
	}
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_transfer_list(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $result;

	return $retval;
}


function get_transfer_info($reg_number = "")
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: get_transfer_info({$reg_number}), Need reg_number");
		return $retval;
	}

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM transfer WHERE reg_number = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($reg_number));
		$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_transfer_info({$reg_number}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $userinfo;

	return $retval;
}

function get_performance_info($reg_number = "")
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $performance_from_year, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: get_performance_info({$reg_number}), Need reg_number");
		return $retval;
	}

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM performance WHERE reg_number = ? AND (year > {$performance_from_year} - 5 AND year <= {$performance_from_year})";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($reg_number));
		$userinfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_performance_info({$reg_number}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $userinfo;

	return $retval;
}

function modify_transfer_info($modify_info_array = array())
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	/*
	$modify_info_array = (
	'reg_number' => $reg_number,
	'company_name' => $company_name,
	'company_type' => $company_type,
	'year_founded' => $year_founded,
	'year_corporation' => $year_corporation,
	'capital' => $capital,
	'deposit_bill' => $deposit_bill,
	'remaining_amount' => $remaining_amount,
	'join_association' => $join_association,
	'region' => $region,
	'construction_in_progress' => $construction_in_progress,
	'transfer_price' => $transfer_price,
	'status' => $status,
	'consultant' => $consultant,
	'phone' => $phone,
	'mobile' => $mobile,
	'tag' => $tag,
	'note' => $note
	)
	*/
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE transfer SET
company_name = '" . $modify_info_array['company_name'] . "',
company_type = '" . $modify_info_array['company_type'] . "',
year_founded = '" . $modify_info_array['year_founded'] . "',
year_corporation = '" . $modify_info_array['year_corporation'] . "',
capital = '" . $modify_info_array['capital'] . "',
deposit_bill = '" . $modify_info_array['deposit_bill'] . "',
remaining_amount = '" . $modify_info_array['remaining_amount'] . "',
join_association = '" . $modify_info_array['join_association'] . "',
region = '" . $modify_info_array['region'] . "',
construction_in_progress = '" . $modify_info_array['construction_in_progress'] . "',
transfer_price = '" . $modify_info_array['transfer_price'] . "',
status = '" . $modify_info_array['status'] . "',
consultant = '" . $modify_info_array['consultant'] . "',
phone = '" . $modify_info_array['phone'] . "',
mobile = '" . $modify_info_array['mobile'] . "',
tag = '" . $modify_info_array['tag'] . "',
note = '" . $modify_info_array['note'] . "',
modfied_date = now()
WHERE reg_number = '" . $modify_info_array['reg_number'] . "'";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: modify_transfer_info(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function modify_performance_info($modify_info_array = array())
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	/*
	$modify_info_array = (
	'sn' => $sn,
	'reg_number' => $reg_number,
	'sector' => $sector,
	'year_licensed' => $year_licensed,
	'construction_ability' => $construction_ability,
	'annual_sales' => $annual_sales,
	'year' => $year
	)
	*/
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE performance SET
sector = '" . $modify_info_array['sector'] . "',
year_licensed = '" . $modify_info_array['year_licensed'] . "',
construction_ability = '" . $modify_info_array['construction_ability'] . "',
annual_sales = '" . $modify_info_array['annual_sales'] . "',
year = '" . $modify_info_array['year'] . "',
modfied_date = now()
WHERE sn = '" . $modify_info_array['sn'] . "' AND reg_number = '" . $modify_info_array['reg_number'] . "'";

		//write_log("sql.inc: add_performance_list() , query:".$sql);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: add_performance_list(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function get_pro_sectors() {
	global $config;
	$pro_constructor = array();
	foreach($config['pro_constructor_type_filter'] as $key => $values) {
		foreach($values as $esector) {
			$pro_constructor[] = $esector;
		}
	}
	return $pro_constructor;
}

// config에 기제된 업종 이외의 업종 리스트 가져오기 
function get_other_sectors() {
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $config;
	$retval = false;
	$error_message = false;
	$pro_constructor = get_pro_sectors();
	$all_sectors = array_merge($config['constructor_type_filter'], $config['new_constructor_type_filter'], $pro_constructor);
	$all_unique_sectors = array_unique($all_sectors);
	$exits_sectors = "(";
	for ($i = 0; $i < count($all_unique_sectors); $i++) {
		if (isset($all_unique_sectors[$i])) {
			$exits_sectors .= "'" . $all_unique_sectors[$i] . "'";
			if ($i < (count($all_unique_sectors) - 1)) {
				$exits_sectors .= ", ";
			}
		}
	}
	$exits_sectors .= ")";

	$sql = "SELECT sector FROM performance WHERE sector NOT IN ".$exits_sectors;
	if ($need_logging)
	write_log("sql: " . $sql);

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$other_sectors = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_other_sectors(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $other_sectors;

	return $retval;
}

?>
<!-- sql functions loaded -->