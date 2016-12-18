<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-lg-offset-0">
            <div class="well">
                <h3 align="center">Search Filter</h3>
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="location1" class="control-label">Sort Price</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-usd"></div>
                            <select id="priceSorting" class="form-control">
                                <option value="1">Any</option>
                                <option value="2" >Lowest Price First</option>
                                <option value="3">Highest Price First</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="location1" class="control-label">Sort Date</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-calendar"></div>
                            <select id="dateSorting" class="form-control">
                                <option value="1">Any</option>
                                <option value="2">Oldest Post First</option>
                                <option value="3">Newest Post First</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Listing Type</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-home"></div>
                            <select id="rentType" class="form-control">
                                <option value="1" >Any</option>
                                <option value="2">Bedroom</option>
                                <option value="3">Apartment</option>
                                <option value="4">House</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Number of Occupants Allowed</label>
                        <div class="input-group">
                            <div class="input-group-addon glyphicon glyphicon-user"></div>
                            <select id="occupants" class="form-control">
                                <option value="">Any</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4+</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Pets Allowed</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-paw"></i></div>
                            <select id="isPetAllowed" class="form-control">
                                <option value="">Any</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                        </div>
                    </div>
                    <p class="text-center"><a id="filter" href="<?php echo URL . 'searchResults/index?search_string=' . $this->search_string; ?>" class="btn btn-primary glyphicon glyphicon-search" role="button"></a></p>
                </form>
            </div>
        </div>
        <?php
        if (isset($this->rental_id_to_images)) {
            ?>
            <div>
                <h3>Displaying <?php $matches = count($this->rental_ids); echo $matches; ?> Search Result<?php if($matches > 1) echo 's';?></h3>
                <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center">
                    <?php
                    foreach ($this->rental_ids as $id) {
                        ?>
                        <div class="col-xs-18 col-sm-18 col-md-6 col-lg-4">
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
                                    <a href="<?php echo URL . 'rentalListing/index?rental_listing_id=' . $id . '&search_string=' . $this->search_string; ?>" target="_blank" class="btn btn-info btn-lg" role="button">View</a>
							<?php
							if (isset($_SESSION['is_auth'])) {
							    ?>
								<a  id="contact-btn" class="btn btn-default btn-lg pull-right"  role="button" data-id="<?php echo $owner_email; ?>" href="javascript:void(0)">
									<i class="glyphicon glyphicon-envelope"></i>
								</a>
								<?php
									}else {
									?>
                                <a href="#" class="btn btn-success btn-lg pull-right" type="button" data-toggle="modal" data-target="#sign-in-modal">Contact Landlord</a>
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

