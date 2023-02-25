var iOS = navigator.userAgent.match(/iPhone|iPad|iPod/i);
var event = "click";
if (iOS != null)
  event = "touchstart";
$(document).on(event, '.m-header-burger', function () {
  var vid = $(this).attr('data-item');
  if (vid == 0) {
    console.log('1');
    $('.m-menu').addClass('m-menu-open');

    $(this).children('.m-header-burger-icon').removeClass();
    $(this).find('div').addClass('m-header-burger-icon-close');
    $(this).attr('data-item', '1');
    $('body').css({
      'overfloy-y': 'hidden'
    });
  } else {
    console.log('2');
    $('.m-menu').removeClass('m-menu-open');
    $(this).children('.m-header-burger-icon-close').removeClass();
    $(this).find('div').addClass('m-header-burger-icon');
    $(this).attr('data-item', '0');
    $('body').css({
      'overfloy-y': 'auto'
    });
    $('.m-menu-main').removeClass('m-menu-main-transition');
    $('.m-menu-link-one').removeClass('m-menu-link-one-click');
    $('.m-menu-link-one').next('.m-menu-items-two').slideUp(300);
    $('.m-menu-items-one').css({
      'height': 'auto'
    });
    $('.m-menu-dop').css({
      'height': '0'
    });
  }
});
// END кнопка меню для iphone
$('.m-menu-link-one').click(function (event) {
  $('.m-menu-link-one').next('.m-menu-items-two').slideUp(300);
  $('.m-menu-link-one').removeClass('m-menu-link-one-click');
  var link = $(this).attr("href");
  if (link == '') {
    event.preventDefault();
    if ($(this).next('.m-menu-items-two').is(':hidden')) {
      $(this).next('.m-menu-items-two').slideDown(300);
      $(this).addClass('m-menu-link-one-click');
    } else {
      $(this).next('.m-menu-items-two').slideUp(300);
      $(this).removeClass('m-menu-link-one-click');
    }
  }
});
$('.m-menu-link-two').click(function (event) {
  var link_1 = $(this).attr("href");
  var data_1 = $(this).attr("data-item");
  $(".m-menu-items-three").removeClass('m-menu-items-three-open');
  if (link_1 == '') {
    event.preventDefault();
    $('.m-menu-dop').css({
      'height': 'auto'
    });
    $('.m-menu-items-three').fadeOut();
    $('.m-menu-dop-link').text($(this).text());
    $('.m-menu-items-one').css({
      'height': '0'
    });
    $('.m-menu-main').addClass('m-menu-main-transition');
    $(".m-menu-items-three[data-item='" + data_1 + "']").addClass('m-menu-items-three-open');
    $('.m-menu-dop-link').attr('data-item', data_1);
  }
});
$('.m-menu-dop-link').click(function () {
  var item = $(this).attr('data-item');
  $('.m-menu-main').removeClass('m-menu-main-transition');
  $('.m-menu-items-one').css({
    'height': 'auto'
  });
  $('.m-menu-dop').css({
    'height': '0'
  });
});