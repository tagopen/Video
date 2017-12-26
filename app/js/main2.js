
(function($,sr){

  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
    var timeout;

    return function debounced () {
      var obj = this, args = arguments;
      function delayed () {
        if (!execAsap)
          func.apply(obj, args);
        timeout = null;
      };

      if (timeout)
        clearTimeout(timeout);
      else if (execAsap)
        func.apply(obj, args);

      timeout = setTimeout(delayed, threshold || 100);
    };
  }
  // smartresize
  jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');

// ================================================================================== //

  // # Document on Ready
  // # Document on Resize
  // # Document on Scroll
  // # Document on Load

  // # Old browser notification
  // # 

// ================================================================================== //


var GRVE = GRVE || {};

(function($){

  "use strict";

  // # Document on Ready
  // ============================================================================= //
  GRVE.documentReady = {
    init: function() {
      GRVE.outlineJS.init();
      GRVE.jReject.init();
      GRVE.select2.init();
      GRVE.matchHeight.init();
      GRVE.maskPhone.init();
      GRVE.anchorScroll.init('a.js-scroll-trigger[href*="#"]:not([href="#"])');
      GRVE.promo.init();
      GRVE.cookie.init();
      //GRVE.tabs.init();
      GRVE.facebook.init();
      GRVE.reviews.init();
      GRVE.pageSettings.init();
      GRVE.basicElements.init();
      GRVE.cropper.init();
    }
  };

  // # Document on Resize
  // ============================================================================= //
  GRVE.documentResize = {
    init: function() {
      GRVE.matchHeight.init();

    }
  };

  // # Document on Scroll
  // ============================================================================= //
  GRVE.documentScroll = {
    init: function() {

    }
  };

  // # Document on Load
  // ============================================================================= //
  GRVE.documentLoad = {
    init: function() {
      GRVE.wowjs.init();

    }
  };

  // # Old browser notification
  // ============================================================================= //
  GRVE.jReject = {
    init : function() {
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
    }
  };


  // # Check window size
  // ============================================================================= //
  GRVE.isWindowSize = {
    init: function(min = undefined, max = undefined) {
      var media;

      if (min !== undefined && max !== undefined) {
        media = matchMedia('only screen and (min-width: ' + min + 'px) and (max-width: ' + max + 'px)');
      } else if (min !== undefined && max === undefined) {
        media = matchMedia('only screen and (min-width: ' + min + 'px)');
      } else if (min === undefined && max !== undefined) {
        media = matchMedia('only screen and (max-width: ' + max + 'px)');
      } else {
        return true;
      }

      return media.matches;

    }
  };

  // # Remove outline on focus
  // ============================================================================= //
  GRVE.outlineJS = {
    init: function() {
      var self =             this;

      this.styleElement =    document.createElement('STYLE'),
      this.domEvents =       'addEventListener' in document;

      document.getElementsByTagName('HEAD')[0].appendChild(this.styleElement);

      // Using mousedown instead of mouseover, so that previously focused elements don't lose focus ring on mouse move
      this.eventListner('mousedown', function() {
        self.setCss(':focus{outline:0 !important;}');
      });

      this.eventListner('keydown', function() {
        self.setCss('');
      });
    },
    setCss: function(css_text) {
      // Handle setting of <style> element contents in IE8
      !!this.styleElement.styleSheet ? this.styleElement.styleSheet.cssText = css_text : this.styleElement.innerHTML = css_text;
    },
    eventListner: function(type, callback) {
      // Basic cross-browser event handling
      if (this.domEvents) {
        document.addEventListener(type, callback);
      } else {
        document.attachEvent('on' + type, callback);
      }
    }
  };

  // # Equial Height
  // ============================================================================= //
  GRVE.matchHeight = {
    init: function() {
      this.matchHeight('.sv-item__text', 576);
    },
    matchHeight: function(selector, min, max) {
      var $selector  = $(selector);
      var options    = {
        byRow: true,
        property: 'height',
        target: null,
        remove: false
      }

      
      if (!$selector.length) { return; }

      if (GRVE.isWindowSize.init(min, max)) {
          $selector.matchHeight(options);
      }
    }
  }

  // # Anchor scrolling effect
  // ============================================================================= //
  GRVE.anchorScroll = {
    init: function(selector) {
      var $selector = $(selector);

      if (!$selector.length) { return; }

      $selector.on('click', function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: (target.offset().top +3)
            }, 1000,);
            return false;
          }
        }
      });
    }
  };

  // # Select2
  // ============================================================================= //
  GRVE.select2 = {
    init: function() {
      this.language =     'ru';
      this.$selector =    $('[data-select]');

      if (!this.$selector.length) { return; }

      this.localization();
      this.selectInit();

    },
    setOptions: function($item) {
      var options =            {};
      var search =             $item.data('select-search') == true ? true : false;

      options.placeholder =    "--Select something (default placeholder)--";
      options.width =          "resolve";
      options.language =       this.language;

      if (!search) {
        options.minimumResultsForSearch = Infinity;
      }

      options.sortResults = function(results, container, query) {
        if (query.term) {
          // use the built in javascript sort function
          return results.sort();
        }
        return results;
      };

      return options;

    },
    selectInit: function() {
      var self = this;

      this.$selector.each(function() {
        var $item =        $(this);
        var options =      self.setOptions($item);

        $item.select2(options);
      });

      $('.select2-selection__arrow').html('<svg class="svg svg--arrow-down select2-selection__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img"><use xlink:href="img/sprite.svg#arrow-down"></use></svg>');
  
    },
    localization: function() {
      if (this.language !== 'ru') {
        return;
      }

      if ($.fn.select2) {
        $.fn.select2.amd.define('select2/i18n/ru', [], function() {
          // Russian
          return {
            errorLoading: function() {
              return 'Результат не может быть загружен.';
            },
            inputTooLong: function(args) {
              var overChars = args.input.length - args.maximum;
              var message = 'Пожалуйста, удалите ' + overChars + ' символ';
              if (overChars >= 2 && overChars <= 4) {
                message += 'а';
              } else if (overChars >= 5) {
                message += 'ов';
              }
              return message;
            },
            inputTooShort: function(args) {
              var remainingChars = args.minimum - args.input.length;

              var message = 'Пожалуйста, введите ' + remainingChars + ' или более символов';

              return message;
            },
            loadingMore: function() {
              return 'Загружаем ещё ресурсы…';
            },
            maximumSelected: function(args) {
              var message = 'Вы можете выбрать ' + args.maximum + ' элемент';

              if (args.maximum >= 2 && args.maximum <= 4) {
                message += 'а';
              } else if (args.maximum >= 5) {
                message += 'ов';
              }

              return message;
            },
            noResults: function() {
              return 'Ничего не найдено';
            },
            searching: function() {
              return 'Поиск…';
            }
          };
        });
      }
    },
  };

  // # Cookie
  GRVE.cookie = {
    init: function() {
      this.cookieNamePrefix = "";
      this.utmParams = [
        "utm_source",
        "utm_medium",
        "utm_campaign",
        "utm_term",
        "utm_content"
      ];
      this.cookieExpiryDays = 1;

      this.writeReferrerOnce();

      if (this.utmPresentInUrl()) {
        this.writeUtmCookieFromParams();
      } else {
        this.setUtmInUrl();
      }

    },
    // From http://www.quirksmode.org/js/cookies.html
    createCookie: function(name, value, days) {
      if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
      } else var expires = "";
      document.cookie = this.cookieNamePrefix + name + "=" + value + expires + "; path=/";
    },
    readCookie: function(name) {
      var nameEQ = this.cookieNamePrefix + name + "=";
      var ca = document.cookie.split(';');
      for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
      }
      return null;
    },
    eraseCookie: function(name) {
      this.createCookie(name, "", -1);
    },
    getParameterByName: function(name) {
      name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
      var regexS = "[\\?&]" + name + "=([^&#]*)";
      var regex = new RegExp(regexS);
      var results = regex.exec(window.location.search);
      if (results == null) {
        return "";
      } else {
        return decodeURIComponent(results[1].replace(/\+/g, " "));
      }
    },
    setUtmInUrl: function() {
      var getParams = '';

      for (var i = 0; i < this.utmParams.length; i++) {
        var value = this.readCookie(this.utmParams[i]);

        if (value !== null) {
          getParams += '&' + this.utmParams[i] + '=' + value;
        }
      }

      if (getParams !== '') {

        getParams = getParams.slice(1, getParams.length);

        var separator = (window.location.href.indexOf("?")===-1) ? "?" : "&";
        window.history.pushState("", "", window.location.href + separator + getParams);
      }
    },
    utmPresentInUrl: function() {
      var present = false;
      for (var i = 0; i < this.utmParams.length; i++) {
        var param = this.utmParams[i];
        var value = this.getParameterByName(param);
        if (value != "" && value != undefined) {
          present = true;
        }
      }
      return present;
    },
    writeUtmCookieFromParams: function() {
      for (var i = 0; i < this.utmParams.length; i++) {
        var param = this.utmParams[i];
        var value = this.getParameterByName(param);
        this.createCookie(param, value, this.cookieExpiryDays)
      }
    },
    writeCookieOnce: function(name, value) {
      var existingValue = this.readCookie(name);
      if (!existingValue) {
        this.createCookie(name, value, this.cookieExpiryDays);
      }
    },
    writeReferrerOnce: function() {
      var value = document.referrer;
      if (value === "" || value === undefined) {
        this.writeCookieOnce("referrer", "direct");
      } else {
        this.writeCookieOnce("referrer", value);
      }
    },
    referrer: function() {
      return this.readCookie("referrer");
    }
  };

  // # Promocode
  // ============================================================================= //
  GRVE.promo = {
    init: function() {
      this.$promoLink =   $('.js-promo');
      this.$promocode =   $('[name=\"promocode\"]');

      this.toggle('hide');
      this.events();
    },
    toggle: function(trigger) {
      var self = this;

      this.$promoLink.each(function() {
        var $this =             $(this),
            target =            $this.attr("href"),
            $promoInput =       $(target);  
        
        if (trigger === 'show') {
          $promoInput.hide();
          self.$promoLink.removeClass("sr-only");
        } else if (trigger === 'hide') {
          $promoInput.fadeIn();
          self.$promoLink.addClass("sr-only");
        }
      });
    },
    events: function() {
      var self = this;
      this.$promocode.on("keydown paste", function() {
        var $this = $(this);
        setTimeout(function() {
          
          var value = $.trim($this.val());
          $this.val(value);
        }, 100);
      });

      this.$promocode.on("blur", function() {
        self.ajaxCheck();
      });
    },
    ajaxCheck: function() {
      var $form = $(".js-form");
      GRVE.ajaxSend.send($form, 'promo');
    }
  };

  // # maskPhone
  // ============================================================================= //
  GRVE.maskPhone = {
    init: function() {
      this.phone =     '[type=tel]';

      var cleave = new Cleave(this.phone, {
        blocks: [4, 2, 3, 2, 2],
        prefix: '+380',
        rawValueTrimPrefix: true
      });
    }
  };

  // # Reviews
  // ============================================================================= //
  GRVE.reviews = {
    init: function() {
      var el = document.getElementById( 'grid' );
      
      if (!el) { return; }

      new AnimOnScroll( el, {
        minDuration : 0.4,
        maxDuration : 0.7,
        viewportFactor : 0.2,
        shownElements: 5,
        responsiveBtnMore: true,
        showAll: true
      });
    }
  };


  // # Tabs
  // ============================================================================= //
  GRVE.facebook = {
    init: function() {
      this.facebookShare('#shareBtn');
    },
    facebookShare: function(selector) {
      $.ajaxSetup({
        cache: true
      });

      $.getScript('//connect.facebook.net/ru_RU/sdk.js', function() {
        FB.init({
          appId: '2026650054277944',
          version: 'v2.7' // or v2.1, v2.2, v2.3, ...
        });
      });

      $(selector).on("click", function() {
        FB.ui({
          method: 'share',
          display: 'popup',
          hashtag: '#VideoPozdravlenie2018',
          quote: "Потрясающий подарок для ребенка!! Такое видео точно запомнится! Очень рекомендую :) Переходите на сайт и посмотрите сами!",
          href: '//video-pozdravlenie.com/?utm_source=facebook&utm_medium=kupon&utm_campaign=repost',
        }, function(response) {

          if (response && !response.error_message) {
            // do smth
          }
        });
      });
    }
  };


  // # Tabs
  // ============================================================================= //
  GRVE.tabs = {
    init: function() {
      this.$tabs =               $('[data-tabs]');

      this.tabsItems =           'tabs__item';
      this.sections =            'form-group';
      this.activeClass =         'tabs__item--active';
      this.navigation();

      var self =                 this;

      // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
      this.$tabs.each(function() {
        var $tab =          $(this);
        var isValidate =    $tab.has('[data-tabs-validate]');
        var tabsVal =       $tab.data('tabs');
        var $sections =     $tab.find(this.sections);

        if (isValidate) {
          $tab.find(':input').each(function(index, section) {
            $(section).attr('data-parsley-group', 'block-' + tabsVal + '-' + index);
          });
          this.navigation($tab);
        }
        self.navigateTo(0, $sections); // Start at the beginning
      });
    },

    navigateTo: function(index, $sections) {
      // Mark the current section with the class 'current'
      $sections
        .removeClass(this.activeClass)
        .eq(index)
          .addClass(this.activeClass);

      // Show only the navigation buttons that make sense for the current section:
      $('.form-navigation .previous').toggle(index > 0);
      var atTheEnd = index >= $sections.length - 1;
      $('.form-navigation .next').toggle(!atTheEnd);
      $('.form-navigation [type=submit]').toggle(atTheEnd);
    },

    curIndex: function($sections) {
      // Return the current index by looking at which section has the class 'current'
      return $sections.index($sections.filter(this.activeClass));
    },
    navigation: function($tab) {
      var self =          this;
      var tabsVal =       $tab.data('tabs');

      // Previous button is easy, just go back
      $('[data-tabs-control="prev"]', $tab).on('click', function() {
        self.navigateTo(curIndex() - 1);
      });

      // Next button goes forward if current block validates
      $('[data-tabs-control="next"]', $tab).on('click', function() {
        $tab.parsley().whenValidate({
          group: 'block-' + tabsVal + '-' + self.curIndex()
        }).done(function() {
          self.navigateTo(self.curIndex() + 1);
        });
      });
    }
  }

  // # AjaxSend
  // ============================================================================= //
  GRVE.ajaxSend = {
    init: function() {
      this.send($('.js-avatar-form'), )
    },
    send: function($form, formName=undefined) {
      this.$result =         $form.find('.result');
      this.$submit =         $form.find("[type=submit]");

      var url =         $form.attr('action');
      var data =        new FormData($form[0]);
      var formVal =     this.$submit.val();
      var self =        this;

      data.append("form", formVal);

      switch (formName) {
        case 'promo':
          data = data.get["promocode"];
          break;
      }

      $.ajax(url, {
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        cache: false,
        beforeSend: function() {
          if (!formName) {
            self.progress('hide');
          }
        },
        afterSend: function() {
          if (!formName) {
            self.progress('show');
          }
        },

        success: function(data) {

          if ($.isPlainObject(data) && data.state === 200) {
            if (data.error) {
              self.submitFail(data.error);
            } else if (data.message) {
              self.submitDone(data.message);
              if (!formName && data.redirect) {
                document.location.href = data.redirect;
              }
              if (!formName) {
                $form.trigger("reset");
              }
            }
          } else {
            self.submitFail("Возникли проблемы с сервером. Сообщите нам о ошибке, мы постараемся устранить её в ближайшее время.");
          }
        },

        error: function(XMLHttpRequest, textStatus, errorThrown) {
          self.submitFail(textStatus || errorThrown);
        },
      });
    },
    submitFail: function(msg) {
      this.alert(msg, "success")
      return false;
    },
    submitDone: function(msg) {
      this.alert(msg, "danger")
      return true;
    },
    alert: function(msg, status) {
      var self =   this;
      var $alert = [

        '<div class="alert alert-' + status + ' avatar-alert alert-dismissable fade show" role="alert">',
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
        msg,
        '</div>'
      ].join('');

      this.$result.html($alert);
      if (status === "success") {
        setTimeout(function() {
          self.$result.slideUp(function() {
            self.$result.html('');
          });
        }, 3000);
      }
    },
    submit: function() {
      var self = this;
      this.$submit.on('click', function() {
        var $form = $(this).closest('.js-form');
        self.init($form);
      });
    },
    progress: function(status) {
      if (status === 'hide') {
        this.$submit.prop("disabled", true).button('loading');
      } else if (status === 'show') {
        this.$submit.prop("disabled", false).button('reset'); 
      }
    }
  };


  // # WowJS
  // ============================================================================= //
  GRVE.wowjs = {
    init: function() {
      var wow = new WOW({
          boxClass:     'js-wow',      // animated element css class (default is wow)
          animateClass: 'animated', // animation css class (default is animated)
          offset:       0,          // distance to the element when triggering the animation (default is 0)
          mobile:       false       // trigger animations on mobile devices (true is default)
      });
      wow.init();
    }
  };

  // # Transliterate cyrillic name
  // ============================================================================= //
  GRVE.transliterateName = {
    init: function(text) {
      // Символ, на который будут заменяться все спецсимволы
      var space = '-';
      // Берем значение из нужного поля и переводим в нижний регистр
      var text = text.toLowerCase();

      // Массив для транслитерации
      var transl = {
      'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'e', 'ж': 'zh', 
      'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n',
      'о': 'o', 'п': 'p', 'р': 'r','с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h',
      'ц': 'c', 'ч': 'ch', 'ш': 'sh', 'щ': 'sh','ъ': space, 'ы': 'y', 'ь': space, 'э': 'e', 'ю': 'yu', 'я': 'ya',
      ' ': space, '_': space, '`': space, '~': space, '!': space, '@': space,
      '#': space, '$': space, '%': space, '^': space, '&': space, '*': space, 
      '(': space, ')': space,'-': space, '\=': space, '+': space, '[': space, 
      ']': space, '\\': space, '|': space, '/': space,'.': space, ',': space,
      '{': space, '}': space, '\'': space, '"': space, ';': space, ':': space,
      '?': space, '<': space, '>': space, '№':space
      }

      var result = '';
      var curent_sim = '';

      for (var i = 0; i < text.length; i++) {
        // Если символ найден в массиве то меняем его
        if (transl[text[i]] != undefined) {
          if (curent_sim != transl[text[i]] || curent_sim != space) {
            result += transl[text[i]];
            curent_sim = transl[text[i]];
          }
        }
        // Если нет, то оставляем так как есть
        else {
          result += text[i];
          curent_sim = text[i];
        }
      }

      result = this.trimStr(result);
      return result;
    },
    trimStr: function(s) {
      s = s.replace(/^-/, '');
      return s.replace(/-$/, '');
    },
  };
  

  // # Cropper Image
  // ============================================================================= //
  GRVE.cropper = {
    init: function() {
      this.URL =               window.URL || window.webkitURL;
      this.$image =            $('#image');
      this.width =             900;
      this.height =            600;
      this.ratio =             this.width / this.height;
      this.$dataX =            $('#dataX');
      this.$dataY =            $('#dataY');
      this.$avatar =           $('.avatar');
      this.$dataHeight =       $('#dataHeight');
      this.$dataWidth =        $('#dataWidth');
      this.$dataRotate =       $('#dataRotate');
      this.$dataScaleX =       $('#dataScaleX');
      this.$dataScaleY =       $('#dataScaleY');
      this.originalImageURL =  this.$image.attr('src');
      this.uploadedImageType = 'image/jpeg';
      this.$avatarRatio =      $('.js-ratio');
      this.$result =           $("#avatar-result");
      this.uploadedImageURL    ;
      this.$tooltip =          $('[data-toggle="tooltip"]')

      this.options = {
        aspectRatio: this.ratior,
        preview: '.img-preview',
        viewMode: '1',
        responsive: true,
        cropBoxMovable: true, //перемещение кропбокса
        cropBoxResizable: true, //изменение размера кропбокса
        toggleDragModeOnDblclick: false,
        imageSmoothingEnabled: false,
        imageSmoothingQuality: 'high',
        dragMode: false,
        movable: false,
        zoomOnTouch: false,
        crop: function(e) {
          this.$dataX.val(Math.round(e.x));
          this.$dataY.val(Math.round(e.y));
          this.$dataHeight.val(Math.round(e.height));
          this.$dataWidth.val(Math.round(e.width));
          this.$dataRotate.val(e.rotate);
          this.$dataScaleX.val(e.scaleX);
          this.$dataScaleY.val(e.scaleY);
        }
      }
      this.initTooltip();
    },
    ratio: function(e) {
      $avatarRatio.on('change', function() {
        var val = parseFloat($(this).val());

        options.aspectRatio = val;

        if (val > 1) {
          width = 900;
          height = 600;
        } else {
          width = 600;
          height = 900;
        }

        $image.cropper('destroy').cropper(options);
      });
    },
    generateFileName: function() {
      var $items = $("[data-new-name]"),
        countgender = 0,
        genderVal = "",
        names = [],
        name = "";
      $items.each(function() {
        var $this = $(this),
          targetClass = $this.data(),
          $group = $(targetClass.newName),
          $input = $group.find("input.form-control"),
          $select = $group.find(".select"),
          $gender = $group.closest("[data-childrean-item]").find(".js-gender"),
          gender = $gender.val();

        if (gender !== "" && !isNaN(gender)) {
          var gender = parseInt(gender, 10);
          genderVal = (gender === 1) ? "m" : "f";
          countgender++;
        }

        if ($(this).prop("checked")) {
          names.push($input.val());
        } else {
          var name = $select.filter("[required]").find("option:selected").text();
          names.push(name);
        }

      });

      if (countgender > 1) {
        genderVal = "2";
      }

      name = transliterate(names.join(" "));
      return (genderVal + "_" + name);
    },
    initTooltip: function() {
      // Tooltip
      this.$tooltip.tooltip();
    },
    native: function() {

      var console = window.console || { log: function () {} };
      var URL = window.URL || window.webkitURL;
      var $image = $('#image');
      var $download = $('#download');
      var $dataX = $('#dataX');
      var $dataY = $('#dataY');
      var $dataHeight = $('#dataHeight');
      var $dataWidth = $('#dataWidth');
      var $dataRotate = $('#dataRotate');
      var $dataScaleX = $('#dataScaleX');
      var $dataScaleY = $('#dataScaleY');
      var options = {
            aspectRatio: 16 / 9,
            preview: '.img-preview',
            crop: function (e) {
              $dataX.val(Math.round(e.x));
              $dataY.val(Math.round(e.y));
              $dataHeight.val(Math.round(e.height));
              $dataWidth.val(Math.round(e.width));
              $dataRotate.val(e.rotate);
              $dataScaleX.val(e.scaleX);
              $dataScaleY.val(e.scaleY);
            }
          };
      var originalImageURL = $image.attr('src');
      var uploadedImageType = 'image/jpeg';
      var uploadedImageURL;


      // Tooltip
      $('[data-toggle="tooltip"]').tooltip();


      // Cropper
      $image.on({
        ready: function (e) {
          console.log(e.type);
        },
        cropstart: function (e) {
          console.log(e.type, e.action);
        },
        cropmove: function (e) {
          console.log(e.type, e.action);
        },
        cropend: function (e) {
          console.log(e.type, e.action);
        },
        crop: function (e) {
          console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
        },
        zoom: function (e) {
          console.log(e.type, e.ratio);
        }
      }).cropper(options);


      // Buttons
      if (!$.isFunction(document.createElement('canvas').getContext)) {
        $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
      }

      if (typeof document.createElement('cropper').style.transition === 'undefined') {
        $('button[data-method="rotate"]').prop('disabled', true);
        $('button[data-method="scale"]').prop('disabled', true);
      }


      // Download
      if (typeof $download[0].download === 'undefined') {
        $download.addClass('disabled');
      }


      // Options
      $('.docs-toggles').on('change', 'input', function () {
        var $this = $(this);
        var name = $this.attr('name');
        var type = $this.prop('type');
        var cropBoxData;
        var canvasData;

        if (!$image.data('cropper')) {
          return;
        }

        if (type === 'checkbox') {
          options[name] = $this.prop('checked');
          cropBoxData = $image.cropper('getCropBoxData');
          canvasData = $image.cropper('getCanvasData');

          options.ready = function () {
            $image.cropper('setCropBoxData', cropBoxData);
            $image.cropper('setCanvasData', canvasData);
          };
        } else if (type === 'radio') {
          options[name] = $this.val();
        }

        $image.cropper('destroy').cropper(options);
      });


      // Methods
      $('.docs-buttons').on('click', '[data-method]', function () {
        var $this = $(this);
        var data = $this.data();
        var cropper = $image.data('cropper');
        var cropped;
        var $target;
        var result;

        if ($this.prop('disabled') || $this.hasClass('disabled')) {
          return;
        }

        if (cropper && data.method) {
          data = $.extend({}, data); // Clone a new one

          if (typeof data.target !== 'undefined') {
            $target = $(data.target);

            if (typeof data.option === 'undefined') {
              try {
                data.option = JSON.parse($target.val());
              } catch (e) {
                console.log(e.message);
              }
            }
          }

          cropped = cropper.cropped;

          switch (data.method) {
            case 'rotate':
              if (cropped && options.viewMode > 0) {
                $image.cropper('clear');
              }

              break;

            case 'getCroppedCanvas':
              if (uploadedImageType === 'image/jpeg') {
                if (!data.option) {
                  data.option = {};
                }

                data.option.fillColor = '#fff';
              }

              break;
          }

          result = $image.cropper(data.method, data.option, data.secondOption);

          switch (data.method) {
            case 'rotate':
              if (cropped && options.viewMode > 0) {
                $image.cropper('crop');
              }

              break;

            case 'scaleX':
            case 'scaleY':
              $(this).data('option', -data.option);
              break;

            case 'getCroppedCanvas':
              if (result) {
                // Bootstrap's Modal
                $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                if (!$download.hasClass('disabled')) {
                  $download.attr('href', result.toDataURL(uploadedImageType));
                }
              }

              break;

            case 'destroy':
              if (uploadedImageURL) {
                URL.revokeObjectURL(uploadedImageURL);
                uploadedImageURL = '';
                $image.attr('src', originalImageURL);
              }

              break;
          }

          if ($.isPlainObject(result) && $target) {
            try {
              $target.val(JSON.stringify(result));
            } catch (e) {
              console.log(e.message);
            }
          }

        }
      });


      // Keyboard
      $(document.body).on('keydown', function (e) {

        if (!$image.data('cropper') || this.scrollTop > 300) {
          return;
        }

        switch (e.which) {
          case 37:
            e.preventDefault();
            $image.cropper('move', -1, 0);
            break;

          case 38:
            e.preventDefault();
            $image.cropper('move', 0, -1);
            break;

          case 39:
            e.preventDefault();
            $image.cropper('move', 1, 0);
            break;

          case 40:
            e.preventDefault();
            $image.cropper('move', 0, 1);
            break;
        }

      });


      // Import image
      var $inputImage = $('#inputImage');

      if (URL) {
        $inputImage.change(function () {
          var files = this.files;
          var file;

          if (!$image.data('cropper')) {
            return;
          }

          if (files && files.length) {
            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {
              uploadedImageType = file.type;

              if (uploadedImageURL) {
                URL.revokeObjectURL(uploadedImageURL);
              }

              uploadedImageURL = URL.createObjectURL(file);
              $image.cropper('destroy').attr('src', uploadedImageURL).cropper(options);
              $inputImage.val('');
            } else {
              window.alert('Please choose an image file.');
            }
          }
        });
      } else {
        $inputImage.prop('disabled', true).parent().addClass('disabled');
      }
    }
  };
  

  // # Page Settings
  // ============================================================================= //
  GRVE.pageSettings = {
    init: function() {
      this.accordion();
      this.bsModal();
      this.bsPanel();
      this.bsModalVideo();

    },
    accordion: function() {
      // Add minus icon for collapse element which is open by default
      $(".collapse.in").each(function() {
        $(this).siblings(".panel-heading").find(".panel__ic").addClass("minus");
      });

      // Toggle plus minus icon on show hide of collapse element
      $(".collapse").on('show.bs.collapse', function() {
        $(this).parent().find(".panel__ic").addClass("minus");
      }).on('hide.bs.collapse', function() {
        $(this).parent().find(".panel__ic").removeClass("minus");
      });
    },
    bsModal: function() {
      var firstModalOpen = $("body").hasClass("modal-open");

      $("#confident").on('hidden.bs.modal', function() {
        if (!firstModalOpen)
          $("body").addClass("modal-open");
      });
    },
    bsPanel: function() {
      var timeoutID = setTimeout(function() {
        $('.js-panel').fadeIn('300');
        clearTimeout(timeoutID);
      }, 5000);

      $(".js-panel").on('click', '[data-close]', function() {
        $(this).closest('.js-panel').fadeOut("300", function() {
          $(this).detach();
        });
      });
    },
    bsModalVideo: function() {

      $('#video__modal').on('shown.bs.modal', function() {
        $("#video__modal .modal__iframe").attr('src', 'https://www.youtube.com/embed/lLgW4wR1vQQ?ecver=1&autoplay=1&showinfo=0&mute=0&iv_load_policy=3&showsearch=0');
      });

      $('#video__modal').on('hidden.bs.modal', function() {
        $("#video__modal .modal__iframe").attr('src', 'https://www.youtube.com/embed/lLgW4wR1vQQ?ecver=1&autoplay=0&showinfo=0&mute=1&iv_load_policy=3&showsearch=0');
      });

      $('#video__modal-full').on('shown.bs.modal', function() {
        $("#video__modal-full .modal__iframe").attr('src', 'https://www.youtube.com/embed/kg-qEHftDd8?ecver=1&autoplay=1&showinfo=0&mute=0&iv_load_policy=3&showsearch=0');
      });

      $('#video__modal-full').on('hidden.bs.modal', function() {
        $("#video__modal-full .modal__iframe").attr('src', 'https://www.youtube.com/embed/kg-qEHftDd8?ecver=1&autoplay=0&showinfo=0&mute=1&iv_load_policy=3&showsearch=0');
      });
    }
  };

  // # Basic Elements
  // ============================================================================= //
  GRVE.basicElements = {
    init: function() {
      this.carousel();
      this.countdown();
    },
    carousel: function() {

      var $element = $('.js-carousel');

      $element.each(function(){

        var $carousel = $(this),
          $nextNav = $carousel.find('.js-carousel-next'),
          $prevNav = $carousel.find('.js-carousel-prev'),
          sliderSpeed = ( parseInt( $carousel.attr('data-slider-speed') ) ) ? parseInt( $carousel.attr('data-slider-speed') ) : 3000,
          pagination = $carousel.attr('data-pagination') != 'no' ? true : false,
          paginationSpeed = ( parseInt( $carousel.attr('data-pagination-speed') ) ) ? parseInt( $carousel.attr('data-pagination-speed') ) : 400,
          autoHeight = $carousel.attr('data-slider-autoheight') == 'yes' ? true : false,
          autoPlay = $carousel.attr('data-slider-autoplay') != 'no' ? true : false,
          sliderPause = $carousel.attr('data-slider-pause') == 'yes' ? true : false,
          loop = $carousel.attr('data-slider-loop') != 'no' ? true : false,
          itemNum = parseInt( $carousel.attr('data-items')),
          tabletLandscapeNum = $carousel.attr('data-items-tablet-landscape') ? parseInt( $carousel.attr('data-items-tablet-landscape')) : 3,
          tabletPortraitNum = $carousel.attr('data-items-tablet-portrait') ? parseInt( $carousel.attr('data-items-tablet-portrait')) : 3,
          mobileNum = $carousel.attr('data-items-mobile') ? parseInt( $carousel.attr('data-items-mobile')) : 1,
          gap = $carousel.hasClass('js-with-gap') && !isNaN( $carousel.data('gutter-size') ) ? Math.abs( $carousel.data('gutter-size') ) : 0;

        // Carousel Init
        $carousel.owlCarousel({
          loop : loop,
          autoplay : autoPlay,
          autoplayTimeout : sliderSpeed,
          autoplayHoverPause : sliderPause,
          smartSpeed : 500,
          dots : pagination,
          responsive : {
            0 : {
              items : mobileNum
            },
            768 : {
              items : tabletPortraitNum
            },
            1024 : {
              items : tabletLandscapeNum
            },
            1200 : {
              items : itemNum
            }
          },
          margin : gap
        });

        $carousel.css('visibility','visible');

        // Go to the next item
        $nextNav.click(function() {
          $carousel.trigger('next.owl.carousel');
        })
        // Go to the previous item
        $prevNav.click(function() {
          $carousel.trigger('prev.owl.carousel');
        })
      });
    },
    countdown: function(){
      $('[data-countdown]').each(function() {
        var $this =              $(this),
          finalDate =            $this.data('countdown'),
          countdownItems =       '',
          text =                 '',
          delimeter =            ':',
          countdownFormat =      $this.data('countdown-format').split('|');


        $.each( countdownFormat, function( index, value ) {
          switch (value) {
            case 'w':
              text = "Недель";
              break;
            case 'D':
            case 'd':
            case 'n':
              text = "Дней";
              break;
            case 'H':
              text = "Часов";
              break;
            case 'M':
              text = "Минут";
              break;
            case 'S':
              text = "Секунд";
              break;
            default:
              text = '';
          }
         
          countdownItems += '<div class="timer__item">'
          countdownItems += '<div class="timer__time">%' + value + '</div>';
          countdownItems += '<div class="timer__text">' + text + '</div>';
          countdownItems += '</div>';

          if (index === countdownFormat.length - 1) {
            return;
          }

          countdownItems += '<div class="timer__item">'
          countdownItems += '<div class="timer__time">' + delimeter + '</div>';
          countdownItems += '</div>';

        });

        $this.countdown(finalDate, function(event) {
          $this = $(this).html(event.strftime( countdownItems ));
        });
      });
    },
  };


  $(document).ready(function(){ GRVE.documentReady.init(); });
  $(window).smartresize(function(){ GRVE.documentResize.init(); });
  $(window).on('load', function(){ GRVE.documentLoad.init(); });
  $(window).on('scroll', function() { GRVE.documentScroll.init(); });

})(jQuery); // End of use strict
