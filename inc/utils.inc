<?php

$error_log_file = "../phperror.log";
if (file_exists($error_log_file)) {
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
			$converted = $money * 1000000;
			$retval = $converted . "만";
		} else {
			$converted = $money / 100;
			$retval = $converted . "억";
		}
	}
	return $retval;
}

?>
<!-- utilities loaded -->