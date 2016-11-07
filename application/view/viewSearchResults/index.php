<?php
if(isset($rental_id_to_images)) 
{ ?>
    <div class="container">
    <h3>Displaying Search Results</h3>
    <div class="slideshow-container">
        <?php 
            foreach ($rental_ids as $id) 
            { ?>
                <?php $title = $rental_id_to_title[$id]; ?>
                <h5>Title: <?php echo $title?></h5>
                <br>
                <?php $images = $rental_id_to_images[$id]; ?>
                <?php 
                    foreach($images as $image_name) 
                    { ?>
                        <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image_name; ?>">
                <?php 
                    } ?>
                <div class="navigation">
                    <a href="<?php echo APP."controller/rentalListing/index?rental_listing_id=".$id; ?>">View Details</a>
                </div>
        <?php 
            } ?>
        <div id="myModal" class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
    </div>

<?php 
} ?>