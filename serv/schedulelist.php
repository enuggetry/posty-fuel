<?php
/*
	schedule list get
*/
include_once "dblib.php";
$module = "schedule";

$params = $_GET;
$params['cmd'] = "list";

processCmd($params);


?>
