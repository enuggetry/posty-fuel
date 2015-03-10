<?php
/*
	channellist /get
*/
include_once "dblib.php";
$module = "channel";

$params = $_GET;
$params['cmd'] = "list";

processCmd($params);


?>
