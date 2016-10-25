<div class="container">
    <h3>Displaying images:</h3>
    <div class="slideshow-container">

        <?php foreach ($imageresults as $image) { ?>
            <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image->image_name?>">
            <?php echo "    "; ?>
        <?php } ?>
    </div>

    <div id="myModal" class="modal">
        <div class="slideshow-container">
        <?php foreach ($imageresults as $image) { ?>
            <img class="myImg" src="./../uploads/<?php echo $image->image_name?>">
            <?php echo "    "; ?>
        <?php } ?>
        <span class="close">×</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
        <a class="prev" onclick="plusSlides(-1)">❮</a>
        <a class="next" onclick="plusSlides(1)">❯</a>
        <br>
        <?php $count = 1?>
        <div style="text-align:center">
            <?php foreach ($imageresults as $image) { ?>
                <span class="dot" onclick="currentSlide(<?php echo $count?>)"></span>
                <?php $count += 1?>
            <?php } ?>
        </div>
        </div>
    </div>
</div>