var owl = $('.owl-carousel');
owl.owlCarousel({
    stagePadding: 10,
    dots: false,                    // Leyenda de pagina
    loop:false,                     // Repetir
    autoplay:false,
    autoplayTimeout:1400,
    autoplayHoverPause:true,
    animateOut: 'slideOutDown',     // Animación salida (estilo css)
    animateIn: 'flipInX',           // Animación entrada (estilo css)
    margin: 10,                     // Margen
    nav:true,                       // Navegación
    autoWidth: true,               // Ajustar ancho
    autoHeight: true,               // Ajustar altura
    autoHeightClass: 'owl-height',  // Clase CSS
    autoWidthClass: 'owl-width',    // Clase CSS
    responsiveClass:true,        
    responsive:{
        0:{
            items:1
        },
        960:{
            items:4,
            stagePadding: 1
        },
        1260:{
            items:8,
            stagePadding: 1
        }
    }
});

