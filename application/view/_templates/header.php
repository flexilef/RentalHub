<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>SFSU Rental Hub</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <!-- JQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
        
        <!-- Bootstrap Validator -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.7/validator.js" integrity="sha256-ZrJ1ZbedU+b0jUh9nHnV3GagEOUeckZ2DY0BV0lF3pg=" crossorigin="anonymous"></script>
        
        <!-- CSS -->
        <link href="<?php echo URL; ?>css/style.less" rel="stylesheet/less">

        <!-- Extra icons -->
        <script src="https://use.fontawesome.com/c8d876cc7d.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
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
                <a class="navbar-brand" href="<?php echo URL; ?>">SFSU Rental Hub</a>
            </div>
            <div class="col-sm-3 col-md-3">
                <form class="navbar-form" action="<?php echo URL . "searchResults/index"; ?>" method="post">
                    <div class="input-group">
                        <input type="text" name="rental_search" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" name="submit_search" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="collapse navbar-collapse pull-right">
                <ul class="nav navbar-nav">
                    <?php
                    if (isset($_SESSION['is_auth'])) {
                        ?>
                        <li><a href="<?php echo URL; ?>protoController/index">Post a Listing</a></li>
                        <?php
                    }else {
                        ?>
                        <li><a href="#" type="button" data-toggle="modal" data-target="#sign-in-modal">Post a Listing</a></li>
                        <?php
                    }
                    ?>
                    <li><a href="<?php echo URL; ?>profile/index">Profile & Postings</a></li>
                      <?php 
                            if (!isset($_SESSION['is_auth'])) {?>
                            <li><a href="#" type="button" data-toggle="modal" data-target="#sign-up-modal">
                             <?php echo "Sign Up";
                            }
                            ?>
                        </a>
                    </li>
                    
                     <?php
                            if (!isset($_SESSION['is_auth'])) {?>
                             <li><a href="#" type="button" data-toggle="modal" data-target="#sign-in-modal">
                              <?php   echo "Sign In";
                            }
                            ?></a>
                    </li>
                    <li> <a href="#" >  
                          <?php
                            if (isset($_SESSION['is_auth'])) {
                                echo "Welcome " . $_SESSION['name'];
                            }
                            ?> 
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo URL . "sprofile/logout"; ?>">
                            <?php if (isset($_SESSION['is_auth'])) {
                                echo "Logout"; 
                                }
                            ?>
                        </a>
                    </li>

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
                      <form id="sign_in_form" class="sign-in-form" action="<?php echo URL . "sprofile/index"; ?>" method="post" enctype="multipart/form-data" data-toggle="validator">
                        <input type="hidden" name="fname" >
                        <div class="form-group has-feedback">
                          <input type="email" class="form-control" name="email" placeholder="You@Provider.com" data-error="Please provide a valid E-mail!" required >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                          <input type="password" class="form-control" name="password" placeholder="Password" data-minlength="8"required >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                        </div>
                        <input type="hidden" name="url" value="<?php echo str_replace("&","?",explode('=', $_SERVER['QUERY_STRING'], 2)[1]);?>" >
                        <input type="submit" name="sign-in" class="modal-submit" value="Sign In" >
                      </form>
                    </div>
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
                      <form class="sign-up-form" action="<?php echo URL . "sprofile/index"; ?>" method="post" enctype="multipart/form-data" data-toggle="validator" >
                        <div class="form-group has-feedback">
                          <label for="input_name">Full Name:</label>
                          <input type="text" id="input_name"class="form-control" name="fname" placeholder="" required >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                          <label for="input_email">Email:</label>
                          <input type="email" id="input_email"class="form-control" name="email" placeholder="You@Provider.com" data-error="Please provide a valid E-mail!" required >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group has-feedback">
                          <label for="input_password">Password:</label>
                          <input type="password" id="input_password" class="form-control" name="password" data-minlength="8" required >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors">Must have at least 8 characters</div>
                        </div>
                        <div class="form-group has-feedback">
                          <label for="input_verify_password">Verify Password:</label>
                          <input type="password" id="input_verify_password" class="form-control" name="verifyPassword" data-match="#input_password" data-match-error="Passwords do not match" required >
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="form-group has-feedback"></div>
                        </div>
                        <div class="form-group has-feedback">
                          <input type="radio" name="registerType" value="student" required/> I am a student who wants to rent.
                          <br><br>
                          <input type="radio" name="registerType" value="landlord" required/> I am a landlord who wants to post.
                          <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                          <div class="help-block with-errors"></div>
                        </div>
                        <input type="hidden" name="url" value="<?php echo str_replace("&","?",explode('=', $_SERVER['QUERY_STRING'], 2)[1]);?>" >
                        <input type="submit" class="form-control" name="register" class="modal-submit" value="Register">
                      </form>
                    </div>
                   <div class="modal-footer">
                        Already have an account? <a href="#" type="button" data-toggle="modal" data-target="#sign-in-modal" data-dismiss="modal">Sign In</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
