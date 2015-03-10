<?php
/*
 * channel/add
 * channel/get
 * channel/delete
 */

include_once "dblib.php";
$module = "channel";

$vars = array("name","type");
$params = $_GET;

processCmd($params,$vars);
?>
