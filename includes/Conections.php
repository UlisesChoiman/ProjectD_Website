<?php
	require_once("Constants.php");
	try {
		$connection = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
	} //fin del try
	catch(Exception $e)
	{
		die($e -> getMessage());
	}
?>
