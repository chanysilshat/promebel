$(document).ready(function(){
	$('.m-slider').slick({
	    infinite: true,
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    dots: true,
	    arrows: false,
	    dotsClass: 'slick-dots m-slick-dots'
	});
	var heightReviewsOld = 0;
	setTimeout(function(){
		$('.m-reviews-block').each(function(){
			var heightReviews = $(this).outerHeight();
			if(heightReviews > heightReviewsOld){
				heightReviewsOld = heightReviews;
			}
			$(this).css({'height':heightReviewsOld});
		});
		$('.m-reviews-block').css({'height':heightReviewsOld});
	},500);
	
	$('.m-catal-sl').slick({
	    infinite: true,
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    dots: true,
	    arrows: false,
	    dotsClass: 'slick-dots m-cat-slick-dots'
	});
	
});
$('.m-reviews').on('click','.m-reviews-tab',function(){
	var index = $(this).index();
	$('.m-reviews-tab').removeClass('active');
	$(this).addClass('active');
	$('.m-reviews-block').removeClass('block-active');
	$('.m-reviews-block:eq('+index+')').addClass('block-active');
});
$('.m-catal-tabs').on('click','.m-catal-tab',function(){
	var item = $('.m-catal-tabs').attr('data-item');
	var index = $(this).index();
	$('.m-catal-tab').removeClass('active');
	$(this).addClass('active');
	$('.m-catal-block').removeClass('m-catal-block-active');
	$('.m-catal-block:eq('+index+')').addClass('m-catal-block-active');

	if(index == 1){
		$('.m-catal-tabs').attr('data-item','1');
		if(item == 0){
			$.ajax({
		        type: "POST",
		        url: "/ajax/m-tovar-hit.php",
		        data: 'name='+'2',
		        beforeSend : function(){
		            /*$('.recommend-sl-hit').html('Загрузка...');*/
		        },
		        success: function(response){
		        	$('.m-catal-sl-2').html(response);
		        	$('.m-catal-sl-2').slick({
					    infinite: true,
					    slidesToShow: 1,
					    slidesToScroll: 1,
					    dots: true,
					    arrows: false,
					    dotsClass: 'slick-dots m-cat-slick-dots'
					});
					go_favor();
					go_favor_sr();
					/*heightPanelTovar();*/
		        }
		    });
		}
	}
});
$('.m-slider-btn').on('click',function(){
	var destination = $('#m-previews').offset().top - 46;
    $('html').animate({ scrollTop: destination }, 1100); //1100 - скорость прокрутки
    return false;
});