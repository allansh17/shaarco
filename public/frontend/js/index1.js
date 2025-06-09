$(function () {
    // Owl Carousel
    var owl = $(".slider-div");
    owl.owlCarousel({
        loop: false, // Set to false to prevent items from looping
        margin: 10,
        responsiveClass: true,
        //  nav: false, 
        // dots: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            992: {
                items: 3,
                dots: false,
                nav: true
            },
            1200: {
                items: 4,
                dots: false,
                nav: true

            },
        },
    });
});

$(function () {
    // Owl Carousel
    var owl = $(".brands");
    owl.owlCarousel({
        loop: false, // Set to false to prevent items from looping
        margin: 20,
        responsiveClass: true,
        responsive: {
            0: {
                items: 3
            },
            480: {
                items: 4
            },
            768: {
                items: 5
            },
            992: {
                items: 5
            },
            1024: {
                items: 7,
                nav: true,
                dots: false
            },
        },
    });
});


// nav bar js Start


const nav = document.querySelector('header');

window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        nav.classList.add('sticky-fixed');
    } else {
        nav.classList.remove('sticky-fixed');
    }
});

// nav bar js Emd


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

function increaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value++;
    document.getElementById('number').value = value;
}

function decreaseValue() {
    var value = parseInt(document.getElementById('number').value, 10);
    value = isNaN(value) ? 0 : value;
    value < 1 ? value = 1 : '';
    value--;
    document.getElementById('number').value = value;
}

// number increase & decries js End 




