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

//storing website url
$baseUrl = $_SERVER['PHP_SELF'];

//including PHP SDK of FB
require 'src/facebook.php';

//checking id logout request/ if yes then logout the user and redirect to homepage
if(isset($_GET['logout'])):
	session_start();
	session_destroy();
	header("location:$baseUrl");
endif;

// Create our Application instance 
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
if ($user):
  try {
	
	
	$userDetail = $facebook->api('/me');
	//get location of user
	$location = $userDetail['location']['id'];
	//getting list of friend
	$listFriends = $facebook->api('/me/friends');
	//getting first 10 friends
	$listFriends = array_slice($listFriends['data'],0,10);
	//creating single array to
	$tags = array();
	foreach($listFriends as $frnd):
		$tags[] = $frnd['id'];
	endforeach;
	
	//posting to facebook user page
  $facebook->api("/me/feed",'post',array('message'=>'sorry friends just testing for facebook app','place'=>'106442706060302','tags'=>$tags
									));

  
  } 
  catch (FacebookApiException $e) {
	//print_r($e);
    $user = null;
  }
  else:
  	header("location:$baseUrl");
endif;