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


})(jQuery); // End of use strict
