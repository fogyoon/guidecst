<?php
/* 
기타 함수들 모음 파일입니다.
config.inc 뒤에
sql.inc 이전에 위치해야합니다.
*/

// 로그 파일이 너무 커지는 걸 방지합니다.
if (file_exists($error_log_file)) {
	if (filesize($error_log_file) > 50000)
		unlink($error_log_file);
}

function write_log($error_message)
{
	global $error_log_file;
	$fp = fopen($error_log_file, "a") or die("Unable to open file!");
	$error_message = date("Y-m-d H:i:s") . "|" . $error_message . "\n";
	fwrite($fp, $error_message);
	fclose($fp);
}

function read_log()
{
	global $error_log_file;
	if (file_exists($error_log_file)) {
		$fp = fopen($error_log_file, "r");
		$pos = -1000;
		fseek($fp, $pos, SEEK_END);
		$contents = fread($fp, filesize($error_log_file));
		fclose($fp);
		/* $result = str_replace("\r\n", "<br>", $contents); */
		$result = nl2br($contents);
		return $result;
	}
}

function print_money($money)
{
	$retval = $money;
	if (is_int($money)) {
		if($money < 100) {
			$converted = $money * 100;
			$retval = $converted . "만";
		} else {
			$converted = $money / 100;
			$retval = $converted . "억";
		}
	}
	return $retval;
}

function date2ymd($full_date) {
	return date("Y-m-d", strtotime($full_date));
}

function send_inquiry($type, $name, $phone, $email, $message, $transferNo = "") {
	global $config;
	$retval = false;
	$mail_from = $config['admin_email']; // cafe24에 발송 용으로 등록한 이메일 주소
	$mail_to = $config['company_email']; // 문의하기 이메일을 받을 담당자의 이메일 주소
	
	$headers  = "MIME-Version: 1.0\r\n"; // html 용 이메일
	$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
	$headers .= "from: <".$mail_from.">\r\n";
	$headers .= "Reply-To: ".$email."\r\n"; // 회신에 사용할 이메일
	$headers .= "X-Mailer: PHP/" . phpversion();
	
	$subject = "양도양수 상담문의";
	$contents = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<h3>양도양수 상담문의</h3>
<p>문의사항: {$type}</p>
<p>신청자: {$name}</p>
<p>전화번호: {$phone}</p>
<p>이메일주소: {$email}</p>
<p>매물 등록번호: {$transferNo}</p>
<p>문의내용:</p>
<p>
{$message}
</p>
</body>
</html>

EOD;
	
	if (mail($mail_to,$subject,$contents,$headers)) {
		$retval = true;
	}
	return $retval;
}

function save_textarea($text) {
	$string = nl2br(trim($text), false);
	$string = trim(preg_replace('/\s\s+/', '', $string));
	$string = str_replace("\t", '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', $string);
	return $string;
}

function get_textarea($text) {
	$string = preg_replace('#<br\s*/?>#i', "\n", trim($text));
	$string = trim(str_replace('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;', "\t", $string));
	return $string;
}

?>
<!-- utilities loaded -->