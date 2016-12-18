<div>
    <?php
    if (isset($_GET['search_string'])) {
        ?>
        <a href="<?php echo URL . 'searchResults/index?back_search_string=' . $_GET['search_string']; ?>"
           class="btn btn-info btn-lg" role="button">Back To Search</a>
        <?php
    }
    ?>
    <div id="listing-photos">
        <div id="cover-image" style="background-image:url(./../uploads/<?php echo $image_results[0]["image_name"] ?>)">
        </div>
        <div id="view-photos-btn" class="btn btn-info btn-lg">View Photos</div>
    </div>
    <div id="listing-information" class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div id="listing-title" class="panel-heading">About this listing</div>
        <ul class="list-group">
            <li class="list-group-item">Room Type: <?php echo $rental_listing_type ?></li>
            <li class="list-group-item">Description: <?php echo $rental_listing_description ?></li>
            <li class="list-group-item">Price: $<?php echo $rental_listing_price ?></li>
            <li class="list-group-item">Occupants allowed: <?php echo $rental_listing_occupants ?></li>
            <li class="list-group-item">Pets Allowed: <?php echo ($rental_listing_pets ? "Yes" : "No") ?></li>
            <li id="listing-contact" class="list-group-item">
                <?php
                if (isset($_SESSION['is_auth'])) {
                    ?>
                    <a  id="contact-btn" class="btn btn-lg btn-info listing-btn"  role="button" data-id="<?php echo $owner_email; ?>" href="javascript:void(0)">Contact Landlord</a>
                    </a>
                    <?php
                } else {
                    ?>
                    <a href="#" class="btn btn-lg btn-info listing-btn" type="button" data-toggle="modal" data-target="#sign-in-modal">
                        <i class="glyphicon glyphicon-envelope"></i><span>Contact Landlord</span>
                    </a>
                    <?php
                }
                ?>
            </li>
        </ul>
    </div>
    <!-- google map will be shown here -->
    <div id="gmap_canvas" style=" height:400px;">Loading map...</div>
</div>

<!--Slideshow modal starts here--->
<div id="myModal" class="image-modal">
    <div class="slideshow-container">
    <?php
        foreach ($image_results as $image)
        { ?>
            <div class="mySlides image-fade">
                <img width="100%" height="600px" class="myImg" src="./../uploads/<?php echo $image["image_name"]?>">
            </div>
    <?php
        } ?>
        <span class="image-close">×</span>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        <br>
    <?php $count = 1?>
        <div style="text-align:center">
        <?php
            foreach ($image_results as $image)
            { ?>
                <span class="dot" onclick="currentSlide(<?php echo $count ?>)"></span>
                <?php $count += 1?>
        <?php
            } ?>
        </div>
    </div>
</div>
<!--Slideshow modal ends here--->

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
