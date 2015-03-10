<?php
/*
 * schedule/add
 * schedule/delete
 */

include_once "dblib.php";
$module = "schedule";

$vars = array("name","type","time");
$params = $_GET;

processCmd($params,$vars);
?>
