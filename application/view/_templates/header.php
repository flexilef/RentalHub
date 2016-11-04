<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
</head>
<body>
    <!-- logo -->
    <div class="logo">
        SFSU Rental Hub
    </div>

    <form class="search" action="<?php echo URL . "searchResults/index"; ?>" method="post">
        <h3>Search For a Rental Space</h3>
        <div>
            <input style="width:75%;" type="text" name="rental_search"/>
            <input style="width:20%;" type="submit" name="submit_search" value="Search"/>
        </div>  
        </form>

    <!-- navigation -->
    <div class="navigation">
        <a href="<?php echo URL; ?>">home</a>
        <a href="<?php echo URL; ?>protoController/index">Post Rental Listing</a>
    </div>
