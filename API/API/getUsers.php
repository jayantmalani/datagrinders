<?php
include("ws_common.php");
$wsc= new ws_common();
error_reporting(0);
header('Content-type: application/json');
echo $wsc->GetAllUsers();
?>
