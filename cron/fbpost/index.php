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
	//getting list of pages
	$listPage = $facebook->api('/me/accounts');
  } 
  catch (FacebookApiException $e) {
	print_r($e);
    $user = null;
  }
endif;

// Login or logout url will be needed depending on current user state.
if ($user):
	$logoutUrl = $baseUrl.'?logout=true';
else:
  $statusUrl = $facebook->getLoginStatusUrl();
  $loginUrl = $facebook->getLoginUrl(array('scope' => 'user_photos,photo_upload,publish_stream,publish_actions,manage_pages'));
endif;


?>
<!doctype html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <title>Fb app</title>
  </head>
  <body>
    <?php if ($user): ?>
      <a href="<?php echo $logoutUrl; ?>">Logout</a>
    <?php else: ?>
		<div>
			<a href="<?php echo $loginUrl; ?>">Login with Facebook</a>
		</div>
    <?php endif ?>

    <?php if ($user): ?>
      <img src="https://graph.facebook.com/<?php echo $user; ?>/picture">
		<form method="get" action="page.php">
		<select name='id'>
		<option value="">Select Page</option>
		<?php 
		// looping the list of page and showing as drop down
			foreach($listPage['data'] as $page):?>
				<option value="<?php echo $page['id'];?>"><?php echo $page['name'];?></option>
		
		<?php endforeach;?>
		</select>
		<?php
		//looping the list of page and storing id,name and token so can access on other page
			foreach($listPage['data'] as $page):			
				$id = 'fb_'.$page['id'];
				$_SESSION["$id"]= $page['access_token'];
				$pageName = 'fb_pn_'.$page['id']; 
				$_SESSION["$pageName"]= $page['name']; 
			endforeach;?>

		<input type="submit">
		</form>
    <?php else: ?>
      <strong><em>You are not Connected.</em></strong>
    <?php endif; ?>


  </body>
</html>