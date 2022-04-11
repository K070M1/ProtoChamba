$(document).ready(function(){
	$(".owl-carousel").owlCarousel({
	  loop:true,
	  margin:50,
	  nav:true,
	  default : 3,
	  /* autoplay:true,
	  autoplayTimeout:3000,
	  autoplayHoverPause:true, */
	  center: true,
	  navText: [
		  "<i class='fa fa-angle-left'></i>",
		  "<i class='fa fa-angle-right'></i>"
	  ],
	  responsiveClass:true,
	  responsive:{
		  600:{
			  items:1
					
		  },
		  900:{
			  items:2
		  },
		  1290:{
			  items:3
		  }
	  }
	});
  });