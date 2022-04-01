var owl = $('.owl-carousel');
owl.owlCarousel({
    stagePadding: 20,
    dots: false,
    loop:false,
    margin: 10,
    nav:true,
    autoWidth: false,
    autoHeight: false,
    autoHeightClass: 'owl-height',
    autoWidthClass: 'owl-width',
    responsive:{
        0:{
            items:1
        },
        300:{
            items: 1,
            margin: 10,
            stagePadding: 50
        },
        440:{
            items:2,
            margin: 10,
            stagePadding: 50
        },
        600:{
            items:2,
            stagePadding: 40
            //margin: 8
        },
        700:{
            items:3,
            stagePadding: 40
            //margin: 8
        },
        800:{
            items:4,
            stagePadding: 20
            //margin: 8
        },
        960:{
            items:5,
            stagePadding: 20
        }
    }
});

owl.on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY>0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});