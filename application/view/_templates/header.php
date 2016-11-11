<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SFSU Rental Hub</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- CSS -->
    <link href="<?php echo URL; ?>css/style.less" rel="stylesheet/less">
</head>
<header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SFSU Rental Hub</a>
        </div>
        <div class="col-sm-3 col-md-3">
            <form class="navbar-form" action="<?php echo URL . "searchResults/index"; ?>" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="collapse navbar-collapse pull-right">
            <ul class="nav navbar-nav">
                <li><a href="<?php echo URL; ?>protoController/index">Post a Listing</a></li>
                <li><a href="#" type="button" data-toggle="modal" data-target="#sign-up-modal">Sign Up</a></li>
                <li><a href="#" type="button" data-toggle="modal" data-target="#sign-in-modal">Sign In</a></li>
            </ul>
        </div>
    </nav>
    <!-- Modal for Sign In -->
    <div id="sign-in-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign In</h4>
                </div>
                <div class="modal-body">
                </div>
                <form class="sign-in-form">
                    <input type="email" name="email" placeholder="You@Provider.com">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" name="sign-in" class="modal-submit" value="Sign In">
                </form>
                <div class="modal-footer">
                    Don't have an account? <a href="#" type="button" data-toggle="modal" data-target="#sign-up-modal" data-dismiss="modal">Register</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for Sign Up -->
    <div id="sign-up-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Sign Up</h4>
                </div>
                <div class="modal-body">
                </div>
                <form class="sign-up-form">
                    <p>Email:</p>
                    <input type="email" name="email" placeholder="You@Provider.com">
                    Password:
                    <p class="disclaimer">Must have at least 8 characters</p>
                    <input type="password" name="password"/>
                    Verify Password:
                    <input type="password" name="verify-password"/>
                    <br><br>
                    <input type="radio" name="registration-type" value="student"/> I am a student who wants to rent.
                    <br><br>
                    <input type="radio" name="registration-type" value="landlord"/> I am a landlord who wants to post.
                    <br><br>
                    <input type="submit" name="register" class="modal-submit" value="Register">
                </form>
                <div class="modal-footer">
                    Already have an account? <a href="#" type="button" data-toggle="modal" data-target="#sign-in-modal" data-dismiss="modal">Sign In</a>
            </div>
        </div>
    </div>
</header>
<body>