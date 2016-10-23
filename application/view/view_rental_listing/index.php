<div class="container">
    <h3>Displaying images:</h3>
    <div class="slideshow-container">

        <?php foreach ($imageresults as $image) { ?>
            <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image->image_name?>">
            <?php echo "    "; ?>
        <?php } ?>
    </div>

    <div id="myModal" class="modal">
        <span class="close">×</span>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>
</div>