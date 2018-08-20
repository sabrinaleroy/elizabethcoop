$(document).ready(function(){
	$('.widget .widget_header .widget_title_container .widget-title ,.wp_rp_wrap .related_post_title').html(function(){
		var text= $(this).text().trim().split(" ");
		var first = text.shift();
		return "<strong>"+ first + "</strong> " + text.join(" ");
	});
});