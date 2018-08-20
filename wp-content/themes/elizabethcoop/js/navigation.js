


var $ = jQuery.noConflict();

$( document ).ready(function() {
	
	$(".menu-toggle").click(function (){
		$(".menu-main-menu-container").toggleClass("opened");
		$(this).toggleClass("opened");
		$(this).toggleClass("closed");
		$(this).removeClass("first");
	});
	
	/**** Header ****/
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
    
    /**** Footer ****/
    $(".footer-section .widget_nav_menu div.menu-footer-container.menu-footer-container").append("<div id='magic_line_footer'></div>");
	var $magicLine_footer = $("#magic_line_footer");
    
    var $el_footer, leftPos_footer, newWidth_footer_footer;
    
    if($(".footer-section .widget_nav_menu div.menu-footer-container .menu-item.current-menu-item").length > 0){
	    $magicLine_footer
	        .width($(".footer-section .widget_nav_menu div.menu-footer-container .menu-item.current-menu-item").width())
	        .css("left", $(".footer-section .widget_nav_menu div.menu-footer-container .menu-item.current-menu-item").position().left + 15)
	        .data("origLeft", $magicLine_footer.position().left)
	        .data("origWidth", $magicLine_footer.width());
    }else{
	    $magicLine_footer
	        .data("origLeft", $magicLine_footer.position().left)
	        .data("origWidth", $magicLine_footer.width());
    }
   
        
    $(".footer-section .widget_nav_menu div.menu-footer-container .menu-item").hover(function() {
        $el_footer = $(this);
        leftPos_footer = $el_footer.position().left + 15;
        newWidth_footer = $el_footer.width();
        $magicLine_footer.stop().animate({
            left: leftPos_footer,
            width: newWidth_footer
        });
    }, function() {
        $magicLine_footer.stop().animate({
            left: $magicLine_footer.data("origLeft"),
            width: $magicLine_footer.data("origWidth")
        });    
    });
});
