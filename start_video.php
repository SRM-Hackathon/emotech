<?php 
include("function.php");
$obj = new Controller();
$mobile = $_COOKIE['mobile'];
$videocalling = $obj->addChart('videocalling', 'start', $mobile);
?>