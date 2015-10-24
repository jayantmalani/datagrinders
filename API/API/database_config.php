<?php
$user="root";
$password="@Maddy1907";
$database="Sphere";

@mysql_connect(localhost,$user,$password);
@mysql_select_db($database) or die("Unable to select database");
?>