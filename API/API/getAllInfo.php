<?php
include("ws_common.php");
$wsc= new ws_common();
error_reporting(0);
header('Content-type: application/json');
if(isset($_GET['uniqueID']))	$uniqueID = trim($_GET['uniqueID']);
else							$uniqueID = "";
echo $wsc->GetAllInfo($uniqueID);
?>
