<div class="container">
    <?php
    if (isset($_GET['search_string'])) {
        ?>
        <a href="<?php echo URL . 'searchResults/index?back_search_string=' . $_GET['search_string']; ?>"
           class="btn btn-info btn-lg" role="button">Back To Search</a>
        <?php
    }
    ?>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <?php
        for ($i = 0; $i < count($image_results); $i++) {
        ?>
            <li data-target="#myCarousel" data-slide-to="<?php echo $i ?>"
                <?php if($i == 0) { ?>
                    class="active"
                <?php } ?>>
            </li>
        <?php }
        ?>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
          <?php for ($i = 0; $i < count($image_results); $i++) { ?>
                <div class="item <?php if($i == 0) { ?> active" <?php } ?>">
                    <img class="carousel-image" src="./../uploads/<?php echo $image_results[$i]["image_name"] ?>" alt="Chania">
                </div>
          <?php } ?>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <div class="panel panel-primary col-xs-18 col-sm-6 col-md-7">
        <div class="panel-heading">Information about this Listing</div>
        <ul class="list-group">
          <li class="list-group-item">Room Type: <?php echo $rental_listing_type ?></li>
          <li class="list-group-item">Description: <?php echo $rental_listing_description ?></li>
          <li class="list-group-item">Address: <?php echo $rental_listing_address ?></li>
          <li class="list-group-item">Price: $<?php echo $rental_listing_price ?></li>
          <li class="list-group-item">Occupants<?php echo $rental_listing_occupants ?></li>
          <li class="list-group-item">Pets Allowed: <?php echo ($rental_listing_pets ? "Yes" : "No") ?></li>
          <li class="list-group-item">
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
          </li>
        </ul>
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
