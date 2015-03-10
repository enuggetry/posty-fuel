<?php
/*
 * feed/add
 * feed/get
 * feed/delete
 */

include_once "dblib.php";
$module = "feed";

$vars = array("name","type","url");
$params = $_GET;

processCmd($params,$vars);
?>