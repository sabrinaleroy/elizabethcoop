


var $ = jQuery.noConflict();

$( document ).ready(function() {
	
	$(".menu-toggle").click(function (){
		$(".menu-main-menu-container").toggleClass("opened");
		$(this).toggleClass("opened");
		$(this).toggleClass("closed");
		$(this).removeClass("first");
	});
	
	
	$(".main-navigation").append("<div id='magic_line'></div>");
	var $magicLine = $("#magic_line");
    
    var $el, leftPos, newWidth;
    
    if($(".main-navigation .menu-item.current-menu-item").length > 0){
	    $magicLine
	        .width($(".main-navigation .menu-item.current-menu-item").width())
	        .css("left", $(".main-navigation .menu-item.current-menu-item").position().left + 15)
	        .data("origLeft", $magicLine.position().left)
	        .data("origWidth", $magicLine.width());
    }else{
	    $magicLine
	        .data("origLeft", $magicLine.position().left)
	        .data("origWidth", $magicLine.width());
    }
   
        
    $(".main-navigation .menu-item").hover(function() {
        $el = $(this);
        leftPos = $el.position().left + 15;
        newWidth = $el.width();
        $magicLine.stop().animate({
            left: leftPos,
            width: newWidth
        });
    }, function() {
        $magicLine.stop().animate({
            left: $magicLine.data("origLeft"),
            width: $magicLine.data("origWidth")
        });    
    });
});
