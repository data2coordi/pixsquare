$(function() {
  $("#js-pagetop").click(function() {
    $('html, body').animate({
      scrollTop: 0
    }, 300);
  });

  $(window).scroll(function() {
    if ($(window).scrollTop() > 1) {
      $('#js-pagetop').fadeIn(300).css('display', 'flex');
    } else {
      $('#js-pagetop').fadeOut(300);
    }
  });
});