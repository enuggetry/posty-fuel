#!/usr/bin/php
<?php 
// this method is used to avaoid timeout if db has many rows
ob_flush();flush();
//including PHP SDK of FB
require 'src/facebook.php';
//including database details/configuration
require 'db.php';

try {
	// Create our Application instance 
	$facebook = new Facebook(array(
	  'appId'  => '317900218352683',
	  'secret' => 'e9aaa465917e83a6003f679b33a4b7e6',
	  'fileUpload' => true,
	   'allowSignedRequest' => false
	));

// get list of page where sent = 0	
$getAllPage = "select * from user_page where sent=0";
$resultSet = mysql_query($getAllPage) or die(mysql_error());

//looping the result
while($result = mysql_fetch_object($resultSet)):
	// getting list of album
	$listAlbum = $facebook->api("/$result->pageId/albums",'get',array('access_token'=>$accessToken));
	//storing first album retrvied from above method
	$albumId = $listAlbum['data'][0]['id'];
	
	$msg = "photo ".rand(0,10000);

	//sending pic to facebook server to upload
	$photo = $facebook->api("/$albumId/photos",'post',
									array('access_token'=>$result->token,
									'url'=>'http://lorempixel.com/1920/1080/nature/',
									'message'=>$msg
									));
	
	// update query to set send true which if image has been uploaded.								
	mysql_query("update user_page set sent=1 where pageId='$result->pageId'");	
	echo "Photo ID - ".print_r($photo['id']);
	echo "<br>image sent - $msg";							
endwhile;

}
catch (FacebookApiException $e) {
	//showing error message if occers 
	$error = current($e);
	echo $error['error']['message'];
  
  }
?>