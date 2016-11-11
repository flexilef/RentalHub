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
                            <select class="form-control">
                                <option value="">Any</option>
                                <option value="">Lowest Price First</option>
                                <option value="">Highest Price First</option>
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
                    <p class="text-center"><a href="#" class="btn btn-danger glyphicon glyphicon-search" role="button"></a></p>
                </form>
            </div>
        </div>
        <?php
        if(isset($rental_id_to_images))
        {
        ?>
            <h3>Displaying Search Results</h3>
            <div class="slideshow-container">
                <?php
                    foreach ($rental_ids as $id)
                    {
                ?>
                    <?php
                        $title = $rental_id_to_title[$id];
                        $price = $rental_id_to_price[$id];
                    ?>
                        <h4>Title: <?php echo $title ?></h4>
                        <h5>Price: <?php echo $price ?></h5>
                        <br>
                    <?php
                        //index 0 because there is only one id in this associative array
                        $image_array = $rental_id_to_images[$id][0]; ?>
                    <?php
                        foreach($image_array as $image)
                        {
                    ?>
                            <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image; ?>">
                    <?php
                        }
                    ?>
                        <hr>
                       <div class="navigation">
                            <a href="<?php echo  URL . 'rentalListing/index?rental_listing_id='.$id; ?>">View Details</a>
                        </div>
                <?php
                    }
                ?>
                <div id="myModal" class="modal">
                    <span class="close">×</span>
                    <img class="modal-content" id="img01">
                    <div id="caption"></div>
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



