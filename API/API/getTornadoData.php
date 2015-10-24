<?php
include("ws_common.php");
header("Access-Control-Allow-Origin: *");
$wsc= new ws_common();
error_reporting(0);
header('Content-type: application/json');
if(isset($_GET['state']))	$state = trim($_GET['state']);
else							$state = "";
if(isset($_GET['year']))	$year = trim($_GET['year']);
else							$year = "";
if($state == "")
	echo $wsc->getTornadoDataYear($year);
else
	echo $wsc->getTornadoData($state,$year);
?>
	