<?php
/*
	feedlist get
*/
include_once "dblib.php";
$module = "feed";

$params = $_GET;
$params['cmd'] = "list";

processCmd($params);


?>
