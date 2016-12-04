<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
            <div class="well">
                <h3 align="center">Search Filter</h3>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="location1" class="control-label">Sort Price</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-usd"></div>
                            <select id="priceSorting" class="form-control">
                                <option value="1">Any</option>
                                <option value="2" <?php echo $this->lowest_price; ?>>Lowest Price First</option>
                                <option value="3" <?php echo $this->highest_price; ?>>Highest Price First</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location1" class="control-label">Sort Date</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                            <select id="dateSorting" class="form-control">
                                <option value="1">Any</option>
                                <option value="2" <?php echo $this->oldest_date; ?>>Oldest Post First</option>
                                <option value="3" <?php echo $this->newest_date; ?>>Newest Post First</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location1" class="control-label">Sort Title</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-text-width"></div>
                            <select id="titleSorting" class="form-control">
                                <option value="1">Any</option>
                                <option value="2" <?php echo $this->alphabetical_title; ?>>Alphabetical Order</option>
                                <option value="3" <?php echo $this->reverse_alphabetical_title; ?>>Reverse Alphabetical Order</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Listing Type</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-home"></div>
                            <select class="form-control">
                                <option value="">Any</option>
                                <option value="">Bedroom</option>
                                <option value="">Apartment</option>
                                <option value="">House</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Number of Occupants Allowed</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-user"></div>
                            <select class="form-control">
                                <option value="">Any</option>
                                <option value="">1</option>
                                <option value="">2</option>
                                <option value="">3</option>
                                <option value="">4+</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pets Allowed</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-paw"></i></div>
                            <select class="form-control">
                                <option value="">Any</option>
                                <option value="">Yes</option>
                                <option value="">No</option>
                            </select>
                        </div>
                    </div>
                    <p class="text-center"><a id="filter" href="<?php echo URL . 'searchResults/index?search_string=' . $this->search_string; ?>" class="btn btn-danger glyphicon glyphicon-search" role="button"></a></p>
                </form>
            </div>
        </div>
        <?php
        if (isset($this->rental_id_to_images)) {
            ?>
            <div>
                <h3>Displaying Search Results</h3>
                <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center">
                    <?php
                    foreach ($this->rental_ids as $id) {
                        ?>
                        <div class="col-xs-18 col-sm-6 col-md-3" style="width: 35%">
                            <div class="thumbnail">
                                <?php
                                //index 0 because there is only one id in this associative array
                                $image_array = $this->rental_id_to_images[$id][0];
                                $firstimage = $image_array[0];
                                ?>
                                <img class="cardImg" src="./../uploads/<?php echo $firstimage; ?>">
                                <div class="caption">
                                    <h4 class="title">
                                        <?php
                                        $title = $this->rental_id_to_title[$id];
                                        echo $title;
                                        ?>
                                    </h4>
                                    <p class="desc">
                                        <?php
                                        $price = $this->rental_id_to_price[$id];
                                        echo $price;
                                        ?>
                                    </p>
                                    <a href="<?php echo URL . 'rentalListing/index?rental_listing_id=' . $id . '&search_string=' . $this->search_string; ?>" class="btn btn-info btn-lg" role="button">View</a>
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
                                    <div id="<?php echo $id ?>" style="font-size:20px;color:green;font-weight:bold;"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="col-lg-3 col-md-6 col-md-offset-3 col-lg-offset-0">
                <h3>No Results to Display</h3>
            </div>
            <?php
        }
        ?>
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


