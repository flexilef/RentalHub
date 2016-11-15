<div class="container">
	<h2>CSC 848/648 Software Engineering</h2>
	<h3>Section-2 Group 16</h3>
	<img src="public/img/San_Francisco_(Evening).jpg" alt="sf" style="width: 90%; height: 90%">  <!--https://commons.wikimedia.org/wiki/File:San_Francisco_(Evening).jpg-->
	<div>
		Source:
		<a href="https://commons.wikimedia.org/wiki/File:San_Francisco_(Evening).jpg">Basil D Soufi, Wikimedia</a>
	</div>
	<h4 style="font-size: 20pt">
		SFSU Rental Hub aims to provide an easy way for SFSU students to find
		available housing, posted by residents of the Bay Area.
	</h4>
	<br><br>
	<div class="row" style="display: flex; justify-content: space-around; align-items: center">
		<div class="row" style="display: flex; flex-wrap: wrap; justify-content: center">
			<?php
			for ($i = 0; $i<3; $i++ )
			{
				?>
				<div class="col-xs-18 col-sm-6 col-md-3" style="width: 30%">
					<div class="thumbnail">
						<?php
						//index 0 because there is only one id in this associative array
						$image_array = $this->rental_id_to_images[$this->rental_ids[$i]][0];
						$firstimage = $image_array[0];
						?>
						<img class="cardImg" src="./uploads/<?php echo $firstimage; ?>">
						<div class="caption">
							<h4 class="title">
								<?php
								$title = $this->rental_id_to_title[$this->rental_ids[$i]];
								echo $title;
								?>
							</h4>
							<p class="desc">
								<?php
								$price = $this->rental_id_to_price[$this->rental_ids[$i]];
								echo $price;
								?>
							</p>
							<a href="<?php echo  URL . 'rentalListing/index?rental_listing_id='.$this->rental_ids[$i]; ?>" class="btn btn-info btn-lg" role="button">View</a>
							<a href="#" class="btn btn-default btn-lg pull-right" role="button" onclick="confirmDeleteModal(<?php echo $i ?>)">Rent</a>
                            <div id="<?php echo $this->rental_ids[$i] ?>" style="font-size:20px;color:green;font-weight:bold;"></div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
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
                <p>Your contact details will be shared by the owner.</p>
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