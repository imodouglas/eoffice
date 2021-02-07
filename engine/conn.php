<?php
	$conn = new PDO("mysql:host=localhost;dbname=eoffice",'root','');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  	$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);

	session_start();

error_reporting(E_ALL);
?>
