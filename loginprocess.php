<?php
if (isset($_GET['signout'])) {
	$return_page = false;
	session_start();
	session_destroy();
	if (isset($_GET['retpage']) && $_GET['retpage']) {
		$return_page = $_GET['retpage'];
	}
	if ($return_page) {
		$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$return_page}'>
</form></body></html>
EOD;
		echo $post_page;
	} else {
		$header = "Location: index.php";
		header($header);
	}
	exit;
}

if (!(isset($_POST['action']) && isset($_POST['username']) && isset($_POST['password'])) || ($_POST['action'] != "login" && $_POST['action'] != "changepass") || !$_POST['username'] || !$_POST['password']) {
	$header = "Location: index.php";
	header($header);
	exit;
}

require_once("inc/config.inc");
require_once("inc/utils.inc");
require_once("inc/sql.inc");
require_once("inc/password.inc");

$action = $_POST['action'];
$username = $_POST['username'];
$password = $_POST['password'];

if ($_POST['return_page'])
	$return_page = $_POST['return_page'];
else
	$return_page = false;

$userinfo = get_user_info($username);
if (!$userinfo) {
	if ($return_page) {
		if ($action == "login") {
			$fail_result = $singinfail;
		} else {
			$fail_result = $passchangefaillogin;
		}
		$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$return_page}'>
<input type='hidden' name='signinresult' value='{$fail_result}'>
</form></body></html>
EOD;
		echo $post_page;
		exit;
	} else {
		$header = "Location: index.php";
		header($header);
		exit;
	}
}

$singinsuccess = false;
if (password_verify($password, $userinfo['password'])) {
	add_login_log($username);
	//session_start(); config.inc에서 이미 선언됨
	$_SESSION['username'] = $userinfo['username'];
	$singinsuccess = true;
}

if ($action == "login") { // sign in
	if ($return_page) {
		if ($singinsuccess) {
			$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$return_page}'>
</form></body></html>
EOD;
		} else {
			$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$return_page}'>
<input type='hidden' name='signinresult' value='{$singinfail}'>
</form></body></html>
EOD;
		}
		echo $post_page;
		exit;
	} else {
		$header = "Location: index.php";
		header($header);
		exit;
	}
} else if ($action == "changepass" && isset($_POST['password1']) && isset($_POST['password2']) && $_POST['password1'] && $_POST['password2']) { // change password
	if ($singinsuccess) {
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		if ($password1 == $password2) {
			if (modify_user_info($username, $password1)) {
				$chnage_result = $passchangesuccess;
				//session_start();
				session_destroy();
			} else {
				$chnage_result = $passchangefail;
			}
		} else {
			$chnage_result = $passchangediff;
		}
	} else {
		$chnage_result = $passchangefaillogin;
	}
	if ($return_page) {
		$post_page = <<<EOD
<html><body onload='document.form.submit();'>
<form name='form' method='post' action='{$return_page}'>
<input type='hidden' name='signinresult' value='{$chnage_result}'>
</form></body></html>
EOD;
		echo $post_page;
		exit;
	} else {
		$header = "Location: index.php";
		header($header);
		exit;
	}
}

?>