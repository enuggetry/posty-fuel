<?php
require 'db.php';
	
	$filePath = "/home/roo46p5/public_html/rooby.me/posty/fbpost/files";

	$url = $_GET['url'];
	$msg = $_GET['msg'];
	$chan = $_GET['ch'];
	
	//echo getcwd();
	
	// insert to get ID
	$query = 'INSERT INTO posts (url,msg,chan) VALUES ("'.$url.'","'.$msg.'","'.$chan.'")';
	//echo "$query<br/>";
	mysql_query($query);
	$id = mysql_insert_id();
	
	// extract the file extension 
	$s = explode(".",$url);
	$s1 = array_reverse($s);
	//print_r($s1);
	$ext = $s1[0];
	$img = $id.'.'.$ext;
	$imgpath = $filepath.'/'.$img;

	// save filename
	$query = 'UPDATE posts SET filename="'.$img.'" WHERE id = '.$id;
	//echo "$query<br/>";
	mysql_query($query);
	
	// copy the file
	file_put_contents($img, file_get_contents($url));
	
	//header("Content-Type: application/json");
	echo $_GET['callback'] . '(' . "{'result' : 'success'}" . ')';
?>