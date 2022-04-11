var owl = $('.owl-carousel');
owl.owlCarousel({
    stagePadding: 10,
    dots: false,                    // Leyenda de pagina
    loop:false,                     // Repetir
    autoplay:true,
    autoplayTimeout:2500,
    autoplayHoverPause:true,
    animateOut: 'slideOutDown',     // Animación salida (estilo css)
    animateIn: 'flipInX',           // Animación entrada (estilo css)
    margin: 10,                     // Margen
    nav:true,                       // Navegación
    autoWidth: false,               // Ajustar ancho
    autoHeight: true,               // Ajustar altura
    autoHeightClass: 'owl-height',  // Clase CSS
    autoWidthClass: 'owl-width',    // Clase CSS
    responsiveClass:true,        
    responsive:{
        0:{
            items:1
        },
        960:{
            items:2,
            stagePadding: 10
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