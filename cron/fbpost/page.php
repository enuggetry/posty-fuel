<?php
/**
 * Copyright 2011 Facebook, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

 //including PHP SDK of FB
require 'src/facebook.php';

//including database details/configuration
require 'db.php';
// Create our Application instance.
$facebook = new Facebook(array(
  'appId'  => '317900218352683',
  'secret' => 'e9aaa465917e83a6003f679b33a4b7e6',
  'fileUpload' => true,
   'allowSignedRequest' => false
));

// Get User ID
//getting user id
$user = $facebook->getUser();
//checks if user logged in
if ($user) {
  try {
  //checks if url has page id
  if($_GET['id']>0):
	//getting user id
	$pageId = $_GET['id'];
	//getting access token
	$accessToken = $_SESSION['fb_'.$pageId];
	//getting page name
	$pageName = $_SESSION['fb_pn_'.$pageId];
	 
		// query for checking if page is already exist in db
		$checkQuery = "select id from `user_page` where pageId='$pageId'";
		$resultSet = mysql_query($checkQuery) or die(mysql_error());
		$result = mysql_num_rows($resultSet);
		
		//if page is not already exist
		if($result==0):
		
			$token = $accessToken;
			//inserting page into databade
			$insertQuery = "insert into `user_page` (fbid,pageId,pageName,token) values('$user','$pageId','$pageName','$token')";
			mysql_query($insertQuery) or die(mysql_error());
		endif;		
   else:
   
   //if there is not page id in url then redirect to homepage
    header('location: index.php');die();
	  endif;
  }catch (FacebookApiException $e) {
		echo "<pre>"; print_r($e);
		$user = null;
  }
}
?>
<html>
<body>
<p>Page is selected</p>
</body>
</html>