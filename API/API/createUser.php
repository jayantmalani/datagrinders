<?php
include("ws_common.php");
$wsc= new ws_common();
error_reporting(0);
if(isset($_GET['ownerFriendId']))	$ownerFriendId = trim($_GET['ownerFriendId']);
else							$ownerFriendId = "";
if(isset($_GET['name']))	$name = trim($_GET['name']);
else							$name = "";
if(isset($_GET['emailid']))	$emailid = trim($_GET['emailid']);
else							$emailid = "";
echo $wsc->CreateUser($ownerFriendId, $name, $emailid);  
?>
