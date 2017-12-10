
(function($) {
  "use strict"; // Start of use strict

  // Old browser notification
  $(function() {
    $.reject({
      reject: {
        msie: 10
      },
      imagePath: 'img/icons/jReject/',
      display: ['chrome', 'firefox', 'safari', 'opera'],
      closeCookie: true,
      cookieSettings: {
        expires: 60 * 60 * 24 * 365
      },
      header: 'Ваш браузер устарел!',
      paragraph1: 'Вы пользуетесь устаревшим браузером, который не поддерживает современные веб-стандарты и представляет угрозу вашей безопасности.',
      paragraph2: 'Пожалуйста, установите современный браузер:',
      closeMessage: 'Закрывая это уведомление вы соглашаетесь с тем, что сайт в вашем браузере может отображаться некорректно.',
      closeLink: 'Закрыть это уведомление',
    });
  });

  $(function() {
    $(window).scroll(function() {
      if ($(this).scrollTop() > 200) {
        $('.js-back-to-top').fadeIn()
      } else {
        $('.js-back-to-top').fadeOut()
      }
    });

    $('.js-back-to-top').hide().on("click", function() {
      $('html, body').animate({
          scrollTop: 0
        },
        800);
      return false
    });
  });

  var firstModalOpen = $("body").hasClass("modal-open");

  $("#confident").on('hidden.bs.modal', function() {
    if (!firstModalOpen)
      $("body").addClass("modal-open");
  });

  // jQuery.countdown http://hilios.github.io/jQuery.countdown/examples/legacy-style.html
  if ($('.js-timer').length) {
    $('.js-timer').countdown('2017/12/17', function(event) {

      var $this = $(this).html(event.strftime('' +
        '<div class="timer__item"><div class="timer__time">%D</div><div class="timer__text">дней</div></div>' +
        '<div class="timer__item"><div class="timer__time">:</div></div>' +
        '<div class="timer__item"><div class="timer__time">%H</div><div class="timer__text">часов</div></div>' +
        '<div class="timer__item"><div class="timer__time">:</div></div>' +
        '<div class="timer__item"><div class="timer__time">%M</div><div class="timer__text">минут</div></div>' +
        '<div class="timer__item"><div class="timer__time">:</div></div>' +
        '<div class="timer__item"><div class="timer__time">%S</div><div class="timer__text">секунд</div></div>'));
    });
  }

  if ($(window).width() >= 576) {
    if ($('.sv-item__text').length) {
      $('.sv-item__text').matchHeight({
        byRow: true,
        property: 'height',
        target: null,
        remove: false
      });
    }
  };

  $(document).ready(function() {
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
  });

  // Select2 
  $(function() {
    var $selectElement = $('.form-control--select');

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

    if ($selectElement) {
      $selectElement.select2({
        placeholder: "--Select something (default placeholder)--",
        width: 'resolve',
        sortResults: function(results, container, query) {
          if (query.term) {
            // use the built in javascript sort function
            return results.sort();
          }
          return results;
        },
        language: 'ru',
      });

      $('.select2-selection__arrow').html('<svg class="svg svg--arrow-down select2-selection__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img"><use xlink:href="img/sprite.svg#arrow-down"></use></svg>');
    }
  });

  // fixed panel close
  $(function() {
    var timeoutID = setTimeout(function() {
      $('.js-panel').fadeIn('300');
      clearTimeout(timeoutID);
    }, 5000);

    $(".js-panel").on('click', '[data-close]', function() {
      $(this).closest('.js-panel').fadeOut("300", function() {
        $(this).detach();
      });
    });
  });

  // Trigger anchor scroll
  $(function() {
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function() {
      if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: (target.offset().top - 40)
          }, 1000);
          return false;
        }
      }
    });
  });

  $('#video__modal').on('shown.bs.modal', function() {
    $("#video__modal .modal__iframe").attr('src', 'https://www.youtube.com/embed/lLgW4wR1vQQ?ecver=1&autoplay=1&showinfo=0&mute=0&iv_load_policy=3&showsearch=0');
  });

  $('#video__modal').on('hidden.bs.modal', function() {
    $("#video__modal .modal__iframe").attr('src', 'https://www.youtube.com/embed/lLgW4wR1vQQ?ecver=1&autoplay=0&showinfo=0&mute=1&iv_load_policy=3&showsearch=0');
  });

  // Tabs
  $(function() {
    var $indexControl = $("[data-tabs-index]");

    function getQueryVariable(variable) {
      var query = window.location.search.substring(1);
      var vars = query.split('&');
      for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
          return decodeURIComponent(pair[1]);
        }
      }
      return;
    }


    $("[data-tabs-control]").on('click', function(e) {
      var control = $(this).data('tabs-control'),
        index = $(this).data('tabs-index'),
        target = $(this).data('tabs-toggle'),
        $tabs = $("[data-tabs=" + target + "]");

      if (typeof index !== undefined) {

      }

      $tabs.each(function() {
        var $item = $(this).find('.tabs__item'),
          $currentItem = $item.filter('.tabs__item--active'),
          activeItem = $currentItem.index() - 1;

        // Tabs control button
        if (control === 'prev') {
          activeItem = activeItem - 1;
          $indexControl.removeClass('tabs-control__link--active').eq(activeItem).addClass('tabs-control__link--active');
        } else if (control === 'next') {
          activeItem = activeItem + 1;
          $indexControl.removeClass('tabs-control__link--active').eq(activeItem).addClass('tabs-control__link--active');
        } else if (control === 'index') {
          activeItem = parseInt(index, 10);
          $indexControl.removeClass('tabs-control__link--active').eq(activeItem).addClass('tabs-control__link--active');
        }

        $item.removeClass('tabs__item--active').eq(activeItem).addClass('tabs__item--active');

      });
      e.preventDefault();
    });

    if (getQueryVariable('gender') !== undefined) {
      var $childreanItem = $("[data-childrean-item]"),
        $gender = $childreanItem.eq(0).find(".js-gender"),
        $male = $childreanItem.eq(0).find("[data-gender=male]"),
        $female = $childreanItem.eq(0).find("[data-gender=female]"),
        gender = parseInt(getQueryVariable('gender'), 10),
        male = getQueryVariable('male'),
        female = getQueryVariable('female');


      $indexControl.get(1).click();
      $gender.val(gender).trigger('change.select2');

      $male.val(male).trigger('change.select2');
      $female.val(female).trigger('change.select2');

    }
  });

  $(function() {
    var $genders = $("[data-gender]"),
      triggerChecked = false,
      changeName = function($item) {
        var $this = $item,
          target = $this.data("gender"),
          $select = $(target),
          $selectContainer = $select.next(".select2-container"),
          genderVal = $this.val()

        if ($this.prop("checked")) {
          $select.prop('required', true);
          $selectContainer.fadeIn();
          $select.siblings(".select").prop('required', false);
          $selectContainer.siblings(".select2-container").fadeOut(0);
          triggerChecked = true;
        }
      }

    $genders.each(function() {
      changeName($(this));
    });

    if (!triggerChecked) {
      var $item = $genders.eq(0);
      $item.prop("checked", true);
      changeName($item);
    }

    $genders.on("click change", function() {
      changeName($(this));
    });
  });

  // Show more childrean
  $(function() {
    var $items = $("[data-childrean-item]"),
      $control = $("[data-childrean]"),
      childrean = 0,
      showChildrean = function showChildrean(childrean) {
        var items = parseInt(childrean, 10);

        if (!items) {
          $items.fadeOut();
          return;
        }

        for (var i = 0; i < $items.length; i++) {
          if (i < items) {
            $items.eq(i).fadeIn();
          } else {
            $items.eq(i).fadeOut();
          }
        }
      };

    $control.each(function() {
      if ($(this).prop("checked")) {
        childrean = $(this).data("childrean");
      }
    });

    showChildrean(childrean);

    $control.on("click change", function() {
      childrean = $(this).data("childrean");
      showChildrean(childrean);
    });

  });

  // Add new name
  $(function() {
    var $checkbox = $("[data-new-name]"),
      $childreanNums = $("[data-childrean]"),
      $totalPrice = $(".js-total-price"),
      newName = function() {
        var $childrean = $("[data-childrean-item]"),
          $label = $(".js-new-name"),
          triggerLabel = false;
        $childreanNums.each(function() {
          var $check = $(this);
          if ($check.prop("checked")) {
            if ($check.val() == 2) {
              $label.removeClass("d-none");
              $totalPrice.filter(".d-none").removeClass("d-none").siblings().addClass("d-none");
              triggerLabel = true;
            } else {
              $checkbox.eq(1).prop("checked", false);
            }
          }
        });



        $childrean.each(function() {
          var $check = $(this).find("[data-new-name]"),
            target = $check.data("new-name"),
            $group = $(target),
            $input = $group.find("input.form-control"),
            $select = $group.find(".select"),
            $selectContainer = $select.next(".select2-container"),
            $gender = $(this).find(".js-gender"),
            genderVal = $gender.val(),
            selectIndex = 0;

          if (genderVal !== "" && !isNaN(genderVal)) {
            var gender = parseInt(genderVal, 10);
            selectIndex = (gender === 1) ? 0 : 1;
          }

          if ($check.prop("checked")) {
            $input.fadeIn();
            $input.prop('required', true);
            $select.prop('required', false);
            $selectContainer.fadeOut(0);
            $label.removeClass("d-none");
            $totalPrice.removeClass("d-none").eq(0).addClass("d-none");
            triggerLabel = true;
          } else {
            $input.fadeOut(0);
            $input.prop('required', false);
            $select.eq(selectIndex).prop('required', true);
            $selectContainer.eq(selectIndex).fadeIn();
            $select.eq(+!selectIndex).prop('required', false);
            $selectContainer.eq(+!selectIndex).fadeOut(0);
          }
        });

        if (!triggerLabel) {
          $label.addClass("d-none");
          $totalPrice.addClass("d-none").eq(0).removeClass("d-none");
        }
      };

    newName();

    $checkbox.on("click change", function() {
      newName();
    });

    $childreanNums.on("change", function() {
      newName();
    });

    $(".js-gender").on("change", function() {
      newName();
    });

  });

  // show promo
  $(function() {
    var $promoLink = $('.js-promo');

    $promoLink.each(function() {
      var $this = $(this),
        target = $this.attr("href"),
        $promoInput = $(target);

      $promoInput.hide();
      $promoLink.removeClass("sr-only");
    });
    $promoLink.on("click", function() {
      var $this = $(this),
        target = $this.attr("href"),
        $promoInput = $(target);

      $promoInput.fadeIn();
      $promoLink.addClass("sr-only");
    });
  });

  (function(factory) {
    if (typeof define === 'function' && define.amd) {
      // AMD. Register as anonymous module.
      define(['jquery'], factory);
    } else if (typeof exports === 'object') {
      // Node / CommonJS
      factory(require('jquery'));
    } else {
      // Browser globals.
      factory(jQuery);
    }
  })(function($) {

    'use strict';

    var console = window.console || {
      log: function() {}
    };

    function CropAvatar($element, $modalEl) {
      var _this = this;


      this.$container = $element;
      this.$modal = $modalEl;
      this.containerActiveClass = "avatar--active";

      this.$newnames = $("[data-new-name]");

      this.$btnToggle = $('.js-file');
      this.$avatarView = this.$container.find('.avatar-view');
      this.$avatar = this.$avatarView.find('img');
      this.$avatarSrcImage = this.$avatarView.find('#image');
      this.$avatarModal = this.$modal;
      this.$loading = $('.loading');

      this.$fileName = this.$avatarModal.find('.avatar-filename');
      this.$avatarForm = this.$avatarModal.find('.avatar-form');
      this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
      this.$avatarSrc = this.$avatarForm.find('.avatar-src');
      this.$avatarData = this.$avatarForm.find('.avatar-data');
      this.$avatarInput = this.$avatarForm.find('.avatar-input');
      this.$avatarSave = this.$avatarForm.find('.avatar-save');
      this.$avatarBtns = this.$avatarForm.find('.avatar-btns');
      this.$avatarRatio = this.$avatarForm.find('.avatar-ratio');

      this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');

      this.options = {
        aspectRatio: 3 / 2,
        /*
                minCropBoxWidth: 300,
                minCropBoxHeight: 200,*/
        viewMode: 1,
        restore: false,
        guides: false,
        highlight: false,
        autoCropArea: 0.65,
        zoomOnWheel: false,
        checkOrientation: false,
        crop: function(e) {

          var json = [
            '{"x":' + e.x,
            '"y":' + e.y,
            '"height":' + e.height,
            '"width":' + e.width,
            '"rotate":' + e.rotate + '}'
          ].join();
          _this.$avatarData.val(json);
        },
      };

      this.init();
    }

    CropAvatar.prototype = {
      constructor: CropAvatar,

      support: {
        fileList: !!$('<input type="file">').prop('files'),
        blobURLs: !!window.URL && URL.createObjectURL,
        formData: !!window.FormData
      },

      init: function() {
        this.support.datauri = this.support.fileList && this.support.blobURLs;

        if (!this.support.formData) {
          this.initIframe();
        }

        this.initModal();
        this.addListener();
      },

      addListener: function() {
        this.$btnToggle.on('click', $.proxy(this.click, this));
        this.$avatarInput.on('change', $.proxy(this.change, this));
        this.$avatarForm.on('submit', $.proxy(this.submit, this));
        this.$avatarBtns.on('click', $.proxy(this.rotate, this));
        this.$avatarRatio.on('change', $.proxy(this.ratio, this));

      },

      initModal: function() {
        this.$avatarModal.modal({
          show: false
        });
      },

      initIframe: function() {
        var target = 'upload-iframe-' + (new Date()).getTime();
        var $iframe = $('<iframe>').attr({
          name: target,
          src: ''
        });
        var _this = this;

        // Ready ifrmae
        $iframe.one('load', function() {

          // respond response
          $iframe.on('load', function() {
            var data;

            try {
              data = $(this).contents().find('body').text();
            } catch (e) {
              console.log(e.message);
            }

            if (data) {
              try {
                data = $.parseJSON(data);
              } catch (e) {
                console.log(e.message);
              }

              _this.submitDone(data);
            } else {
              _this.submitFail('Image upload failed!');
            }

            _this.submitEnd();

          });
        });

        this.$iframe = $iframe;
        this.$avatarForm.attr('target', target).after($iframe.hide());
      },

      click: function() {
        this.$avatarModal.modal('show');
        this.getNames();
      },

      change: function() {
        var files;
        var file;

        if (this.support.datauri) {
          files = this.$avatarInput.prop('files');

          if (files.length > 0) {
            file = files[0];

            if (this.isImageFile(file)) {
              if (this.url) {
                URL.revokeObjectURL(this.url); // Revoke the old one
              }

              this.url = URL.createObjectURL(file);
              this.startCropper();
            }
          }
        } else {
          file = this.$avatarInput.val();

          if (this.isImageFile(file)) {
            this.syncUpload();
          }
        }
      },

      submit: function() {
        if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
          return false;
        }

        if (this.support.formData) {
          this.ajaxUpload();
          return false;
        }
      },

      rotate: function(e) {
        var data;

        if (this.active) {
          data = $(e.target).data();

          if (data.method) {
            this.$img.cropper(data.method, data.option);
          }
        }
      },

      ratio: function(e) {

        this.options.aspectRatio = $(e.target).val();
        this.$img.cropper('destroy').cropper(this.options);
      },

      getNames: function(e) {
        var $items = this.$newnames,
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

        name = this.transliterate(names.join(" "));
        this.$fileName.val(genderVal + "_" + name);

      },

      transliterate: function(text) {
        // Символ, на который будут заменяться все спецсимволы
        var space = '-';
        // Берем значение из нужного поля и переводим в нижний регистр
        var text = text.toLowerCase();

        // Массив для транслитерации
        var transl = {
          'а': 'a',
          'б': 'b',
          'в': 'v',
          'г': 'g',
          'д': 'd',
          'е': 'e',
          'ё': 'e',
          'ж': 'zh',
          'з': 'z',
          'и': 'i',
          'й': 'j',
          'к': 'k',
          'л': 'l',
          'м': 'm',
          'н': 'n',
          'о': 'o',
          'п': 'p',
          'р': 'r',
          'с': 's',
          'т': 't',
          'у': 'u',
          'ф': 'f',
          'х': 'h',
          'ц': 'c',
          'ч': 'ch',
          'ш': 'sh',
          'щ': 'sh',
          'ъ': space,
          'ы': 'y',
          'ь': space,
          'э': 'e',
          'ю': 'yu',
          'я': 'ya',
          ' ': space,
          '_': space,
          '`': space,
          '~': space,
          '!': space,
          '@': space,
          '#': space,
          '$': space,
          '%': space,
          '^': space,
          '&': space,
          '*': space,
          '(': space,
          ')': space,
          '-': space,
          '\=': space,
          '+': space,
          '[': space,
          ']': space,
          '\\': space,
          '|': space,
          '/': space,
          '.': space,
          ',': space,
          '{': space,
          '}': space,
          '\'': space,
          '"': space,
          ';': space,
          ':': space,
          '?': space,
          '<': space,
          '>': space,
          '№': space
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


      isImageFile: function(file) {
        if (file.type) {
          return /^image\/\w+$/.test(file.type);
        } else {
          return /\.(jpg|jpeg|png|gif)$/.test(file);
        }
      },

      startCropper: function() {
        var _this = this;

        if (this.active) {
          this.$img.cropper('replace', this.url);
        } else {
          this.$img = $('<img src="' + this.url + '">');
          this.$avatarWrapper.empty().html(this.$img);
          this.$img.cropper(this.options);

          this.active = true;
        }

        //this.$avatarModal.one('hidden.bs.modal', function () {
        // _this.stopCropper();
        //});
      },

      stopCropper: function() {
        if (this.active) {
          this.$img.cropper('destroy');
          this.$img.remove();
          this.active = false;
        }
      },

      ajaxUpload: function() {
        var url = this.$avatarForm.attr('action');
        var data = new FormData(this.$avatarForm[0]);
        var _this = this;

        $.ajax(url, {
          type: 'post',
          data: data,
          dataType: 'json',
          processData: false,
          contentType: false,

          beforeSend: function() {
            _this.submitStart();
          },

          success: function(data) {
            _this.submitDone(data);
          },

          error: function(XMLHttpRequest, textStatus, errorThrown) {
            _this.submitFail(textStatus || errorThrown);
          },

          complete: function() {
            _this.submitEnd();
          }
        });
      },

      syncUpload: function() {
        this.$avatarSave.click();
      },

      submitStart: function() {
        this.$loading.fadeIn();
      },

      submitDone: function(data) {

        if ($.isPlainObject(data) && data.state === 200) {
          if (data.result) {
            this.url = data.result;

            if (this.support.datauri || this.uploaded) {
              this.uploaded = false;
              this.cropDone();
            } else {
              this.uploaded = true;
              this.$avatarSrc.val(this.url);
              this.startCropper();
            }

            this.$avatarInput.val('');
          } else if (data.message) {
            this.alert(data.message);
          }
        } else {
          this.alert('Failed to response');
        }
      },

      submitFail: function(msg) {
        this.alert(msg);
      },

      submitEnd: function() {
        this.$loading.fadeOut();
      },

      cropDone: function() {
        this.$avatarForm.get(0).reset();
        this.$avatar.attr('src', this.url);
        this.$avatarSrcImage.val(this.url);
        this.stopCropper();
        this.$avatarModal.modal('hide');
        this.$container.addClass(this.containerActiveClass);
      },

      alert: function(msg) {
        var $alert = [
          '<div class="alert alert-danger avatar-alert alert-dismissable fade show" role="alert">',
          '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
          msg,
          '</div>'
        ].join('');

        this.$avatarUpload.after($alert);
      }
    };

    $(function() {
      return new CropAvatar($('#crop-avatar'), $('#avatar-modal'));
    });

  });

  $("[name=\"promocode\"]").on("keydown paste", function() {
    var element = this;
    setTimeout(function() {
      var value = $.trim($(element).val());
      $(element).val(value);
    }, 100);
  });

  $("[name=\"promocode\"]").on("focusout", function() {
    var $form = $(".form");
    var $promo = $(this);
    var $result = $promo.siblings(".result")
    var url = $form.attr('action');
    var data = new FormData($form[0]);

    var alert = function(msg, status) {
      var $alert = [

        '<div class="alert alert-' + status + ' avatar-alert alert-dismissable fade show" role="alert">',
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
        msg,
        '</div>'
      ].join('');

      $result.html($alert);
      if (status === "success") {
        setTimeout(function() {
          $result.slideUp(function() {
            $result.html('');
          });
        }, 3000);
      }
    }

    var submitFail = function(msg) {
      alert(msg, "danger");
    }

    var submitDone = function(msg) {
      alert(msg, "success");
    }

    $.ajax(url, {
      type: 'post',
      data: data.get["promocode"],
      dataType: 'json',
      processData: false,
      contentType: false,

      success: function(data) {
        if (data.error) {
          submitFail(data.error);
        } else if (data.message) {
          submitDone(data.message);
          $promo.prop("disabled", true);
        }
      },

      error: function(XMLHttpRequest, textStatus, errorThrown) {
        submitFail(textStatus || errorThrown);
      },
    });
  });




  $(function() {
    $.ajaxSetup({
      cache: true
    });
    $.getScript('//connect.facebook.net/ru_RU/sdk.js', function() {
      FB.init({
        appId: '2026650054277944',
        version: 'v2.7' // or v2.1, v2.2, v2.3, ...
      });
    });

    $('#shareBtn').on("click", function() {
      FB.ui({
        method: 'share',
        display: 'popup',
        hashtag: '#VideoPozdravlenie2018',
        href: 'https://video-pozdravlenie.com/?utm_source=facebook&utm_medium=kupon&utm_campaign=repost',
      }, function(response) {

        if (response && !response.error_message) {
          $("#facebook").modal("hide");
          $(".js-discount").val("facebook");
          $(".js-hidden-discount").removeClass("d-none");
          $(".js-discount-price").text("-30");
          var $totalPrice = $(".js-total-price-val");
          $('.js-total-discount').remove();
          $totalPrice.each(function() {
            var totalPrice = $(this).text();
            totalPrice = parseInt(totalPrice, 10);
            $(this).text(totalPrice - 30);
          });
        }
      });
    });
  });

  $(function() {
    var cleave = new Cleave('[name=phone]', {
      blocks: [4, 2, 3, 2, 2],
      prefix: '+380',
      rawValueTrimPrefix: true
    });
  });

  $(function() {

    $('.js-avatar-form')
      .on('submit', function(e) {
        var $form = $(this);


        var submitStart = function() {
          $(".loading").fadeIn();
        }


        var submitEnd = function() {
          $(".loading").fadeOut();
        }

        var alert = function(msg, classItem) {

          // Success message
          $form.find('.success').html("<div class='alert " + classItem + "'>");
          $form.find('.success > .' + classItem).html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
            .append("</button>");
          $form.find('.success >  .' + classItem)
            .append("<strong>" + msg + "</strong>");
          $form.find('.success >  .' + classItem)
            .append('</div>');

        }

        if (e.isDefaultPrevented()) {
          // handle the invalid form...
        } else {
          e.preventDefault();
          $form.find("[type=submit]").prop("disabled", true).button('loading'); //prevent submit behaviour and display preloading
          $form.find('.success').html("");

          var url = $form.attr('action');
          var form = $form.find("[type=submit]").val();
          var data = new FormData($form[0]);

          data.append("form", form);

          $.ajax(url, {
            type: 'post',
            data: data,
            dataType: 'json',
            processData: false,
            contentType: false,
            cache: false,
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              alert(textStatus || errorThrown, "alert-danger");
              $form.find("[type=submit]").prop("disabled", false).button('reset');

              submitEnd();
            },

            beforeSend: function() {
              submitStart();
            },

            submitEnd: function() {
              submitEnd();
            },
            success: function(data) {
              if ($.isPlainObject(data) && data.state === 200) {
                if (data.message) {

                  alert(data.message, "alert-success");
                  document.location.href = data.pay_link;
                  //clear all fields
                  $form.trigger("reset");
                } else if (data.error) {
                  alert(data.error, "alert-danger");
                }
              } else {
                alert('Failed to response', "alert-danger");
              }
              $form.find("[type=submit]").prop("disabled", false).button('reset');

              submitEnd();
            }
          });
        }
      });
  });

  $(function() {
    var utmCookie = {
      cookieNamePrefix: "",

      utmParams: ["utm_source",
        "utm_medium",
        "utm_campaign",
        "utm_term",
        "utm_content"
      ],

      cookieExpiryDays: 1,

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

    utmCookie.writeReferrerOnce();

    if (utmCookie.utmPresentInUrl()) {
      utmCookie.writeUtmCookieFromParams();
    }
  });

  $(function() {
  
    var console = window.console || {
      log: function() {}
    };
    var URL = window.URL || window.webkitURL;
    var $image = $('#image');
    var width = 900;
    var height = 600;
    var $dataX = $('#dataX');
    var $dataY = $('#dataY');
    var $avatar = $('.avatar');
    var $dataHeight = $('#dataHeight');
    var $dataWidth = $('#dataWidth');
    var $dataRotate = $('#dataRotate');
    var $dataScaleX = $('#dataScaleX');
    var $dataScaleY = $('#dataScaleY');
    var options = {
      aspectRatio: width / height,
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
    var $avatarRatio = $('.js-ratio');
    var $result = $("#avatar-result");

    var trimStr = function(s) {
      s = s.replace(/^-/, '');
      return s.replace(/-$/, '');
    }

    var transliterate = function(text) {
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

      result = trimStr(result);
      return result;
    }


    var ratio = function(e) {
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
    }

    var alert = function(msg, status) {
      var $alert = [

        '<div class="alert alert-' + status + ' avatar-alert alert-dismissable fade show" role="alert">',
        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
        msg,
        '</div>'
      ].join('');

      $result.html($alert);
      if (status === "success") {
        setTimeout(function() {
          $result.slideUp(function() {
            $result.html('');
          });
        }, 3000);
      }
    }

    var submitFail = function(msg) {
      alert(msg, "danger");
    }

    var submitDone = function(msg) {
      alert(msg, "success");
    }
    var getNames = function() {
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

    }

    $avatarRatio.on('change', ratio);

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();


    // Cropper
    $image.cropper(options);


    // Buttons
    if (!$.isFunction(document.createElement('canvas').getContext)) {
      $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
    }

    if (typeof document.createElement('cropper').style.transition === 'undefined') {
      $('button[data-method="rotate"]').prop('disabled', true);
      $('button[data-method="scale"]').prop('disabled', true);
    }

    // Options
    $('.docs-toggles').on('change', 'input', function() {
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

        options.ready = function() {
          $image.cropper('setCropBoxData', cropBoxData);
          $image.cropper('setCanvasData', canvasData);
        };
      } else if (type === 'radio') {
        options[name] = $this.val();
      }

      $image.cropper('destroy').cropper(options);
    });


    // Methods
    $('.docs-buttons').on('click', '[data-method]', function() {
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
              try {

                $(".loading").fadeIn();
                var base64 = result.toDataURL("image/jpeg");
                var formData = new FormData();
                $('#frameImage').attr('src', base64);
                $('#photo1').val(base64);
                $('#uploadBtnText').html('Загрузить другое фото');
                $('#uploadBtn').addClass('btn-red');
                $avatar.addClass("avatar--active");
                // console.log(base64 + "\\nWidth: " + result.width + "\nHeight: " +  result.height);
              } catch (error) {
                console.log('Error: ' + error.message);
                $(".loading").fadeOut();
              }

              $image.cropper('getCroppedCanvas').toBlob(function(blob) {

                var croppedImg = $image.cropper('getCroppedCanvas', {width: width, height: height}).toDataURL(blob.type);

                var formData = new FormData();

                formData.append('croppedImage', croppedImg);

                formData.append('croppedData', blob);

                formData.append('filename', getNames());

                $.ajax('/crop.php', {
                  method: "POST",
                  dataType: 'json',
                  data: formData,
                  processData: false,
                  contentType: false,
                  success: function(data) {
                    if ($.isPlainObject(data) && data.state === 200) {
                      $(".loading").fadeOut();
                      $('#myModal').modal('hide');
                      if (data.message) {
                        alert(data.message, "alert-success");
                        document.location.href = data.pay_link;
                        //clear all fields
                      } else if (data.error) {
                        alert(data.error, "alert-danger");
                      }
                      if (data.result) {
                        $(".avatar-filename").val(data.result);
                      }
                    } else {
                      alert('Failed to response', "danger");
                    }

                    $(".loading").fadeOut();
                  },

                  error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(textStatus || errorThrown, "danger");

                    $(".loading").fadeOut();
                  },

                  complete: function() {
                    $(".loading").fadeOut();
                  }
                });
              });
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
    $(document.body).on('keydown', function(e) {

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
    var $image = $('#image');
    if (URL) {
      $inputImage.change(function() {
        var files = this.files;
        var file;

        if (!$image.data('cropper')) {
          return;
        }

        if (files && files.length) {
          file = files[0];

          if (/^image\/\w+$/.test(file.type)) {
            uploadedImageType = file.type;
            $('#myModal').modal('show');

            if (uploadedImageURL) {
              URL.revokeObjectURL(uploadedImageURL);
            }

            uploadedImageURL = URL.createObjectURL(file);
            $image.cropper('destroy');
            $("#myModal").on("shown.bs.modal", function() {
              $image.attr('src', uploadedImageURL).cropper(options);
            });
            $inputImage.val('');
          } else {
            window.alert('Please choose an image file.');
          }
        }
      });
    } else {
      $inputImage.prop('disabled', true).parent().addClass('disabled');
    }
  });

  $(function() {
    function getCookie(name) {
      var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
      ));
      return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    var utm = ['utm_source', 'utm_medium', 'utm_term', 'utm_campaign', 'utm_content'];
    var getParams = '';

    for (var i = 0; i < utm.length; i++) {
      var value = getCookie(utm[i]);
      console.log(value);
      if (value !== undefined) {
        getParams += '&' + utm[i] + '=' + value;
      }
    }
    if (getParams !== '') {
      getParams.slice(0, -1);

      var separator = (window.location.href.indexOf("?")===-1)?"?":"&";
      window.history.pushState("", "", window.location.href + separator + getParams);
    }
  });

  $(function() {
    if (document.getElementById( 'grid' )) {
      new AnimOnScroll( document.getElementById( 'grid' ), {
        minDuration : 0.4,
        maxDuration : 0.7,
        viewportFactor : 0.2,
        shownElements: 5,
        responsiveBtnMore: true,
        showAll: true
      } );
    }
  });


  // Init Wowjs
  $(window).on("load", function() {
    var wow = new WOW({
        boxClass:     'js-wow',      // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset:       0,          // distance to the element when triggering the animation (default is 0)
        mobile:       false       // trigger animations on mobile devices (true is default)
    });
    wow.init();
  });

})(jQuery); // End of use strict
