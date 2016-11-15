<div class="container">
    <a href="<?php echo  URL . 'searchResult/index?back_search_string='.$search_string; ?>" class="btn btn-info btn-lg" role="button">Back To Search</a>
    <h2>Rental Space Details</h2>
    <h3>Type:</h3>
    <div><?php echo $rental_listing_type?></div>
    <h3>Description:</h3>
    <div><?php echo $rental_listing_description?></div>
    <h3>Address:</h3>
    <div><?php echo $rental_listing_address?></div>
    <h3>Distance:</h3>
    <div><?php echo $rental_listing_distance?></div>
    <h3>Price:</h3>
    <div><?php echo $rental_listing_price?></div>
    <h3>Occupants:</h3>
    <div><?php echo $rental_listing_occupants?></div>
    <h3>Owner:</h3>
    <div><?php echo $rental_listing_owner?></div>
    <h3>Pets:</h3>
    <div><?php echo $rental_listing_pets?></div>
    <h3>Pictures:</h3>
    <div class="slideshow-container">
        <?php
            foreach ($image_results as $image)
            { ?>
                <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image->image_name?>">
        <?php
            } ?>
    </div>

    <div id="myModal" class="image-modal">
        <div class="slideshow-container">
        <?php
            foreach ($image_results as $image)
            { ?>
                <div class="mySlides image-fade">
                    <img width="100%" height="600px" class="myImg" src="./../uploads/<?php echo $image->image_name?>">
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
</div>