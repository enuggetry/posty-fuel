<?php
/*
	this is a test json-p script
*/
header('Access-Control-Allow-Origin: *');

$callback = isset($_GET['callback']) ? preg_replace('/[^a-z0-9$_]/si', '', $_GET['callback']) : false;
header('Content-Type: ' . ($callback ? 'application/javascript' : 'application/json') . ';charset=UTF-8');

$msg = $_GET['input'];

$data = array('returnValue' => $msg." My World");

echo ($callback ? $callback . '(' : '') . json_encode($data) . ($callback ? ')' : '');

?>

