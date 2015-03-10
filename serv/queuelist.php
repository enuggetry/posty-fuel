<?php
/*
	queuelist get
*/
include_once "dblib.php";
$module = "queue";

$params = $_GET;
$params['cmd'] = "list";

processCmd($params);


?>
