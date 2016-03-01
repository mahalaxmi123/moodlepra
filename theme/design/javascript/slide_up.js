$(document).ready(function(){
	alert("laxmi is everywhere");
    $(".content .coursetitle").hover(function(){
        $(".summary-box p").slideUp("slow");
		$(".summary-box p").css("display", "block");
    });

 $(".summary-box p").mouseout(function(){
        $(".summary-box p").slideDown("slow");
    });
});