$(document).ready(function(){
var margin =$("#image1").height()/2;
var height=$("#image1").height();
var width=$("#image1").width();
$("#image2").stop().css({height:'0px',width:''+width+'px',marginTop:''+margin+'px',opacity:'0.5'});
$("#reflection2").stop().css({height:'0px',width:''+width+'px',marginTop:''+margin+'px'});
	$("#image1").click(function(){
		$(this).stop().animate({height:'0px',width:''+width+'px',marginTop:''+margin+'px',opacity:'0.5'},{duration:500});
		window.setTimeout(function() {
		$("#image2").stop().animate({height:''+height+'px',width:''+width+'px',marginTop:'0px',opacity:'1'},{duration:500});
		},500);
	});
	$("#image2").click(function(){
		$(this).stop().animate({height:'0px',width:''+width+'px',marginTop:''+margin+'px',opacity:'0.5'},{duration:500});
		window.setTimeout(function() {
		$("#image1").stop().animate({height:''+height+'px',width:''+width+'px',marginTop:'0px',opacity:'1'},{duration:500});
		},500);
	});
});