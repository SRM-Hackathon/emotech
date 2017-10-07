<?php
error_reporting(E_ALL);
ini_set( 'session.use_only_cookies', TRUE );				
ini_set( 'session.use_trans_sid', FALSE );
session_start();
session_regenerate_id();
include("module.php");
$admin=new Admin();

if($_POST)
{
	$email = $_POST['email'];
	$pass = $_POST['password'];
	$password = md5($pass);
	if(!empty($email) && !empty($pass))
	{	
		$result=$admin->adminLogin($email, $password);
		//var_dump($result);
		$dbuser = $result['username'];
		$dbpass = $result['password'];
		if(count($result)!=0 && $email==$dbuser && $password==$dbpass)
		{
			$_SESSION['id'] = $result['id'];
			echo 'success';
		}
		else
		{
			echo 'failure';
		}
	}

}
?>