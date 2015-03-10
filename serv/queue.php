<?php
/*
 * queue/add
 * queue/get
 * queue/delete
 */

include_once "dblib.php";
$module = "queue";

$vars = array("id","user_id","channel_id","name","content","image_url","link_url","schedule_date","scheduled","sent");
$params = $_GET;

processCmd($params,$vars);
?>
