<?php
/*
	get RSS file content
*/
//header("Content-Type:text/html");

$rssurl = $_GET['rss'];

$html = file_get_contents($rssurl);
//$html = htmlspecialchars_decode($html);

echo $html;

?>

