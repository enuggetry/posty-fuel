#!/usr/bin/php
<?php
//including database details/configuration
require 'db.php';

// get list of page where sent = 0	
$query = "select * from user_page where 1";
$result = mysql_query($query) or die(mysql_error());

echo "<ul>";
while($item = mysql_fetch_object($result)):
	echo "<li>".$item->pageName."</li>";
endwhile;
echo "</ul>";
?>
