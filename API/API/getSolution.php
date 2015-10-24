<?php
include("ws_common.php");
header("Access-Control-Allow-Origin: *");
$wsc= new ws_common();
error_reporting(0);
header('Content-type: application/json');
echo $wsc->getSolution(); 
?>
	