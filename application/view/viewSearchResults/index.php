<?php
if(isset($this->rental_id_to_images)) 
{ 
?>
    <div class="container">
    <h3>Displaying Search Results</h3>
    <div class="slideshow-container">
        <?php 
            foreach ($this->rental_ids as $id) 
            { 
        ?>
            <?php 
                $title = $this->rental_id_to_title[$id]; 
                $price = $this->rental_id_to_price[$id];
                $date_posted = $this->rental_id_to_date_posted[$id];
            ?>
                <h4>Title: <?php echo $title; ?></h4>
                <h5>Price: <?php echo $price; ?></h5>
                <h5>Date Posted: <?php echo $date_posted; ?></h5>
                <br>
            <?php
                //index 0 because there is only one element in this associative array
                $image_array = $this->rental_id_to_images[$id][0]; ?>
            <?php 
                foreach($image_array as $image)
                {
            ?>
                    <img class="myImg" width="100px" height="100px" src="./../uploads/<?php echo $image; ?>">
            <?php 
                } 
            ?>
                <hr>
               <div class="navigation">
                    <a href="<?php echo  URL . 'rentalListing/index?rental_listing_id='.$id; ?>">View Details</a>
                </div>
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
