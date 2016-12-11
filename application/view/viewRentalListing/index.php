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
        <a  id="send_email" class="btn btn-default btn-lg pull-right"  role="button" data-id="<?php echo $owner_email; ?>" href="javascript:void(0)">
            <i class="glyphicon glyphicon-envelope"></i>
        </a>
            <?php
        }else {
            ?>
            <a href="#" class="btn btn-success btn-lg pull-right" type="button" data-toggle="modal" data-target="#sign-in-modal">Contact</a>
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
    <!-- google map will be shown here -->
    <div id="gmap_canvas" style=" height:400px;">Loading map...</div>
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

<script type="text/javascript">
    function init_map() {
        var myOptions = {
            zoom: 14,
            center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
        var myCity = new google.maps.Circle({
        center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
        radius: 1000,
        strokeColor: "#0000FF",
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: "#0000FF",
        fillOpacity: 0.4
        });
        myCity.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', init_map);
</script>
