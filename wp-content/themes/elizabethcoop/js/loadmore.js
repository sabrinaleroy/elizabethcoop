jQuery(document).ready(function(){

	desturl = "";
	total = 0;
	showing = 0;
	// if there is a navigation get the URL of the "older posts" page
	if($(".navigation .nav-links .nav-previous a").length){
		desturl = $(".navigation .nav-links .nav-previous a").attr('href');
	}
	//number_posts showing total
	if($(".number_posts .total_post").length){
		total = parseInt($(".number_posts .total_post").html());
	} 
	if($(".number_posts .post_showing").length){
		showing = parseInt($(".number_posts .post_showing").html());
	}
	
	$('.load-more-button').click(function(){

		if(desturl!=""){ // if there is a  "older posts" page
			$('.load-more-button').addClass("loading"); // get the button to look like it is loading
			 // ajax call
	        $.ajax({
	            // params
	            url         : desturl,
	            dataType    : 'html',
	            success     : function (data) {
	
	                var obj  = $( data);
	                var grid = obj.find('.grid-list.page').html(); // get the articles in the grid 
	           
	                if(typeof grid !== 'undefined'){ // if there is a grid 
		                var elem = '<div class="next-page next-page-hidden">'+grid+'</div>',
		                     next = obj.find('.navigation .nav-links .nav-previous a');
		
		                if( next.length ) {
		                    desturl = next.attr( 'href' ); // 
		                }
		              
						$('.grid-list.page').append(elem); // add the articles to the page
						
						setTimeout( function(){
							$('.next-page.next-page-hidden').slideToggle(1000, function() {
								$('.next-page').removeClass("next-page-hidden");
								$('.load-more-button').removeClass("loading");
								
								showing = showing + 9;
								if(showing < total){
									$(".number_posts .post_showing").html(showing);
								}else{
									$(".number_posts .post_showing").html(total);
									$('.load-more-button').removeClass("loading");
									$('.load-more-button').hide();
									$('.loadmore-container .no-more').slideToggle();
								}
								
								
							});
							
						}, 1000 );
					}else{ // if there is nothing to load anymore
						$('.load-more-button').removeClass("loading");
						$('.load-more-button').hide();
						$('.loadmore-container .no-more').slideToggle();
					}
					
	            }
	        });
		}
		

		
		
	});
});