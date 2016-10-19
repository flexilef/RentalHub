<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SFSU Rental Hub</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet/less" type="text/css" href="less/bootstrap.less" />
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <img src="http://www.sfsu.edu/logo.png" class="img-thumbnail" alt="SFSU" width="80px" height="80px">
        </div>
        <div class="navbar-header">
            <a class="navbar-brand">CSC-848/648</a>
        </div>
        <div>
            <ul class="nav navbar-nav col-md-8">
                <li ><input type="text" class="form-control" placeholder="Enter Location"></li>
                <li><button type="button" class="btn btn-danger">Search</button></li>
            </ul>
        </div>
    </div>
</nav>
</body>
