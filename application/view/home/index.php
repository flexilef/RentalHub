<div class="container">
	<h2 class="csclass">CSC 848/648 Software Engineering</h2>
	<h3 class="csclass">Section-2 Group 16</h3>
	<img src="public/img/San_Francisco_(Evening)_Compressed.jpg" alt="sf" class="img-responsive" style="width: 100%; height: auto">
	<!--https://commons.wikimedia.org/wiki/File:San_Francisco_(Evening).jpg-->
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
				<div class="col-xs-18 col-sm-6 col-md-4">
					<div class="thumbnail">
						<?php
						//index 0 because there is only one id in this associative array
						$image_array = $this->rental_id_to_images[$this->rental_ids[$i]][0];
						$firstimage = $image_array[0];
						?>
						<a href="<?php echo  URL . 'rentalListing/index?rental_listing_id='.$this->rental_ids[$i]; ?>" target="_blank"><img class="cardImg" src="./uploads/<?php echo $firstimage; ?>"></a>
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
							<a href="<?php echo  URL . 'rentalListing/index?rental_listing_id='.$this->rental_ids[$i]; ?>" target="_blank" class="btn btn-info btn-lg" role="button">View</a>
														<?php
							if (isset($_SESSION['is_auth'])) {
							    ?>
								<a  id="contact-btn" class="btn btn-default btn-lg pull-right"  role="button" data-id="<?php echo $owner_email; ?>" href="javascript:void(0)">
									<i class="glyphicon glyphicon-envelope"></i>
								</a>
								<?php
									}else {
									?>
                                <a href="#" class="btn btn-success btn-lg pull-right" type="button" data-toggle="modal" data-target="#sign-in-modal">Contact</a>
                                <?php
									}
									?>
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