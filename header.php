<?php

if ($page != "login") include('lock.php'); // login validation

/* 
	Implements the main navigation bar on all pages
 */
?>
<!DOCTYPE html>
<html lang="en" class="fuelux">
    <head>
        <meta charset="UTF-8">
        <title>posty-fuelux</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if ($page=="schedule"): ?>
        <link rel='stylesheet' type='text/css' href='js/fullcalendar/fullcalendar.css' />
        <link href='js/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
    <?php endif; ?>
    
        <link href="http://www.fuelcdn.com/fuelux-imh/2.6.1/css/fuelux.css" rel="stylesheet" />
        <link href="http://www.fuelcdn.com/fuelux-imh/2.6.1/css/fuelux-responsive.css" rel="stylesheet" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script src="http://www.fuelcdn.com/fuelux-imh/2.6.1/loader.min.js" type="text/javascript"></script>
        <link href="posty.css" rel="stylesheet">
    <?php if ($page=="schedule"): ?>
        <script src='http://code.jquery.com/ui/1.10.4/jquery-ui.min.js'></script>
        <script type='text/javascript' src='js/fullcalendar/fullcalendar.js'></script>
    <?php endif; ?>
        <script src="http://ajax.cdnjs.com/ajax/libs/json2/20110223/json2.js"></script>
        <script src="http://ajax.cdnjs.com/ajax/libs/underscore.js/1.6.0/underscore-min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js"></script>
    <?php if ($page=="select"): ?>
        <link href="lib/rssfeed/rssfeed.css" rel="stylesheet" type="text/css">    
        <script type="text/javascript" src="lib/rssfeed/rssfeed.js"></script>
    <?php endif; ?>

        <script  type="text/javascript">
            $(function () {
            });
        </script>
        <style>
            .xx { background-color: #eee; text-align: center;}
            .xxx { background-color: #ddd; text-align: center;}
            .xxxx { background-color: #ccc; text-align: center;}
        </style>
    </head>
<body>

    <div class="navbar  navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-inner">
            <div class="container">
                <a class="brand" href="#">Posty - FuelUX</a>
                <?php if ($page != "login"): ?>
                <ul class="nav">
                    <li <?php if ($page=='home') echo 'class="active"'; ?>><a href="/">Home<br/>&nbsp;</a></li>
                    <li <?php if ($page=='select') echo 'class="active"'; ?>><a href="select.php">Content<br/>Feeds</a></li>
                    <li <?php if ($page=='moderate') echo 'class="active"'; ?>><a href="moderate.php">Moderation<br/>Queues</a></li>
                    <li <?php if ($page=='schedule') echo 'class="active"'; ?>><a href="schedule.php">Schedule<br/>&nbsp;</a></li>
                    <!--li <?php if ($page=='statistics') echo 'class="active"'; ?>><a href="schedule.php">Statistics<br/>&nbsp;</a></li-->
                </ul>
                <a href="logout.php" class="btn btn-primary loginout-button" type="button">Logout</a>
                <?php else: ?>
                <div class="login-box loginout-button">
                    <form action="" method="post">
                    <input type="text" name="username" placeholder="Username"/>
                    <input type="password" name="password" placeholder="Password"/>
                    <input type="submit" value=" Submit " class="btn btn-primary" style="position:relative;top:-5px;" />
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="container-fluid main-content">
