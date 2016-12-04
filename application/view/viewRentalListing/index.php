<div class="container">
    <?php
    if (isset($_GET['search_string'])) {
        ?>
        <a href="<?php echo URL . 'searchResults/index?back_search_string=' . $_GET['search_string']; ?>"
           class="btn btn-info btn-lg" role="button">Back To Search</a>
        <?php
    }
    ?>
    <h2>Rental Space Details</h2>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Type:</div>
        <div class="panel-body"><?php echo $rental_listing_type ?></div>
    </div>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Description:</div>
        <div class="panel-body"><?php echo $rental_listing_description ?></div>
    </div>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Address:</div>
        <div class="panel-body"><?php echo $rental_listing_address ?></div>
    </div>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Price:</div>
        <div class="panel-body">$ <?php echo $rental_listing_price ?></div>
    </div>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Occupants:</div>
        <div class="panel-body"><?php echo $rental_listing_occupants ?></div>
    </div>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Pictures: Click on images for slide show</div>
        <div class="panel-body">
            <div class="slideshow-container">
                <?php
                foreach ($image_results as $image) {
                    ?>
                    <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image["image_name"] ?>">
                <?php }
                ?>
            </div>
        </div>
        <?php
        if (isset($_SESSION['is_auth'])) {
            ?>
            <a href="#" class="btn btn-default btn-lg pull-right" role="button" onclick="confirmDeleteModal('<?php echo $this->rental_ids[$i] ?>')">Rent</a>
            <?php
        }else {
            ?>
            <a href="#" class="btn btn-default btn-lg pull-right" type="button" data-toggle="modal" data-target="#sign-in-modal">Rent</a>
            <?php
        }
        ?>
        <div id="successMessage" style="font-size:20px;color:green;font-weight:bold;"></div>
    </div>
    <div id="myModal" class="image-modal">
        <div class="slideshow-container">

            <?php
            foreach ($image_results as $image) {
                ?>
                <div class="mySlides image-fade">
                    <img width="100%" height="600px" class="myImg"  src="./../uploads/<?php echo $image["image_name"] ?>">
                </div>
            <?php }
            ?>
            <span class="image-close">×</span>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
            <br>
            <?php $count = 1 ?>
            <div style="text-align:center">
                <?php
                foreach ($image_results as $image) {
                    ?>
                    <span class="dot" onclick="currentSlide(<?php echo $count ?>)"></span>
                    <?php $count += 1 ?>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>


<!----modal starts here--->
<div id="contactModal" class="modal fade" role='dialog'>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Share Contact Details </h4>
            </div>
            <div class="modal-body">
                <p>Your contact details will be shared with the owner.</p>
                <p>Click Ok to continue </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <span id= 'okayButton'></span>
            </div>

        </div>
    </div>
</div>
<!--Modal ends here--->

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
            <form class="sign-in-form"  action="<?php echo URL . "sprofile/index"; ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="fname">
                <input type="email" name="email" placeholder="You@Provider.com">
                <input type="password" name="password" placeholder="Password">
                <input type="hidden" name="url" value="<?php echo $_SERVER['REQUEST_URI']?>" />
                <input type="hidden" name="params" value="<?php echo $_SERVER['QUERY_STRING']?>" />
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
            <form class="sign-up-form" action="<?php echo URL . "sprofile/index"; ?>" method="post" enctype="multipart/form-data">
                <p>Full Name:</p>
                <input type="text" class="form-control" name="fname" placeholder="">
                <br/>
                <p>Email:</p>
                <input type="email" name="email" placeholder="You@Provider.com">
                Password:
                <p class="disclaimer">Must have at least 8 characters</p>
                <input type="password" name="password"/>
                Verify Password:
                <input type="password" name="verifyPassword"/>
                <br><br>
                <input type="radio" name="student" value="student"/> I am a student who wants to rent.
                <br><br>
                <input type="radio" name="landLord" value="landlord"/> I am a landlord who wants to post.
                <br><br>
                <input type="submit" name="register" class="modal-submit" value="Register">
            </form>
            <div class="modal-footer">
                Already have an account? <a href="#" type="button" data-toggle="modal" data-target="#sign-in-modal" data-dismiss="modal">Sign In</a>
            </div>
        </div>
    </div>
</div>