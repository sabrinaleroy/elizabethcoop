$(document).ready(function(){
	$('.widget .widget_header .widget_title_container .widget-title').html(function(){
		var text= $(this).text().trim().split(" ");
		var first = text.shift();
		return "<strong>"+ first + "</strong> " + text.join(" ");
	});
});