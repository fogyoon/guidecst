<?php

/* 
MYSQL 설명

MYSQL 내장 함수
https://www.skyer9.pe.kr/wordpress/?p=4988

MYSQL 함수 만들기
https://techblog-history-younghunjo1.tistory.com/149

*/

$need_logging = true;

$dbserver = $config['db_server'];
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
		$tables = array("transfer", "performance", "finstatements", "users", "loginlog", "license");
		foreach ($tables as $table_name) {
			if (!drop_table($table_name))
				return $retval;
		}
	}

	$qly_transfer = "
CREATE TABLE transfer (
sn int(16) unsigned NOT NULL auto_increment,
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
homeip varchar(32),
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
homeip varchar(32),
PRIMARY KEY (sn),
KEY (reg_number)
)";

	$qly_finstatements = "
CREATE TABLE finstatements (
sn int(16) unsigned NOT NULL auto_increment,
reg_number int(16) NOT NULL,
debt_ratio int(12),
fixed_debt int(12),
current_ratio int(12),
fixed_assets int(12),
total_capital int(12),
revenue int(12),
operating_profit int(12),
income_after_tax int(12),
debt_equity int(12),
created_date datetime,
modfied_date datetime,
homeip varchar(32),
PRIMARY KEY (sn),
KEY (reg_number)
)";

/*
reg_number 등록번호
debt_ratio 부채비율 %
fixed_debt 고정부채
current_ratio 유동비율 %
fixed_assets 고정자산
total_capital 자본총계
revenue 매출액
operating_profit 영업손익
income_after_tax 법인세차감손익
debt_equity 부채와자본총계
*/

$qly_users = "
CREATE TABLE users (
sn int(16) unsigned NOT NULL auto_increment,
username varchar(32) NOT NULL,
password varchar(200) NOT NULL,
role varchar(32),
created_date datetime,
modfied_date datetime,
homeip varchar(32),
PRIMARY KEY (sn),
KEY (username)
)";

$qly_loginlog = "
CREATE TABLE loginlog (
sn int(32) unsigned NOT NULL auto_increment,
date datetime,
username varchar(32) NOT NULL,
homeip varchar(32),
PRIMARY KEY (sn),
KEY (username)
)";

// license
$qly_license = "
CREATE TABLE license (
sn int(32) unsigned NOT NULL auto_increment,
sector varchar(32),
fund_private int(12),
fund_corporation int(12),
fund_explain text,
cooperative_name varchar(32),
cooperative_private varchar(32),
cooperative_corporation varchar(32),
cooperative_explain text,
detail_head text,
detail text,
example_head text,
example text,
facility text,
ability_head text,
ability text,
technician text,
modfied_date datetime,
homeip varchar(32),
PRIMARY KEY (sn),
KEY (sector)
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
		$stmt = $pdo->prepare($qly_finstatements);
		$stmt->execute();
		$stmt = $pdo->prepare($qly_users);
		$stmt->execute();
		$stmt = $pdo->prepare($qly_loginlog);
		$stmt->execute();
		$stmt = $pdo->prepare($qly_license);
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
	SET SalebyYear = 0;
	SET SaleSum = 0;
	SET i = 0;
	SET byYear = StandardYear;
	WHILE (i < InputDuring) DO
		SELECT annual_sales INTO SalebyYear FROM performance WHERE reg_number = InputRegnum AND sector = InputSector AND year = byYear;
		SET SaleSum = SaleSum + SalebyYear;
		SET byYear = byYear - 1;
		SET i = i + 1;
		SET SalebyYear = 0;
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
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
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
,'" . $homeip . "'
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
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
	$retval = false;
	$error_message = false;
	$annual_sales = !empty($annual_sales) ? "'$annual_sales'" : "NULL";
	$year = !empty($year) ? "'$year'" : "NULL";
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO performance VALUES (0
,'{$reg_number}'
,'{$sector}'
,'{$year_licensed}'
,'{$construction_ability}'
,{$annual_sales}
,{$year}
,now()
,now()
,'{$homeip}'
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

/*
$reg_number, $debt_ratio, $fixed_debt, $current_ratio, $fixed_assets, $total_capital, $revenue, $operating_profit, $income_after_tax, $debt_equity
*/

function add_finstatements($reg_number, $debt_ratio, $fixed_debt, $current_ratio, $fixed_assets, $total_capital, $revenue, $operating_profit, $income_after_tax, $debt_equity)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
	$retval = false;
	$error_message = false;
	$debt_ratio = !empty($debt_ratio) ? "'$debt_ratio'" : "NULL";
	$fixed_debt = !empty($fixed_debt) ? "'$fixed_debt'" : "NULL";
	$current_ratio = !empty($current_ratio) ? "'$current_ratio'" : "NULL";
	$fixed_assets = !empty($fixed_assets) ? "'$fixed_assets'" : "NULL";
	$total_capital = !empty($total_capital) ? "'$total_capital'" : "NULL";
	$revenue = !empty($revenue) ? "'$revenue'" : "NULL";
	$operating_profit = !empty($operating_profit) ? "'$operating_profit'" : "NULL";
	$income_after_tax = !empty($income_after_tax) ? "'$income_after_tax'" : "NULL";
	$debt_equity = !empty($debt_equity) ? "'$debt_equity'" : "NULL";
	$sql = "INSERT INTO finstatements VALUES (0
,{$reg_number}
,{$debt_ratio}
,{$fixed_debt}
,{$current_ratio}
,{$fixed_assets}
,{$total_capital}
,{$revenue}
,{$operating_profit}
,{$income_after_tax}
,{$debt_equity}
,now()
,now()
,'{$homeip}'
)";
	if ($need_logging)
		write_log("sql.inc - add_finstatements() - sql: ".$sql);
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: add_finstatements(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function add_user_info($username, $password, $role = "")
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
	$retval = false;
	$error_message = false;
	if (is_auser_exist($username))
		return $retval;
	$password_encrypted = password_hash($password, PASSWORD_DEFAULT);
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO users VALUES (0
,'" . $username . "'
,'" . $password_encrypted . "'
,'" . $role . "'
,now()
,now()
,'" . $homeip . "'
)";
		//write_log("sql.inc: add_user_info() , query:".$sql);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: add_user_info(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function is_auser_exist($username) {
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT count(username) FROM users WHERE username = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($username));
		$result = $stmt->fetchColumn();
		if ($result > 0)
			$retval = true;
	} catch(PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: is_auser_exist(), " . $error_message);
	}
	$pdo = null;
	return $retval;
}

function is_atransfer_exist($company_name) {  // 같은 이름의 상호가 있는지 확인
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT reg_number FROM transfer WHERE company_name = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($company_name));
		$result = $stmt->fetchColumn();
	} catch(PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: is_auser_exist(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $result;
	return $retval;
}

function add_login_log($username)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
	$retval = false;
	$error_message = false;
	$username = trim($username);
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "INSERT INTO loginlog VALUES (0
,now()
,'" . $username . "'
,'" . $homeip . "'
)";
		write_log("sql.inc: add_user_info() , query:".$sql);
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: add_user_info(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function make_test_environments()
{
	global $need_logging;
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
		} else {
			if ($need_logging)
				write_log("sql.inc: create_tables(), Failed to create tables.");
		}
	} else {
		if ($need_logging)
			write_log("sql.inc: create_tables(), Failed to connect db server.");
	}
	return $retval;
}

function get_transfer_list($filters_array)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $performance_from_year, $need_logging, $config;
	$retval = false;
	$error_message = false;
	$result_list = array();
	/* 
	[필터링 할 것 들]
	업종: sector from performance table
	신규면허(건축, 토목, 전문 만 해당): 해당 업종의 모든 performance가 0 도는 null from performance table
	업종 포함 또는 해당 업종만
	$fiters_array = (
		'need_filter' => true or false, // 필터가 필요하지 않는 경우 모두로 처리
		'searchType' => sector, reg_number or company_name,
		'reg_number' => false or reg_number,
		'company_name' => company_name,
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
			$sql = "SELECT *, getSectors(reg_number) as sector_ar, getLicensedYears(reg_number) as licensed_ar, getPerformanceConcat(reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(reg_number) as ablility_ar FROM transfer GROUP BY reg_number ORDER BY reg_number DESC LIMIT {$offset}, {$limit}";
			if ($need_logging)
				write_log("sql.inc - get_transfer_list() - query: " . $sql);
		} else if ($filters_array['searchType'] == "reg_number" && isset($filters_array['reg_number']) && $filters_array['reg_number']) { // reg_number 필터링
			$sql = "SELECT *, getSectors(reg_number) as sector_ar, getLicensedYears(reg_number) as licensed_ar, getPerformanceConcat(reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(reg_number) as ablility_ar FROM transfer WHERE reg_number = '{$filters_array['reg_number']}' GROUP BY reg_number ORDER BY reg_number DESC LIMIT {$offset}, {$limit}";
			if ($need_logging)
				write_log("sql.inc - get_transfer_list() - query: " . $sql);
		} else if ($filters_array['searchType'] == "company_name" && isset($filters_array['company_name']) && $filters_array['company_name']) { // reg_number 필터링
			$sql = "SELECT *, getSectors(reg_number) as sector_ar, getLicensedYears(reg_number) as licensed_ar, getPerformanceConcat(reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(reg_number) as ablility_ar FROM transfer WHERE company_name LIKE '%{$filters_array['company_name']}%' GROUP BY reg_number ORDER BY reg_number DESC LIMIT {$offset}, {$limit}";
			if ($need_logging)
				write_log("sql.inc - get_transfer_list() - query: " . $sql);
		} else if (is_array($filters_array['sectors']) && count($filters_array['sectors']) > 0) { // Sector 필터링
			if ($filters_array['new_licensed'] && in_array("전문", $filters_array['sectors'])) {
				$all_pro_sector = get_pro_sectors();
				$new_sector_array = array();
				$newi = 0;
				foreach ($filters_array['sectors'] as $esector) {
					if ($esector != "전문") {
						$new_sector_array[$newi] =  $esector;
						$newi++;
					}
				}
				foreach ($all_pro_sector as $esector) {
					$new_sector_array[$newi] =  $esector;
					$newi++;
				}
				unset($filters_array['sectors']);
				$filters_array['sectors'] = $new_sector_array;
			}
			$sql_filter = "AND (";
			for ($i = 0; $i < count($filters_array['sectors']); $i++) {
				$sql_filter .= "t2.sector = '" . $filters_array['sectors'][$i] . "'";
				if ($i < (count($filters_array['sectors']) - 1)) {
					$sql_filter .= " OR ";
				}
			}
			$sql_filter .= ")";
			if ($filters_array['new_licensed']) {  // 신규만 검색하는 경우 (신규는 5년간 실적이 없는 경우)
				$sql = "SELECT t1.*, getSectors(t1.reg_number) as sector_ar, getLicensedYears(t1.reg_number) as licensed_ar, getPerformanceConcat(t1.reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(t1.reg_number) as ablility_ar FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) AND getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) = 0 GROUP BY t1.reg_number ORDER BY t1.reg_number DESC LIMIT {$offset}, {$limit}";
				// sector를 제외한 다른 것들은 모두 t1 으로 해야한다. 
				if ($need_logging)
					write_log("sql.inc - get_transfer_list() - query: " . $sql);
			} else { // 신규와 실적이 있는 것 모두
				$sql = "SELECT t1.*, getSectors(t1.reg_number) as sector_ar, getLicensedYears(t1.reg_number) as licensed_ar, getPerformanceConcat(t1.reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(t1.reg_number) as ablility_ar FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) GROUP BY t1.reg_number ORDER BY t1.reg_number DESC LIMIT {$offset}, {$limit}";
				// sector를 제외한 다른 것들은 모두 t1 으로 해야한다. 
	
				/* 
				AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) 이거는 빼도 되지않을까? 
				쿼리 처리에 약간의 부하를 더 주겠지만.
				이것이 실수로 performance에는 입력이되지않은 업체는 보이지 않게해 오류를 줄여줄 수 있을 듯하다. 
				아래 쿼리는 삭제한 경우의 예
				*/
				//$sql = "SELECT t1.*, getSectors(t1.reg_number) as sector_ar, getLicensedYears(t1.reg_number) as licensed_ar, getPerformanceConcat(t1.reg_number, 3, {$performance_from_year}) as sales_three_ar, getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) as sales_five_ar, getAbility(t1.reg_number) as ablility_ar FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} GROUP BY t1.reg_number ORDER BY t1.reg_number";
				if ($need_logging)
					write_log("sql.inc - get_transfer_list() - query: " . $sql);
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
	if (!$error_message) {
		if (is_array($result_list) && count($result_list) > 0) {
			$retval = $result_list;
		} else {
			$retval = "no_result";
		}
	}
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
			write_log("sql.inc - count_transfer_list() - query: " . $sql);
	} else if ($filters_array['searchType'] == "reg_number" && isset($filters_array['reg_number']) && $filters_array['reg_number']) { // reg_number 필터 
		$sql = "SELECT COUNT(sn) FROM transfer WHERE reg_number = '{$filters_array['reg_number']}'";
	} else if ($filters_array['searchType'] == "company_name" && isset($filters_array['company_name']) && $filters_array['company_name']) { // company_name 필터
		$sql = "SELECT COUNT(sn) FROM transfer WHERE company_name LIKE '%{$filters_array['company_name']}%' ";
	} else if (is_array($filters_array['sectors']) && count($filters_array['sectors']) > 0) { // sectro 필터
		if ($filters_array['new_licensed'] && in_array("전문", $filters_array['sectors'])) {
			$all_pro_sector = get_pro_sectors();
			$new_sector_array = array();
			$newi = 0;
			foreach ($filters_array['sectors'] as $esector) {
				if ($esector != "전문") {
					$new_sector_array[$newi] =  $esector;
					$newi++;
				}
			}
			foreach ($all_pro_sector as $esector) {
				$new_sector_array[$newi] =  $esector;
				$newi++;
			}
			unset($filters_array['sectors']);
			$filters_array['sectors'] = $new_sector_array;
		}
		$sql_filter = "AND (";
		for ($i = 0; $i < count($filters_array['sectors']); $i++) {
			$sql_filter .= "t2.sector = '" . $filters_array['sectors'][$i] . "'";
			if ($i < (count($filters_array['sectors']) - 1)) {
				$sql_filter .= " OR ";
			}
		}
		$sql_filter .= ")";
		if ($filters_array['new_licensed']) {  // 신규만 검색하는 경우 (신규는 5년간 실적이 없는 경우)
			$sql = "SELECT COUNT(DISTINCT t1.sn) FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance) AND getPerformanceConcat(t1.reg_number, 5, {$performance_from_year}) = 0";
			if ($need_logging)
				write_log("sql.inc - count_transfer_list() - query: " . $sql);
		} else { // 신규와 실적이 있는 것 모두
			$sql = "SELECT COUNT(DISTINCT t1.sn) FROM transfer t1 INNER JOIN performance t2 ON t1.reg_number = t2.reg_number WHERE (1) {$sql_filter} AND t1.reg_number IN (SELECT DISTINCT reg_number FROM performance)";
			if ($need_logging)
				write_log("sql.inc - count_transfer_list() - query: " . $sql);
		}
	} else { // sector 가 array이 오지 않는 경우 오류 로그와 return false
		if ($need_logging)
			write_log("sql.inc: count_transfer_list(), Need array filter.");
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
			write_log("sql.inc: count_transfer_list(), " . $error_message);
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
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $performance_from_year, $performance_last_yesr, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: get_performance_info({$reg_number}), Need reg_number");
		return $retval;
	}
	// SELECT * FROM performance WHERE reg_number = 10004 AND (year > 2022 - 6 AND year <= 2022);
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM performance WHERE reg_number = ? AND (year > {$performance_last_yesr} - 6 AND year <= {$performance_last_yesr})";
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

function remove_performance_info($reg_number)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: remove_performance_info(), Need reg_number");
		return $retval;
	}
	// DELETE FROM performance WHERE reg_number = 10004;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM performance WHERE reg_number = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($reg_number));
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: remove_performance_info({$reg_number}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function remove_finstatements($reg_number)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: remove_finstatements(), Need reg_number");
		return $retval;
	}
	// DELETE FROM performance WHERE reg_number = 10004;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM finstatements WHERE reg_number = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($reg_number));
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: remove_finstatements({$reg_number}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function remove_transfer($reg_number)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: remove_transfer(), Need reg_number");
		return $retval;
	}
	// DELETE FROM performance WHERE reg_number = 10004;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "DELETE FROM transfer WHERE reg_number = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($reg_number));
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: remove_transfer({$reg_number}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function get_finstatements($reg_number = "")
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	if ($reg_number == "") {
		if ($need_logging)
			write_log("sql.inc: get_finstatements({$reg_number}), Need reg_number");
		return $retval;
	}

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM finstatements WHERE reg_number = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($reg_number));
		$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_finstatements({$reg_number}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $userinfo;

	return $retval;
}

function get_user_info($username)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $performance_from_year, $performance_last_yesr, $need_logging;
	$retval = false;
	$error_message = false;
	if ($username == "") {
		if ($need_logging)
			write_log("sql.inc: get_user_info({$username}), Need username");
		return $retval;
	}
	// SELECT * FROM performance WHERE username = 10004 AND (year > 2022 - 6 AND year <= 2022);
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM users WHERE username = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($username));
		$userinfo = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_user_info({$username}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = $userinfo;

	return $retval;
}

function modify_transfer_info($modify_info_array = array())
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
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
modfied_date = now(),
homeip = '" . $homeip . "'
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
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
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
modfied_date = now(),
homeip = '" . $homeip . "'
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

function modify_finstatements($modify_info_array = array())
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
	$retval = false;
	$error_message = false;
	/*
	$modify_info_array = (
	'reg_number' => $reg_number,
	'debt_ratio' => $debt_ratio,
	'fixed_debt' => $fixed_debt,
	'current_ratio' => $current_ratio,
	'fixed_assets' => $fixed_assets,
	'total_capital' => $total_capital,
	'revenue' => $revenue,
	'operating_profit' => $operating_profit,
	'income_after_tax' => $income_after_tax,
	'debt_equity' => $debt_equity
	)
	*/
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE finstatements SET
debt_ratio = '" . $modify_info_array['debt_ratio'] . "',
fixed_debt = '" . $modify_info_array['fixed_debt'] . "',
current_ratio = '" . $modify_info_array['current_ratio'] . "',
fixed_assets = '" . $modify_info_array['fixed_assets'] . "',
total_capital = '" . $modify_info_array['total_capital'] . "',
revenue = '" . $modify_info_array['revenue'] . "',
operating_profit = '" . $modify_info_array['operating_profit'] . "',
income_after_tax = '" . $modify_info_array['income_after_tax'] . "',
debt_equity = '" . $modify_info_array['debt_equity'] . "',
modfied_date = now(),
homeip = '" . $homeip . "'
WHERE reg_number = '" . $modify_info_array['reg_number'] . "'";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: modify_finstatements(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function modify_user_info($username, $password, $role = "")
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip;
	$retval = false;
	$error_message = false;
	$password_encrypted = password_hash($password, PASSWORD_DEFAULT);
	try {
		$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "UPDATE users SET
password = '" . $password_encrypted . "',
role = '" . $role . "',
modfied_date = now(),
homeip = '" . $homeip . "'
WHERE username = '" . $username . "'";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: modify_finstatements(), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function get_pro_sectors() {
	global $config;
	$pro_constructor = array();
	foreach($config['전문건설업'] as $key => $values) {
		foreach($values as $esector) {
			$pro_constructor[] = $esector;
		}
	}
	return $pro_constructor;
}

function get_all_sectors() {
	global $config;
	$all_sectors_array = array();
	$i = 0;
	foreach($config['종합건설업'] as $esector) {
		$all_sectors_array[$i] = $esector;
		$i++;
	}
	$pro_sectors = get_pro_sectors();
	foreach($pro_sectors as $esector) {
		$all_sectors_array[$i] = $esector;
		$i++;
	}
	foreach($config['기타공사업'] as $esector) {
		$all_sectors_array[$i] = $esector;
		$i++;
	}
	return $all_sectors_array;
}

function transfer_info_per_sector($performance_info_array)
{
	global $performance_from_year, $need_logging;
	$retval = false;
	if (!is_array($performance_info_array)) {
		if ($need_logging)
			write_log("sql.inc: performance_sum_per_sector({$performance_info_array}), Need reg_number");
		return $retval;
	}
	$transfer_sector_array = array();
	$pre_sector = "";
	$sectori = -1;
	$for_three_year_sum = 0;
	$for_five_year_sum = 0;
	foreach($performance_info_array as $eperformance) {
		if ($eperformance['sector'] != $pre_sector) {
			$for_three_year_sum = 0;
			$for_five_year_sum = 0;
			$sectori++;
			$pre_sector = $eperformance['sector'];
			$transfer_sector_array[$sectori]['sector'] = $eperformance['sector'];
			$transfer_sector_array[$sectori]['year_licensed'] = $eperformance['year_licensed'];
			$transfer_sector_array[$sectori]['construction_ability'] = $eperformance['construction_ability'];
			$transfer_sector_array[$sectori]['sales'][$eperformance['year']] = $eperformance['annual_sales'];
			if ($eperformance['year'] <= $performance_from_year && $eperformance['year'] > $performance_from_year - 5) {
				$for_five_year_sum = $for_five_year_sum + $eperformance['annual_sales'];
				$transfer_sector_array[$sectori]['five_year'] = $for_five_year_sum;
			}
			if ($eperformance['year'] <= $performance_from_year && $eperformance['year'] > $performance_from_year - 3) {
				$for_three_year_sum = $for_three_year_sum + $eperformance['annual_sales'];
				$transfer_sector_array[$sectori]['three_year'] = $for_three_year_sum;
			}
		} else {
			$transfer_sector_array[$sectori]['sales'][$eperformance['year']] = $eperformance['annual_sales'];
			if ($eperformance['year'] <= $performance_from_year && $eperformance['year'] > $performance_from_year - 5) {
				$for_five_year_sum = $for_five_year_sum + $eperformance['annual_sales'];
				$transfer_sector_array[$sectori]['five_year'] = $for_five_year_sum;
			}
			if ($eperformance['year'] <= $performance_from_year && $eperformance['year'] > $performance_from_year - 3) {
				$for_three_year_sum = $for_three_year_sum + $eperformance['annual_sales'];
				$transfer_sector_array[$sectori]['three_year'] = $for_three_year_sum;
			}
		}
	}
	if (count($transfer_sector_array) > 0) {
		$retval = $transfer_sector_array;
	}
	return $retval;
}

function get_new_regnumber() {
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT MAX(reg_number) FROM transfer;";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if ($result)
			$retval = $result + 1; 
	} catch(PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_new_regnumber(), " . $error_message);
	}
	$pdo = null;
	return $retval;
}

/* license */
function get_category($sector) {
	global $config;
	$pro_constructor_sectors = get_pro_sectors();
	if (in_array($sector, $config['종합건설업'])) {
		$category = "종합건설업";
	} else if (in_array($sector, $pro_constructor_sectors)) {
		$category = "전문건설업";
	} else {
		$category = "기타공사업";
	}
	return $category;
}

function get_pro_subcategory($sector) {
	global $config;
	$pro_constructor_array = $config['전문건설업'];
	$subcategory = "";
	foreach($pro_constructor_array as $key => $value) {
		if(in_array($sector, $value)){
			$subcategory = $key;
			break;
		}
	}
	return $subcategory;
}

function get_license($sector)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$license_array = array();

	if ($sector == "") {
		if ($need_logging)
			write_log("sql.inc: get_license({$sector}), Need sector");
		return $retval;
	}

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM license WHERE sector = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($sector));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_license({$sector}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message) {
		foreach($result as $key => $value) {
			if($key == "fund_explain") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "cooperative_explain") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "detail_head") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "detail") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "example_head") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "example") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "facility") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "ability_head") {
				$license_array[$key] = get_textarea($value);
			} elseif($key == "ability") {
				$license_array[$key] = get_textarea($value);
			} else {
				$license_array[$key] = $value;
			}
			
		}
		$retval = $license_array;
	}

	return $retval;
}

function get_license_html($sector)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;

	if ($sector == "") {
		if ($need_logging)
			write_log("sql.inc: get_license({$sector}), Need sector");
		return $retval;
	}

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT * FROM license WHERE sector = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($sector));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: get_license({$sector}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message) {
		$retval = $result;
	}

	return $retval;
}

function write_license($sector, $fund_private, $fund_corporation, $fund_explain, $cooperative_name, $cooperative_private, $cooperative_corporation, $cooperative_explain, $detail_head, $detail, $example_head, $example, $facility, $ability_head, $ability, $technician)
{
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging, $homeip, $config;
	$retval = false;
	$error_message = false;

	if ($sector == "") {
		if ($need_logging)
			write_log("sql.inc: write_license({$sector}), Need sector");
		return $retval;
	}

	$fund_explain = trim($fund_explain);
	$cooperative_name = trim($cooperative_name);
	$cooperative_explain = save_textarea($cooperative_explain);
	$cooperative_private = trim($cooperative_private);
	$cooperative_corporation = trim($cooperative_corporation);
	$detail_head = save_textarea($detail_head);
	$detail = save_textarea($detail);
	$example_head = save_textarea($example_head);
	$example = save_textarea($example);
	$facility = save_textarea($facility);
	$ability_head = save_textarea($ability_head);
	$ability = save_textarea($ability);
	//technician은 table tag 포함되어 오기 때문에 변형 필요하지않다. 
	$remove_sql = "DELETE FROM license WHERE sector = ?";
	$add_sql = "INSERT INTO license VALUES (0
,'" . $sector . "'
," . $fund_private . "
," . $fund_corporation . "
,'" . $fund_explain . "'
,'" . $cooperative_name . "'
,'" . $cooperative_private . "'
,'" . $cooperative_corporation . "'
,'" . $cooperative_explain . "'
,'" . $detail_head . "'
,'" . $detail . "'
,'" . $example_head . "'
,'" . $example . "'
,'" . $facility . "'
,'" . $ability_head . "'
,'" . $ability . "'
,'" . $technician . "'
,'" . $homeip . "'
,now()
)";

	if ($need_logging)
		write_log("write_license({$sector})-query: " . $add_sql);

	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		/* remove */
		$stmt = $pdo->prepare($remove_sql);
		$stmt->execute(array($sector));
		/* add */
		$stmt = $pdo->prepare($add_sql);
		$stmt->execute();
	} catch (PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: write_license({$sector}), " . $error_message);
	}
	$pdo = null;
	if (!$error_message)
		$retval = true;

	return $retval;
}

function is_license_exist($sector) {
	global $charset, $dbserver, $dbname, $dbuser, $dbpassword, $need_logging;
	$retval = false;
	$error_message = false;
	$dsn = "mysql:host={$dbserver};port=3306;dbname={$dbname}{$charset}";
	try {
		$pdo = new PDO($dsn, $dbuser, $dbpassword, array(PDO::ATTR_TIMEOUT => 7));
		$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT count(sector) FROM license WHERE sector = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($sector));
		$result = $stmt->fetchColumn();
		if ($result > 0)
			$retval = true;
	} catch(PDOException $e) {
		$error_message = $e->getMessage();
		if ($need_logging)
			write_log("sql.inc: is_license_exist(), " . $error_message);
	}
	$pdo = null;
	return $retval;
}



?>
<!-- sql functions loaded -->