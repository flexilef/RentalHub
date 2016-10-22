/**
 * Created by PhpStorm.
 * User: Abhi
 * Date: 10/22/16
 * Time: 1:56 PM
 */
<h3>Displaying images:</h3>
    <div class="slideshow-container">

      <?php foreach ($imageresults as $image) { ?>
    <div class="mySlides fade">
        <img class="myImg" width="100%" height="200px" src="./../uploads/<?php echo $image->image_name?>">
    </div>
<?php } ?>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>
<?php $count = 1?>
<div style="text-align:center">
    <?php foreach ($imageresults as $image) { ?>
        <span class="dot" onclick="currentSlide(<?php echo $count?>)"></span>
        <?php $count += 1?>
    <?php } ?>
</div>