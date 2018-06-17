

$(document).ready(function(){
	
	
	var slider_height = $(window).height() - $('header').outerHeight();
	if(slider_height>900){
		slider_height = 900;
	}
	if(slider_height<400){
		slider_height = 400;
	}
	
	var slider_width = slider_height * 1.3;
	
	
	$('.coloured-homepage-section .slider').css('height',slider_height+'px');
	$('.coloured-homepage-section .slider').css('max-width',slider_width+'px');
			$('.slider')
        .on('init', function(event, slick){
            $('.slick-current').prev().addClass('slick-prev');
		    $('.slick-current').next().addClass('slick-next');    
        })
        .on('beforeChange', function(event, slick, currentSlide, nextSlide){
	        
            $('.slick-slide').removeClass('slick-prev');
            $('.slick-slide').removeClass('slick-next');
        })
        .on('afterChange', function(event, slick, currentSlide, nextSlide){
            $('.slick-current').prev().addClass('slick-prev');
		    $('.slick-current').next().addClass('slick-next');
        });
	
		$('.slider').slick({
			centerMode: true,
			infinite: true,
			slidesToShow: 1,
			centerPadding: '60px',
			prevArrow : '<a class="slick-prev slick-arrow">Previous</a>',
			nextArrow : '<a class="slick-next slick-arrow">Next</a>',
			responsive: [
			{
				breakpoint: 580,
				settings: {
					centerMode: false,
					centerPadding: '0px',
				}
			}
			]
		});
		image_height = $('.coloured-homepage-section .slider .slick-current .thumbnail-container').height();
		if(slider_height-image_height > 100){
			$('.coloured-homepage-section .slider').css('height',(image_height+100)+'px');
		}
	
});