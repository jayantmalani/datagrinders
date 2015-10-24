<?php
include("ws_common.php");
$wsc= new ws_common();
error_reporting(0);
header('Content-type: application/json');
if(isset($_GET['uniqueID']))	$uniqueID = trim($_GET['uniqueID']);
else							$uniqueID = "";
if(isset($_GET['code1']))	$code1 = trim($_GET['code1']);
else							$code1 = "";
if(isset($_GET['code2']))	$code2 = trim($_GET['code2']);
else							$code2 = "";
if(isset($_GET['code3']))	$code3 = trim($_GET['code3']);
else							$code3 = "";
if(isset($_GET['code4']))	$code4 = trim($_GET['code4']);
else							$code4 = "";
echo $wsc->UpdateClasses($uniqueID, $code1, $code2, $code3, $code4);
?>
