

function theRotator() {
	//Set the opacity of all images to 0
	$('.topstory_left li').css({opacity: 0.0});
	$('.topstory_right li').css({opacity: 0.0});

	//Get the first image and display it (gets set to full opacity)
	$('.topstory_left li:first').css({opacity: 1.0});
	$('.topstory_right li:first').css({opacity: 1.0});

	//Call the rotator function to run the slideshow, 6000 = change to next image after 6 seconds
	setInterval('rotate("")',5000);

}

function rotate(direction) {

	//Get the first image

	var current = ($('.topstory_left li.show')?  $('.topstory_left li.show') : $('.topstory_left li:first'));
	var current2 = ($('.topstory_right li.show')?  $('.topstory_right li.show') : $('.topstory_right li:first'));

	var current5 = ($('.container_row_topstory_right_thumbnails li.show')?  $('.container_row_topstory_right_thumbnails li.show') : $('.container_row_topstory_right_thumbnails li:first'));

	//Get next image, when it reaches the end, rotate it back to the first image
	var next = ((current.next().length) ? ((current.next().hasClass('show')) ? $('.topstory_left li:first') :current.next()) : $('.topstory_left li:first'));
	var next2 = ((current2.next().length) ? ((current2.next().hasClass('show')) ? $('.topstory_right li:first') :current2.next()) : $('.topstory_right li:first'));

	var next5 = ((current5.next().length) ? ((current5.next().hasClass('show')) ? $('.container_row_topstory_right_thumbnails li:first') :current5.next()) : $('.container_row_topstory_right_thumbnails li:first'));

	//Get next image, when it reaches the end, rotate it back to the first image
	var previous = ((current.prev().length) ? ((current.prev().hasClass('show')) ? $('.topstory_left li:last') :current.prev()) : $('.topstory_left li:last'));
	var previous2 = ((current2.prev().length) ? ((current2.prev().hasClass('show')) ? $('.topstory_right li:last') :current2.prev()) : $('.topstory_right li:last'));

	var previous5 = ((current5.prev().length) ? ((current5.prev().hasClass('show')) ? $('.container_row_topstory_right_thumbnails li:last') :current5.prev()) : $('.container_row_topstory_right_thumbnails li:last'));

	//Set the fade in effect for the next image, the show class has higher z-index
	if(direction=="backwards"){
		previous.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);

		previous2.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);
	}
	else{

		next.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);

		next2.css({opacity: 0.0})
		.addClass('show')
		.animate({opacity: 1.0}, 1000);
	}

	//Hide the current image
	current.animate({opacity: 0.0}, 1000)
	.removeClass('show');

	current2.animate({opacity: 0.0}, 1000)
	.removeClass('show');


	if(currentvalue==1){
		prevvalue = 5;
		nextvalue = currentvalue+1;
	}
	else if(currentvalue==5){
		nextvalue = 1;
		prevvalue = currentvalue-1;
	}
	else{
		prevvalue = currentvalue-1;
		nextvalue = currentvalue+1;
	}

	

};
jQuery(document).ready(function($){ //fire on DOM ready

	var currentvalue = 1;
	var loopvalue = 4;
	
	
	
	$("#article_authorbox_show").click(function(){
		$("#article_authorbox_description1").hide();
		$("#article_authorbox_description2").show();
	});
	
	$("#article_authorbox_hide").click(function(){
		$("#article_authorbox_description1").show();
		$("#article_authorbox_description2").hide();
	});
	
	$(".tab").click(function(){
		var totalid = $(this).closest('div').parent().attr("id");
		var totalidlength = totalid.length;

		var totaltabs = parseInt($(this).closest('div').parent().attr("name").substr(totalidlength,1));

		var thistab_text = $(this).attr("id").substr(totalidlength+1,1);
		var thistab = parseInt($(this).attr("id").substr(totalidlength+1,1));
		$(this).closest('div').parent().removeClass(totalid+'_tabs').removeClass(totalid+'_tabs1').removeClass(totalid+'_tabs2').removeClass(totalid+'_tabs3').addClass(totalid+'_tabs'+thistab);

		if((thistab_text=="n")||(thistab_text=="p")){
			for(i=0;i<totaltabs;i++){
				var i1 = i+1;
				var tabid = "#" + totalid + "_" + i1;
				if($(tabid).hasClass('tab_on')){
					if(thistab_text=="p"){
						if(i1==totaltabs){
							thistab = 1;
						}
						else{
							thistab = i1+1;
						}
					}

					if(thistab_text=="n"){
						if(i1==1){
							thistab = totaltabs;
						}
						else{
							thistab = i1-1;
						}
					}
				}
			}
		}


		for(i=0;i<totaltabs;i++){
			var i1 = i+1;
			var contentid = "#" + totalid + "_content" + i1;
			var tabid = "#" + totalid + "_" + i1;
			$(tabid).removeClass('tab_on');
			if(i1==thistab){
				$(contentid).show();
				$(tabid).addClass('tab_on');
			}
			else{
				$(contentid).hide();
			}
		}

	});

	//arrows
	$("#topstoryarrowleft").click(function(){
		//currentvalue--;
		rotate("backwards");
	});
	$("#topstoryarrowright").click(function(){
		//alert('right');
		//currentvalue++;
		rotate("");
	});

	//Load the slideshow
	if($(".topstory")){
		theRotator();
	}

});
