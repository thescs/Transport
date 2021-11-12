<?php
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	
	header("Content-type: text/plain");
	require("classes/transport.class.php");
	
	$trans = new Transport();
	//var_dump( $trans->getTrol());
	var_dump($trans->getTransport($_GET["r"], ["lat" => 49.9853079, "lon" => 36.1810891]));
	//echo json_last_error_msg ();
	
	