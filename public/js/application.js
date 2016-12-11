$(function() {
    $('#priceSorting').change(function() {
        if ($(this).val() === '2') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&price=asc'
        }
        if ($(this).val() === '3') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&price=desc'
        }
    });

    $('#dateSorting').change(function() {
        if ($(this).val() === '2') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&date=asc'
        }
        if ($(this).val() === '3') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&date=desc'
        }
    });

    $('#titleSorting').change(function() {
        if ($(this).val() === '3') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&title=asc'
        }
        if ($(this).val() === '2') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&title=desc'
        }
    });
	
	//Added By Osama
	$('#rentType').change(function() {
        if ($(this).val() === '2') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&rentType=Bedroom'
        }
        
		if ($(this).val() === '3') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&rentType=Apartment'
        }
		
		if ($(this).val() === '4') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&rentType=House'
        }
       
    });
	
	$('#occupants').change(function() {
        if ($(this).val() === '1') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&occupants=1'
        }
		
		if ($(this).val() === '2') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&occupants=2'
        }
		if ($(this).val() === '3') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&occupants=3'
        }
		
		if ($(this).val() === '4') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&occupants=4'
        }
       
    });
	
	$('#isPetAllowed').change(function() {
        if ($(this).val() === '1') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&isPetAllowed=Y'
        }
        if ($(this).val() === '2') {
            document.getElementById("filter").href = document.getElementById("filter").href + '&isPetAllowed=N'
        }
    });
});

function confirmDeleteModal(id){
    $('#contactModal').modal();
    $('#okayButton').html('<a class="btn btn-success" onclick="contactOwner('+id+')">Okay</a>');
}
function contactOwner(id){
    // do your stuffs with id
    var newid = id.nodeName ? id : document.getElementById(id);
    $(newid).html("Details shared with owner");
    $('#contactModal').modal('hide'); // now close modal
}

// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var imgs = document.getElementsByClassName('myImg');
var cardimgs = document.getElementsByClassName('cardImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
var displayModal = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
};

var viewPhotosButton = document.getElementById('view-photos-btn');
viewPhotosButton.addEventListener('click', displayModal, false);

for (var i = 0; i < imgs.length; i++) {
    imgs[i].addEventListener('click', displayModal, false);
}

for (var i = 0; i < cardimgs.length; i++) {
    cardimgs[i].addEventListener('click', displayModal, false);
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("image-close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
};


var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" activeDot", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " activeDot";
}