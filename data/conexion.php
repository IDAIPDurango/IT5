<?php
	//$db_host = "idaip.org.mx";
	//$db_name = "idaiporg_correspondencia";
	//$db_user = "idaiporg_correspondencia";
	//$db_pass = "Idaip.2017";

	$db_host = "localhost";
	$db_name = "idaip_it5";
	$db_user = "root";
	$db_pass = "Idaip.2017";
	
	try {
		$db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user, $db_pass);
		$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}