<?php 
include("function.php");
$obj = new Controller();
if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
	$ran =rand();
	$path = 'img/'.$ran.$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $path);
	$mobile = $_COOKIE['mobile'];
	$savePrescription = $obj->addChart('prescription', $path, $mobile);
}
?>