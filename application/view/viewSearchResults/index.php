<?php
if(isset($rental_id_to_images)) 
{ 
?>
    <div class="container">
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
}
?>