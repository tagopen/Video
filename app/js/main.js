(function($) {
  "use strict"; // Start of use strict

  // Old browser notification
  $(function() {
    $.reject({
      reject: {
        msie: 10
      },
      imagePath: 'img/icons/jReject/',
      display: [ 'chrome','firefox','safari','opera' ],
      closeCookie: true,
      cookieSettings: {
        expires: 60*60*24*365
      },
      header: 'Ваш браузер устарел!',
      paragraph1: 'Вы пользуетесь устаревшим браузером, который не поддерживает современные веб-стандарты и представляет угрозу вашей безопасности.',
      paragraph2: 'Пожалуйста, установите современный браузер:',
      closeMessage: 'Закрывая это уведомление вы соглашаетесь с тем, что сайт в вашем браузере может отображаться некорректно.',
      closeLink: 'Закрыть это уведомление',
    });
  });

  $(function() {
    $(window).scroll(function () {
      if ($(this).scrollTop() > 200) {
        $('.js-back-to-top').fadeIn()
      } else {
        $('.js-back-to-top').fadeOut()
      }
    });

    $('.js-back-to-top').hide().on("click", function () {
      $('html, body').animate({
        scrollTop: 0
      },
      800);
      return false
    });
  });


  // jQuery.countdown http://hilios.github.io/jQuery.countdown/examples/legacy-style.html
  $('.js-timer').countdown('2017/12/31', function(event) {

    var $this = $(this).html(event.strftime(''
      + '<div class="timer__item"><div class="timer__time">%D</div><div class="timer__text">дней</div></div>'
      + '<div class="timer__item"><div class="timer__time">:</div></div>'
      + '<div class="timer__item"><div class="timer__time">%H</div><div class="timer__text">часов</div></div>'
      + '<div class="timer__item"><div class="timer__time">:</div></div>'
      + '<div class="timer__item"><div class="timer__time">%M</div><div class="timer__text">минут</div></div>'));
  });

  if( $( window ).width() >= 576 ) {

    $('.sv-item__text').matchHeight({
      byRow: true,
      property: 'height',
      target: null,
      remove: false
    });
  };

  $(document).ready(function(){
    // Add minus icon for collapse element which is open by default
    $(".collapse.in").each(function(){
      $(this).siblings(".panel-heading").find(".panel__ic").addClass("minus");
    });
    
    // Toggle plus minus icon on show hide of collapse element
    $(".collapse").on('show.bs.collapse', function(){
      $(this).parent().find(".panel__ic").addClass("minus");
    }).on('hide.bs.collapse', function(){
      $(this).parent().find(".panel__ic").removeClass("minus");
    });
  });


})(jQuery); // End of use strict
