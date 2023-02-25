document.addEventListener("DOMContentLoaded", function(){
	jsReviewPage();
})

function jsReviewPage()
{
	let reviewBtn = document.querySelector(".js__review--btn");
	let formReviewBtn = document.querySelector(".js__review--submit");

	if (reviewBtn){
		reviewBtn.addEventListener("click", function(){
			document.querySelector(".review-form").classList.toggle("active");
		})
	}
	if (formReviewBtn){
		formReviewBtn.addEventListener("click", function(e){

			e.preventDefault();
			let formData = new FormData(document.querySelector(".review-form"));
			let xhr = new XMLHttpRequest();
			xhr.open("POST", "/ajax/reviews-list.php");
			xhr.responseType = 'html';
			xhr.send(formData);

			xhr.onprogress = () => {
				
			}

			xhr.onload = (response) => {
				console.log(xhr.response);
				
				document.querySelector(".review-form-block").innerHTML = '<div class="card-rev-form-mess">Спасибо за отзыв!</div>';
				document.querySelector(".review-result").innerHTML = xhr.response;
				//document.querySelector(".review-result").append(xhr.response)
			}
		})
	}
}

$(document).ready(function(){
	var cat = localStorage.getItem('cat');
	if(cat == null){
		localStorage.setItem('cat', '1');
		$('.catalog-list-main').removeClass('catalog-list-main-line');
	} else {
		if(cat == '1'){
			$('.catalog-list-main').removeClass('catalog-list-main-line');
			$('.catalog-vid-line').removeClass('active');
			$('.catalog-vid-panel').addClass('active');
		} else {
			$('.catalog-list-main').addClass('catalog-list-main-line');
			$('.catalog-vid-line').addClass('active');
			$('.catalog-vid-panel').removeClass('active');
		}
	}
	$('.recommend-panel-slider').slick({
		infinite: false,
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    vertical: false,
	    dots: true,
	    arrows: false,
	});
	$(".recommend-panel-counter .recommend-panel-plus").click(function(){
        let input = $(this).closest('.recommend-panel-counter').find('.recommend-panel-count');
        let inputVal = parseInt(input.text());
        inputVal += 1;
        input.text(inputVal);

		let panelBtn = $(this).closest('.recommend-panel-btn-wrap').find('.recommend-panel-btn');
		panelBtn.attr("data-count", inputVal);
    });
    $(".recommend-panel-counter .recommend-panel-minus").click(function(){
        let input = $(this).closest('.recommend-panel-counter').find('.recommend-panel-count');
        let inputVal = parseInt(input.text());
        if(inputVal > 1){
            inputVal -= 1;
            input.text(inputVal);
        }
		let panelBtn = $(this).closest('.recommend-panel-btn-wrap').find('.recommend-panel-btn');
		panelBtn.attr("data-count", inputVal);
    });
	
	var tab = $('.working-tabs .tabs-items > div > div'); 
	//tab.hide().filter(':first').show(); 
	
	// Клики по вкладкам.
	$('.working .working-tabs .tabs-nav a').click(function(){
		//tab.hide(); 
		//tab.filter(this.hash).show(); 
		/*$('.working-tabs .tabs-item').removeClass('active');
		tab.filter(this.hash).closest(".tabs-item-wrapper").find(".tabs-item").addClass('active');
		$('.working-tabs .tabs-nav a').removeClass('active');
		$(this).addClass('active');*/
		return false;
	});

	/*$('.working-tabs .tabs-nav a').click(function(){
		//tab.hide(); 
		//tab.filter(this.hash).show(); 
		$('.working-tabs .tabs-item').removeClass('active');
		$('.working-tabs .tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();*/


	$('.working-tab-slider').not('.slick-initialized').slick({
			infinite: true,
			slidesToShow: 1,
			slidesToScroll: 1,
			vertical: false,
			dots: true,
			customPaging : function(slider, i) {
		
				let res = document.querySelectorAll(".working .tabs-nav li a");
				
				return '<a>' + res[i].textContent +'</a>'; 
				//return res;
			},
			arrows: true,
			margin: 50,
			prevArrow: '<div class="slider-arrow-up"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 11 17" fill="none"><path d="M10 16L2 8.5L10 0.999999" stroke="#353C68" stroke-width="2"/></svg></div>',
			nextArrow: '<div class="slider-arrow-down"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 11 17" fill="none"><path d="M1 1L9 8.5L1 16" stroke="#353C68" stroke-width="2"/></svg></div>'
		});

	$('.slider').slick({
	    infinite: true,
	    slidesToShow: 1,
	    slidesToScroll: 1,
	    vertical: false,
	    dots: false,
	    arrows: true,
	    prevArrow: '<div class="slider-arrow-up"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 11 17" fill="none"><path d="M10 16L2 8.5L10 0.999999" stroke="white" stroke-width="2"/></svg></svg></div>',
		nextArrow: '<div class="slider-arrow-down"><svg xmlns="http://www.w3.org/2000/svg" width="11" height="17" viewBox="0 0 11 17" fill="none"><path d="M1 1L9 8.5L1 16" stroke="white" stroke-width="2"/></svg></div>'
	});
	currentSlide = $('.slider').slick('slickCurrentSlide') + 1;
	if(currentSlide < 10){
		currentSlide = '0'+currentSlide;
	}
	$('.slider-count').text(currentSlide);

	$(".slider").on("afterChange", function(event, slick, currentSlide, nextSlide){
		currentSlide1 = currentSlide + 1;
		if(currentSlide1 < 10){
			currentSlide1 = '0'+currentSlide1;
		}
		$('.slider-count').text(currentSlide1);
	});
	$('.recommend-sl').slick({
	    infinite: false,
	    slidesToShow: 4,
	    slidesToScroll: 1,
	    dots: false,
	    arrows: true,
	    prevArrow: '<div class="recommend-prev"><svg width="19" height="32"><use xlink:href="#recommend-prev"></use></svg></div>',
		nextArrow: '<div class="recommend-next"><svg width="20" height="32"><use xlink:href="#recommend-next"></use></svg></div>',
		responsive: [
			{
		      breakpoint: 1050,
		      settings: {
		        slidesToShow: 3
		      }
		    },
		    {
		      breakpoint: 991,
		      settings: {
		        slidesToShow: 2
		      }
		    }/*,
		    {
		      breakpoint: 600,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }*/
		  ]
	});
	heightPanelTovar();
});	
function heightPanelTovar(){
	var heightPanelOld = 0;
	$('.recommend-panel').each(function(){
		var heightPanel = $(this).height();
		if(heightPanel > heightPanelOld){
			heightPanelOld = heightPanel;
		}
		//$(this).css({'height':heightPanelOld});
	});
}
$('.scroll-top').click(function () {
    $('body,html').animate({
        scrollTop: 0
    }, 800);
    return false;
});
$(window).scroll(function () {
    var top1 = 150;
    if($(window).width() <= 767){
        top1 = 10;
    }
    if ($(this).scrollTop() > top1) {
        $('.scroll-top').addClass('scroll-top-visible');
    } else {
        $('.scroll-top').removeClass('scroll-top-visible');
    }
});
$('.header-burger').on('click',function(){
	$('.menu-mob').addClass('menu-mob-visible');
	$('body').css({'overflow-y':'hidden'});
});
$('.menu-mob-close').on('click',function(){
	$('.menu-mob').removeClass('menu-mob-visible');
	$('body').css({'overflow-y':'auto'});
});
$('.catalog-vid').on('click','.catalog-vid-line',function(){
	$(this).addClass('active');
	$('.catalog-vid-panel').removeClass('active');
	$('.catalog-list-main').addClass('catalog-list-main-line');
	localStorage.setItem('cat', '2');
});
$('.catalog-vid').on('click','.catalog-vid-panel',function(){
	$(this).addClass('active');
	$('.catalog-vid-line').removeClass('active');
	$('.catalog-list-main').removeClass('catalog-list-main-line');
	localStorage.setItem('cat', '1');
});
$('.card-form').on('click', '.card-down', function(){
	var count = $('.card-num').val();
	if(count > 1){
		count--;
		$('.card-num').val(count);
	}
});
$('.card-form').on('click', '.card-up', function(){
	var count = $('.card-num').val();
	if(count < 20){
		count++;
		$('.card-num').val(count);
	}
});
$('.card-tabs').on('click', '.card-tab', function(){
	$('.card-tab').removeClass('active');
	$(this).addClass('active');
	var index = $(this).index();
	$('.card-block').removeClass('card-block-active');
	$('.card-block-'+index).addClass('card-block-active');
});
$('.card-rev-btn').on('click',function(){
	if($('.card-rev-form').is(':hidden')){
		$('.card-rev-form').addClass('card-rev-form-visible');
		$(this).text('Закрыть');
	} else {
		$('.card-rev-form').removeClass('card-rev-form-visible');
		$(this).text('Написать отзыв');
	}
});
$('.cat-sort').on('click','.cat-sort-text',function(){
	$('.cat-sort-select').slideDown(300);
	setTimeout(function(){
		$('.cat-sort-select-close').fadeIn(300);
	},300);
});
$('.cat-sort-select').on('click','.cat-sort-select-close',function(){
	
	$('.cat-sort-select-close').fadeOut(300);
	setTimeout(function(){
		$('.cat-sort-select').slideUp(300);
	},300);
});
function reviesSend(id_tovar,name_tovar){
	err = 0;
	t1 = $('#card-rev-fio').val();
	t2 = $('#card-rev-text').val();
	if(t1==''){
		$('#card-rev-fio').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#card-rev-fio').css({'border':'1px solid green'});
	}
	if(t2==''){
		$('#card-rev-text').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#card-rev-text').css({'border':'1px solid green'});
	}
	if(err == '0'){
		$.ajax({
            type: "POST",
            url: "/ajax/revies-send.php",
            data: 'name='+$('#card-rev-fio').val()+'&text='+$('#card-rev-text').val()+'&id_tovar='+id_tovar+'&name_tovar='+name_tovar,
            beforeSend : function(){
                $('.card-rev-form-btn').html('Отправка ...');
            },
            success: function(response){
            	$('.card-rev-form-btn').html('Отправить');
            	$('.card-rev-form').html(response);
            	$('.card-rev-btn').remove();
                /*$('.popup-form').html(response);*/
				getReviews(id_tovar);
            }
        });
	}
}

function getReviews(id_tovar){
	$.ajax({
		type: "POST",
		url: "/ajax/get-reviews.php",
		data: 'id_tovar='+id_tovar,
		beforeSend : function(){
			$('.card-rev-form-btn').html('Отправка ...');
		},
		success: function(response){
	
			$('.card-rev-main').html(response);
		}
	});
}
function otziviSend(){
	err = 0;
	t1 = $('#otzivi-rev-fio').val();
	t2 = $('#otzivi-rev-text').val();
	if(t1==''){
		$('#otzivi-rev-fio').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#otzivi-rev-fio').css({'border':'1px solid green'});
	}
	if(t2==''){
		$('#otzivi-rev-text').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#otzivi-rev-text').css({'border':'1px solid green'});
	}
	if(err == '0'){
		$.ajax({
            type: "POST",
            url: "/ajax/otzivi-send.php",
            data: 'name='+$('#otzivi-rev-fio').val()+'&text='+$('#otzivi-rev-text').val(),
            beforeSend : function(){
                $('.otzivi-rev-form-btn').html('Отправка ...');
            },
            success: function(response){
            	$('.otzivi-rev-form-btn').html('Отправить');
            	$('.card-rev-form').html(response);
            	$('.card-rev-btn').remove();
                /*$('.popup-form').html(response);*/
            }
        });
	}
}
function add2dop(pp_id,name,dpu){
	if ($('#tovar-id-catalog').val() !== '') {
		p = $('#tovar-new-price-catalog').val();
		tovar_count = $('#tovar_count').val();
		p_id = $('#tovar-id-catalog').val();
		$.ajax({
			type: "POST",
			url: "/ajax/add2dop.php",
			data: "p_id=" + p_id + "&pp_id=" + pp_id + "&p=" + p + "&p_c=" + tovar_count + "&name=" + name + "&dpu=" + dpu,
			beforeSend: function(html){  
                /*$('.card-basket').html('Отправка...');
                $('.recommend-panel-btn').text('Отправка...');*/
            },
			success: function(response){
				/*$('.card-basket').html('В корзину');*/
				/*$('.recommend-panel-btn').text('В корзину');*/
				$('.popup-basket').addClass('popup-basket-visible');
				$('.fixed-basket-val').text('+'+response);
			}
		});
	} else {
		/*$('.block-catalog-text__size-block_mess').css({'display':'flex'});*/
	}
}
function add2(pp_id,name,dpu,id_tovar,count,price){
	//pp_id 
	//name - Название товара
	//dpu - хз
	// id_tovar - id элемента
	//count - количество 
	//price - это цена
	if (id_tovar !== '') {
		p = price;
		if (count.hasAttribute("data-count")){
			tovar_count = count.getAttribute("data-count");
		} else {
			tovar_count = 1;
		}
		console.log(tovar_count)
		p_id = id_tovar;
		$.ajax({
			type: "POST",
			url: "/ajax/add2dop.php",
			data: "p_id=" + p_id + "&pp_id=" + pp_id + "&p=" + p + "&p_c=" + tovar_count + "&name=" + name + "&dpu=" + dpu,
			beforeSend: function(html){  
                /*$('.card-basket').html('Отправка...');
                $('.recommend-panel-btn').text('Отправка...');*/
            },
			success: function(response){
				/*$('.card-basket').html('В корзину');
				$('.recommend-panel-btn').text('В корзину');*/
				$('.popup-basket').addClass('popup-basket-visible');
				$('.fixed-basket-val').text('+'+response);
			}
		});
	} else {
		/*$('.block-catalog-text__size-block_mess').css({'display':'flex'});*/
	}
}
$('.popup-basket').on('click', '.popup-basket-js', function(){
	$('.popup-basket').removeClass('popup-basket-visible');
});
function fosPopup(tema,title,metrika){
	$('.popup-form').addClass('popup-form-visible');
	$('.popup-form-title').text(title);
	$('#form-metrika').val(metrika);
	$('#form-tema').val(tema);
}
$('.popup-form').on('click', '.popup-form-close', function(){
	$('.popup-form').removeClass('popup-form-visible');
});
$('.popup-basket').on('click', '.popup-basket-close', function(){
	$('.popup-basket').removeClass('popup-basket-visible');
});
$('.popup-tovar').on('click',function(event){
	if ( !$(event.target).children('.popup-tovar-main').length ) {
		return;
	}
	$('.popup-tovar').removeClass('popup-tovar-visible');
});
$('.popup-form').on('click',function(event){
	if ( !$(event.target).children('.popup-form-main').length ) {
		return;
	}
	$('.popup-form').removeClass('popup-form-visible');
});
$('.popup-basket').on('click',function(event){
	if ( !$(event.target).children('.popup-main').length ) {
		return;
	}
	$('.popup-basket').removeClass('popup-basket-visible');
});
function fosTovar(tema,title,metrika,name,price){
	$('.popup-tovar').addClass('popup-tovar-visible');
	$('.popup-tovar-title').text(title);
	$('#form-tovar-metrika').val(metrika);
	$('#form-tovar-tema').val(tema);
	$('#form-tovar-val').val(name);
	$('#form-tovar-price').val(price);
	$('#form-tovar-count').val($('#tovar_count').val());
}
$('.popup-tovar').on('click', '.popup-tovar-close', function(){
	$('.popup-tovar').removeClass('popup-tovar-visible');
});
$("#cons-phone").mask("+7 (999) 999-9999");
$("#form-phone").mask("+7 (999) 999-9999");
$("#form-tovar-phone").mask("+7 (999) 999-9999");
$("#soa-property-2").mask("+7 (999) 999-9999");
function fos(tema,metrika){
	err = 0;
	t1 = $('#cons-name').val();
	t2 = $('#cons-phone').val();
	page = $('#cons-page').val();
	if(t1==''){
		$('#cons-name').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#cons-name').css({'border':'1px solid green'});
	}
	if(t2==''){
		$('#cons-phone').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#cons-phone').css({'border':'1px solid green'});
	}
	if(err == '0'){
		$.ajax({
            type: "POST",
            url: "/ajax/form/send.php",
            data: 'name='+$('#cons-name').val()+'&phone='+$('#cons-phone').val()+'&page='+page+'&tema='+tema,
            beforeSend : function(){
                $('.consultation-btn').html('Отправка ...');
            },
            success: function(response){
            	$('.consultation-btn').html('Отправить');
            	$('.consultation-info').html(response);
            	$('.consultation-img').addClass('consultation-img-hidden');
            }
        });
	}
}
function fosPopupSend(){
	err = 0;
	t1 = $('#form-name').val();
	t2 = $('#form-phone').val();
	page = $('#form-page').val();
	metrika = $('#form-metrika').val();
	tema = $('#form-tema').val();
	if(t1==''){
		$('#form-name').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#form-name').css({'border':'1px solid green'});
	}
	if(t2==''){
		$('#form-phone').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#form-phone').css({'border':'1px solid green'});
	}
	if(err == '0'){
		$.ajax({
            type: "POST",
            url: "/ajax/form/popup-send.php",
            data: 'name='+$('#form-name').val()+'&phone='+$('#form-phone').val()+'&text='+$('#form-text').val()+'&page='+page+'&tema='+tema,
            beforeSend : function(){
                $('.popup-form-btn').html('Отправка ...');
            },
            success: function(response){
            	$('.popup-form-btn').html('Отправить');
            	$('.popup-form-block').html(response);
            }
        });
	}
}
function fosTovarSend(){
	err = 0;
	t1 = $('#form-tovar-name').val();
	t2 = $('#form-tovar-phone').val();
	page = $('#form-tovar-page').val();
	metrika = $('#form-tovar-metrika').val();
	tema = $('#form-tovar-tema').val();
	val = $('#form-tovar-val').val();
	price = $('#form-tovar-price').val();
	count = $('#form-tovar-count').val();
	if(t1==''){
		$('#form-tovar-name').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#form-tovar-name').css({'border':'1px solid green'});
	}
	if(t2==''){
		$('#form-tovar-phone').css({'border':'1px solid #f00'});
		err = 1;
	} else {
		$('#form-tovar-phone').css({'border':'1px solid green'});
	}
	if(err == '0'){
		$.ajax({
            type: "POST",
            url: "/ajax/form/popup-tovar-send.php",
            data: 'name='+$('#form-tovar-name').val()+'&phone='+$('#form-tovar-phone').val()+'&text='+$('#form-tovar-text').val()+'&page='+page+'&tema='+tema+'&val='+val+'&price='+price+'&count='+count,
            beforeSend : function(){
                $('.popup-tovar-btn').html('Отправка ...');
            },
            success: function(response){
            	$('.popup-tovar-btn').html('Отправить');
            	$('.popup-tovar-block').html(response);
            }
        });
	}
}
/*Корзина*/
/*$('#bx-soa-properties').find('.btn').val('ЗАГРУЗИТЬ ФАЙЛ');*/
$(document).ready(function () {
	$('#bx-soa-properties').find('.btn').val('ЗАГРУЗИТЬ ФАЙЛ');
});
/*избранное*/
$(document).ready(function () {
    go_favor();
});
// Добавляем
function sravn(x){
    str = localStorage.getItem('sravn');
    if (str) {
        arr = str.split(',');

        t = $.inArray(x, arr);

        x = x + '';
        if ($.inArray(x, arr) == -1) {
            str = str + ',' + x;
            localStorage.setItem('sravn', str);
            $('.sravn-' + x).addClass('sravn-active');
           
            go_favor();

        } else {
            remove_izbr(x);

        }
    } else {
        localStorage.setItem('sravn', x);
        $('.sravn-' + x).addClass('sravn-active');

        go_favor();
    }
}
// Удаляем
function remove_izbr(x) {
    if ($('*').is('.str-' + x)) {
        $('.str' + x).remove();
    } else {

    }

    $('.sravn-' + x).removeClass('sravn-active');
    var cur = localStorage.getItem('sravn');
    arr = cur.split(',');
    arr.forEach(function (item, i, arr) {
        if (item == x) {
            arr.splice(i, 1);
        }
    });
    var cur_new = "";
    if (arr.length > 0) {
        arr.forEach(function (item, i, arr) {
            if (cur_new == '') {
                cur_new = cur_new + item;
            } else {
                cur_new = cur_new + ',' + item;
            }

        });
    }
    if (cur_new == ",") {
        cur_new = "";
    }
    localStorage.setItem('sravn', cur_new);
    var cur2 = localStorage.getItem('sravn');

    if (cur_new) {
        go_favor();
    }else{
        go_favor();
    }
}
// Кол-во и вывод добавленных
function go_favor(){
    str = localStorage.getItem('sravn');
    kol = 0;
    if (str) {
        arr = str.split(',');
        len = arr.length;

        $.each(arr, function (index, value) {
            x = value.toString();
            $('.sravn-' + x).addClass('sravn-active');
        });

        kol = kol + len;
    }
    if(kol != 0){
    	$('.fixed-izbr-val').text('+'+kol);
        /*$('.comparison-nav-count').addClass('comparison-nav-count-visible');
        $('.comparison-nav-count').text(kol);*/
    } else {
    	$('.fixed-izbr-val').text('+'+kol);
        /*$('.comparison-nav-count').removeClass('comparison-nav-count-visible');*/
    }
}
// Вывод в избранное
function showCompare(str){
	console.log('da');
    $.ajax({
        type: "POST",
        url: "/ajax/sravnenie-tovarov.php",
        data: 'mass=' + str,
        beforeSend: function(){
             
        },
        success: function(data){
            /*$('.compare-main').slick('unslick');*/
            $('.compare-main').html(data);
            go_favor();

        }
    });
}
$(document).ready(function () {
    str = localStorage.getItem('sravn');
    console.log(str);
    if(str == null || str == ''){
        $('.compare-main').html('<div class="compare-main-mess">Нет товаров в избранном. Перейти в <a href="/catalog/">Каталог</a></div>');
    } else {
        showCompare(str);
    }
});
// Удаление из избранного 1 товара
function sravnDel(x){
    str = localStorage.getItem('sravn');
    remove_izbr(x);
    if(str == null || str == ''){
    	$('.compare-main').html('<div class="compare-main-mess">Нет товаров в избранном. Перейти в <a href="/catalog/">Каталог</a></div>');
    } else {
    	showCompare(str);
    }
}
// Сравнение
$(document).ready(function () {
    go_favor_sr();
});
// Добавляем
function sr(x){
    str = localStorage.getItem('sr');
    if (str) {
        arr = str.split(',');

        t = $.inArray(x, arr);

        x = x + '';
        if ($.inArray(x, arr) == -1) {
            str = str + ',' + x;
            localStorage.setItem('sr', str);
            $('.sr-' + x).addClass('sr-active');
           
            go_favor_sr();

        } else {
            remove_sr(x);

        }
    } else {
        localStorage.setItem('sr', x);
        $('.sr-' + x).addClass('sr-active');

        go_favor_sr();
    }
}
// Удаляем
function remove_sr(x) {
    if ($('*').is('.str-' + x)) {
        $('.str' + x).remove();
    } else {

    }

    $('.sr-' + x).removeClass('sr-active');
    var cur = localStorage.getItem('sr');
    arr = cur.split(',');
    arr.forEach(function (item, i, arr) {
        if (item == x) {
            arr.splice(i, 1);
        }
    });
    var cur_new = "";
    if (arr.length > 0) {
        arr.forEach(function (item, i, arr) {
            if (cur_new == '') {
                cur_new = cur_new + item;
            } else {
                cur_new = cur_new + ',' + item;
            }

        });
    }
    if (cur_new == ",") {
        cur_new = "";
    }
    localStorage.setItem('sr', cur_new);
    var cur2 = localStorage.getItem('sr');

    if (cur_new) {
        go_favor_sr();
    }else{
        go_favor_sr();
    }
}
// Кол-во и вывод добавленных
function go_favor_sr(){
    str = localStorage.getItem('sr');
    kol = 0;
    if (str) {
        arr = str.split(',');
        len = arr.length;

        $.each(arr, function (index, value) {
            x = value.toString();
            $('.sr-' + x).addClass('sr-active');
        });

        kol = kol + len;
    }
    if(kol != 0){
    	$('.fixed-sravn-val').text('+'+kol);
    } else {
    	$('.fixed-sravn-val').text('+'+kol);
    }
}
// Поиск разных свойств
function srDifferent(){
    var length_item = $('.sr-panel').length;
    var count_str_harakt_old = $('.sr-harac').length;
    var count_str_harakt = count_str_harakt_old / length_item;
    for(j = 0; j <= count_str_harakt-1; j++){
        var stDef = '';
        var st = 0;
        var mass = [];
        $('.sr-item-'+j).children('.sr-harac-val').each(function(index){
            mass.push($(this).text());
        });
        for(var i = 0; i <= length_item-1; i++){
            if(i == 0){
                stDef = mass[i];
            } else {
                if(stDef != mass[i]){
                    st = 1;
                }
            }
        }
        if(st == 1){
            $('.sr-item-'+j).children('.sr-harac-val').addClass('sr-text-red');
        }
    }    
}
// Вывод в сравнении
function showSr(str){
	console.log('da');
    $.ajax({
        type: "POST",
        url: "/ajax/sr-tovarov.php",
        data: 'mass=' + str,
        beforeSend: function(){
             
        },
        success: function(data){
        	var slid = $('.sr-main').attr('data-slider');
        	if(slid != 0){
        		$('.sr-main').slick('unslick');
        		$('.sr-main').attr('data-slider','1');
        	}
            /*$('.compare-main').slick('unslick');*/
            $('.sr-main').html(data);
            $('.sr-main').slick({
			    infinite: true,
			    slidesToShow: 4,
			    slidesToScroll: 1,
			    dots: false,
			    arrows: true,
			    prevArrow: '<div class="recommend-prev"><svg width="19" height="32"><use xlink:href="#recommend-prev"></use></svg></div>',
				nextArrow: '<div class="recommend-next"><svg width="20" height="32"><use xlink:href="#recommend-next"></use></svg></div>',
				responsive: [
				    {
				      breakpoint: 991,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 1,
				        arrows: false
				      }
				    }/*,
				    {
				      breakpoint: 600,
				      settings: {
				        slidesToShow: 2,
				        slidesToScroll: 2
				      }
				    },
				    {
				      breakpoint: 480,
				      settings: {
				        slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }*/
				  ]
			});
			var height_sl = 0;
			var height_sr = 0;
            setTimeout(function(){
                for (var i = 0; i <= 9; i++) {
                    var height_info_panel = 0;
                    $('.sr-harac-block .sr-item-'+i+' .sr-harac-val').each(function(){
                        if($(this).innerHeight() > height_info_panel){
                            height_info_panel = $(this).innerHeight();
                        }
                    });
                    $('.sr-harac-block .sr-item-'+i+' .sr-harac-val').css({'height':height_info_panel});
                }
                $('.sr-main .recommend-panel-info').each(function(){
                    if($(this).innerHeight() > height_sr){
                        height_sr = $(this).innerHeight();
                    }
                    console.log('i222='+$(this).innerHeight());
                });
                $('.sr-main .recommend-panel-info').css({'height':height_sr});
                console.log('itog='+height_sr);
            },500);
            srDifferent();
            go_favor_sr();
            go_favor();

        }
    });
}
$(document).ready(function () {
    str = localStorage.getItem('sr');
    console.log(str);
    if(str == null || str == ''){
        $('.sr-main').html('<div class="compare-main-mess">Нет товаров в сравнении. Перейти в <a href="/catalog/">Каталог</a></div>');
    } else {
        showSr(str);
    }
});
// Удаление из сравнения 1 товара
function srDel(x){
    str = localStorage.getItem('sr');
    remove_sr(x);
    if(str == null || str == ''){
    	$('.sr-main').html('<div class="compare-main-mess">Нет товаров в сравнении. Перейти в <a href="/catalog/">Каталог</a></div>');
    } else {
    	$('.sr-main').attr('data-slider','1');
    	showSr(str);
    }
}
/* ---------------- */
$('.recommend-block').on('click','.recommend-tab',function(){
	var item = $('.recommend-tabs').attr('data-item');
	var index = $(this).index();
	$('.recommend-tab').removeClass('active');
	$(this).addClass('active');
	if(index == 1){
		$('.recommend-sl').hide();
		$('.recommend-sl-hit').show();
		$('.recommend-tabs').attr('data-item','1');
		if(item == 0){
			$.ajax({
	            type: "POST",
	            url: "/ajax/tovar-hit.php",
	            data: 'name='+'2',
	            beforeSend : function(){
	                $('.recommend-sl-hit').html('Загрузка...');
	            },
	            success: function(response){
	            	$('.recommend-sl-hit').html(response);
	            	$('.recommend-sl-hit').slick({
					    infinite: false,
					    slidesToShow: 4,
					    slidesToScroll: 1,
					    dots: false,
					    arrows: true,
					    focusOnSelect: false,
					    prevArrow: '<div class="recommend-prev"><svg width="19" height="32"><use xlink:href="#recommend-prev"></use></svg></div>',
						nextArrow: '<div class="recommend-next"><svg width="20" height="32"><use xlink:href="#recommend-next"></use></svg></div>',
						responsive: [
							{
							  breakpoint: 1050,
							  settings: {
								slidesToShow: 3
							  }
							},
						    {
						      breakpoint: 991,
						      settings: {
						        slidesToShow: 2
						      }
						    }
						]
					});
					$(".recommend-sl-hit .recommend-panel-counter .recommend-panel-plus").click(function(){
						let input = $(this).closest('.recommend-panel-counter').find('.recommend-panel-count');
						let inputVal = parseInt(input.text());
						inputVal += 1;
						input.text(inputVal);
						let panelBtn = $(this).closest('.recommend-panel-btn-wrap').find('.recommend-panel-btn');
						panelBtn.attr("data-count", inputVal);
					});
					$(".recommend-sl-hit .recommend-panel-counter .recommend-panel-minus").click(function(){
						let input = $(this).closest('.recommend-panel-counter').find('.recommend-panel-count');
						let inputVal = parseInt(input.text());
						if(inputVal > 1){
							inputVal -= 1;
							input.text(inputVal);
						}
						let panelBtn = $(this).closest('.recommend-panel-btn-wrap').find('.recommend-panel-btn');
						panelBtn.attr("data-count", inputVal);
					});
					$('.recommend-panel-slider-hit').slick({
						infinite: true,
						slidesToShow: 1,
						slidesToScroll: 1,
						vertical: false,
						dots: true,
						arrows: false,
					});
					go_favor();
					go_favor_sr();
					heightPanelTovar();
	            }
	        });
		}
	}
	if(index == 0){
		$('.recommend-sl-hit').hide();
		$('.recommend-sl').show();
	}
});





$(function(){

	$('.catalog-menu-mobile-title').on('click', function(e){
		e.preventDefault();

		$(this).toggleClass('mobile-active');

		$('.catalog-menu-mobile-menu').slideToggle(300);
		

	});

});