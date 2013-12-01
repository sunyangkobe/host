<?
/*
 * 2012 Jan 27
* Web Host interface system
*
* Process update info
*
* @author Kobe Sun
*
*/
include_once("includes.php");

function validateFields() {
	global $session;
	$errmsg = "";
	if (!isset($_POST["email"]) || !checkEmail($_POST["email"])) {
		$errmsg .= "邮箱地址不合理，请查验<br />";
	}
	if (!isset($_POST["phone"]) || !checkNum($_POST["phone"])) {
		$errmsg .= "电话号码不合理，请查验<br />";
	}
	if (!isset($_POST["qq"]) || !checkNum($_POST["qq"])) {
		$errmsg .= "QQ号码不合理，请查验<br />";
	}
	if (!isset($_POST["deskmate"]) || $_POST["deskmate"] == $session->user->getName()) {
		$errmsg .= "同桌不能是你自己哎。。。<br />";
	}
	return $errmsg;
}

function checkEmail($email) {
	// checks for proper syntax
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function checkNum($num) {
	// checks for proper syntax
	return ($num == "") || preg_match("/^[0-9]{1,}$/", $num);
}

$session = Session::getInstance();
$session->startSession();

Database::obtain()->connect();
# This will ensure that cookie will be set before the header is sent
ob_start();

if (!isset($_POST)) exit(0);
if (!isset($session->user)) exit(0);
if (!isset($session->varified) || !$session->varified || isset($_POST["back"])) movePage(301, "index.php?action=classmates");

if (isset($_POST["confirm"])) {
	$session->errmsg = validateFields();
	if ($session->errmsg == "") {
		unset($session->email);
		unset($session->qq);
		unset($session->phone);
		unset($session->deskmate);
		unset($session->location);
 		$session->user->updateUser(array (
			"email" => trim($_POST["email"]),
			"qq" => trim($_POST["qq"]),
			"phone" => trim($_POST["phone"]),
			"deskmate" => trim($_POST["deskmate"]),
 			"location" => trim($_POST["location"])
 		));
 		movePage(301, "index.php?action=classmates");
	} else {
		$session->email = $_POST["email"];
		$session->qq = $_POST["qq"];
		$session->phone = $_POST["phone"];
		$session->deskmate = $_POST["deskmate"];
		$session->location = $_POST["location"];
		movePage(301, "index.php?action=updateUser&uid=" . $session->user->getUid());
	}
?>

<?php
} else {
	exit(0);
}

ob_end_flush();
Database::obtain()->close();
?>