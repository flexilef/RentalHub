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
        <div class="slideshow-container">
            <?php $images = $rentalId_to_images[$id]; ?>
            <?php foreach($images as $image_name) { ?>
            <div class="mySlides fade">
            <img width="100%" height="600px" src="./../uploads/<?php echo $image_name; ?>">
            </div>
            <?php } ?>
            <span class="close">×</span>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
            <br>
            <?php $count = 1?>
            <div style="text-align:center">
                <?php foreach ($images as $image) { ?>
                    <span class="dot" onclick="currentSlide(<?php echo $count?>)"></span>
                    <?php $count += 1?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php } ?>