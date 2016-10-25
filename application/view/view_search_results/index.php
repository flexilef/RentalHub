<?php
if(isset($rentalId_to_images)) { ?>
    <div class="container">
    <h3>Displaying Search Results</h3>
    <div class="slideshow-container">
        <?php foreach ($rentalIds as $id) { ?>
            <?php $title = $rentalId_to_title[$id]; ?>
            <h5>Title: <?php echo $title?></h5>
            <br>
            <?php $images = $rentalId_to_images[$id]; ?>
            <?php foreach($images as $image_name) { ?>
                <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image_name; ?>">
                <?php echo "    "; ?>
            <?php } ?>
        <?php } ?>
        <div id="myModal" class="modal">
            <span class="close">×</span>
            <img class="modal-content" id="img01">
            <div id="caption"></div>
        </div>
    </div>

<?php } ?>