$('.owl-carousel').owlCarousel({
    dots: false,                    // Leyenda de pagina
    loop:false,                     // Repetir
    autoplay:false,
    autoplayTimeout:1400,
    autoplayHoverPause:true,
    margin: 10,                     // Margen
    nav:true,                       // Navegación
    autoWidth: false,               // Ajustar ancho
    autoHeight: false,               // Ajustar altura
    autoHeightClass: 'owl-height',  // Clase CSS
    autoWidthClass: 'owl-width',    // Clase CSS
    responsiveClass:true,        
    responsive:{
        0:{
            items:1
        },
        600:{
            items:4,
            stagePadding: 1
        },
        1260:{
            items:5,
            stagePadding: 1
        }
    }
});

