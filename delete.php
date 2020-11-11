<?php 

	require_once "connect.php";
	$config = new Config();
  	date_default_timezone_set('Asia/Jakarta');

  	$delete = $config->delInvoice($_GET['id']);

  	return header('Location: index.php');
 ?>