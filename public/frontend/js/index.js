$(function () {
    // Owl Carousel
    var owl = $(".slider-div");
    owl.owlCarousel({
        loop: false, // Set to false to prevent items from looping
        margin: 10,
        margin: 18,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 3
            },
            1024: {
                nav: true,
                dots: false
            },
            1200: {
                items: 4,
                dots: false,
                nav: true

            },
        },
    });
});

// brand slider start

$(function () {
    // Owl Carousel
    var owl = $(".brands");
    owl.owlCarousel({
        loop: false, // Set to false to prevent items from looping
        margin: 18,
        responsiveClass: true,
        responsive: {
            0: {
                items: 3
            },
            425: {
                items: 3
            },
            768: {
                items: 5
            },
            992: {
                items: 6
            },
            1024: {
                items: 7,
                nav: true,
                dots: false
            },
        },
    });
});

// brand slider start



// categories slider start

$(function () {
    // Owl Carousel
    var owl = $(".categories-slider");
    owl.owlCarousel({
        loop: false, // Set to false to prevent items from looping
        margin: 18,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 3
            },
            1024: {
                nav: true,
                dots: false
            },
            1200: {
                items: 3,
                dots: false,
                nav: true

            },
        },
    });
});

// categories slider End


// Product Image Gallery js Start

$('.thumbnail').on('click', function () {
    var clicked = $(this);
    var newSelection = clicked.data('big');
    var $img = $('.primary').css("background-image", "url(" + newSelection + ")");
    clicked.parent().find('.thumbnail').removeClass('selected');
    clicked.addClass('selected');
    $('.primary').empty().append($img.hide().fadeIn('slow'));
});

// Product Image Gallery js End

// number increase & decries js Start 

function increaseValue(max) {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value > max ? value = max : '';
    value++;
    document.getElementById('number').value = value;
}

function decreaseValue(max) {
   
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
  
    value <= 1 ? value = 1 : value--;
    document.getElementById('number').value = value;

}

// number increase & decries js End



// progres bar ja Start 

function animateSkillBar(skillPer) {
    var per = parseFloat(skillPer.getAttribute("per"));
    var animatedValue = 0;
    var startTime = null;

    function animate(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = timestamp - startTime;
        var stepPercentage = progress / 1000; // Dividing by duration in milliseconds (1000ms = 1s)

        if (stepPercentage < 1) {
            animatedValue = per * stepPercentage;
            skillPer.style.width = Math.floor(animatedValue) + "%";
            requestAnimationFrame(animate);
        } else {
            animatedValue = per;
            skillPer.style.width = Math.floor(animatedValue) + "%";
        }
    }

    requestAnimationFrame(animate);
}

// Function to check if an element is in the viewport
function isElementInViewport(el) {
    var rect = el.getBoundingClientRect();
    return (
        rect.top >= 0 &&
        rect.left >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.right <= (window.innerWidth || document.documentElement.clientWidth)
    );
}

// Function to handle the intersection observer callback
function handleIntersection(entries, observer) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            var skillPer = entry.target.querySelector(".skill-per");
            if (skillPer.getAttribute("animated") !== "true") {
                animateSkillBar(skillPer);
                skillPer.setAttribute("animated", "true");
            }
            observer.unobserve(entry.target);
        }
    });
}

// Initialize Intersection Observer
var observer = new IntersectionObserver(handleIntersection, { root: null, rootMargin: "0px", threshold: 0.1 });

// Add skill bars to the observer
var skillBars = document.querySelectorAll(".skill-wrrap");
skillBars.forEach(function (skillBar) {
    observer.observe(skillBar);
});

// Check if skill bars are already in the viewport on page load
window.addEventListener("DOMContentLoaded", function () {
    skillBars.forEach(function (skillBar) {
        if (isElementInViewport(skillBar)) {
            var skillPer = skillBar.querySelector(".skill-per");
            if (skillPer.getAttribute("animated") !== "true") {
                animateSkillBar(skillPer);
                skillPer.setAttribute("animated", "true");
            }
        }
    });
});


// loader ja Start 

$(document).ready(function () {

    // Fakes the loading setting a timeout
    setTimeout(function () {
        $('body').addClass('loaded');
    }, 2000);

});



// Function to show the div after a 2-second delay
function showDivWithDelay() {
    var div = document.querySelector('.preloader-tube-tunnel');
    if (div) {
        setTimeout(function () {
            div.style.display = 'block';
        }, 1500); // 2000 milliseconds (2 seconds)
    }
}

// Use an event listener to ensure the document is fully loaded before running the code
document.addEventListener("DOMContentLoaded", showDivWithDelay);



// Wait for the document to be fully loaded before accessing elements
document.addEventListener("DOMContentLoaded", function () {
    const loaderimg = document.getElementById("loaderimg");

    if (loaderimg) {
        function removeElement() {
            loaderimg.remove();
        }

        setTimeout(removeElement, 1500);
    }
});


// loader ja End 



// image upload js Start 



$('input[name="upload-img"]').on('change', function () {
    readURL(this, $('.file-wrapper'));  //Change the image
});

$('.close-btn').on('click', function () { //Unset the image
    let file = $('input[name="upload-img"]');
    $('.file-wrapper').css('background-image', 'unset');
    $('.file-wrapper').removeClass('file-set');
    file.replaceWith(file = file.clone(true));
});

//FILE
function readURL(input, obj) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            obj.css('background-image', 'url(' + e.target.result + ')');
            obj.addClass('file-set');
        }
        reader.readAsDataURL(input.files[0]);
    }
};


// image upload js End 

// Multi select option ja Start


$(function () {
    $('select').each(function () {
        $(this).select2({
            theme: 'bootstrap4',
            width: 'style',
            placeholder: $(this).attr('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    });
});


// Multi select option ja End 


// categories-slider animation script Start 

window.addEventListener('scroll', function () {
    var scrollY = window.scrollY;

    // Define a scroll threshold value, e.g., 100 pixels
    var threshold = 100;

    if (scrollY > threshold) {
        $('.categories-slider').addClass('small');
    } else {
        // If scrollY is less than the threshold, you can remove the 'small' class
        $('.categories-slider').removeClass('small');
    }
});

// categories-slider animation script End 


if ($(window).width() <= 991) {
    $(".wow").removeClass("wow");
}




