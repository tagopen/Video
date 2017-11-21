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

  // Select2 
  $(function() {
    var $selectElement = $('.form-control--select');

    if ($selectElement) {
      $selectElement.select2({
        minimumResultsForSearch: Infinity,
        placeholder: "--Select something (default placeholder)--", 
        width: 'resolve'
      });
      
      $('.select2-selection__arrow').html('<svg class="svg svg--arrow-down select2-selection__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img"><use xlink:href="img/sprite.svg#arrow-down"></use></svg>');
    }
  });
  
  // Change select with childrean names
  $(function() {
    var $childrean = $("[data-gender]");
    
    $childrean.next(".select2-container").hide();

/*
    $(".js-gender").each(function() {
      if ($(this).prop("checked")) {
        var target = $(this).siblings("[data-gender]").data("gender"),
            $select = $(target);
        $select.next(".select2-container")
             .show();
        $select.siblings(".select")
               .next(".select2-container")
               .hide();
      } else {
        var target = $(".js-gender").eq(0).siblings("[data-gender]").data("gender"),
            $select = $(target);
        $select.next(".select2-container")
             .show();
        $select.siblings(".select")
               .next(".select2-container")
               .hide();

      }
    });*/

    $(".js-gender").on('change click', function() {
      var target = $(this).siblings("[data-gender]").data("gender"),
          $select = $(target);

      $select.next(".select2-container")
             .show();
      $select.siblings(".select")
             .next(".select2-container")
             .hide();
    });
  });
  
  // fixed panel close
  $(function() {
    var timeoutID = setTimeout ( function() {
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
    $("#video__modal .modal__iframe").attr('src', 'https://www.youtube.com/embed/kg-qEHftDd8?ecver=1&autoplay=1&showinfo=0&mute=0&iv_load_policy=3&showsearch=0');
  });

  $('#video__modal').on('hidden.bs.modal', function() {
    $("#video__modal .modal__iframe").attr('src', 'https://www.youtube.com/embed/kg-qEHftDd8?ecver=1&autoplay=0&showinfo=0&mute=1&iv_load_policy=3&showsearch=0');
  });
  
  // Tabs
  $(function() {
    $("[data-tabs-control]").on('click', function(e) {
      var $indexControl = $("[data-tabs-index]"),
          control = $(this).data('tabs-control'),
          index = $(this).data('tabs-index'),
          target = $(this).data('tabs-toggle'),
          $tabs = $("[data-tabs=" + target + "]");

      if (typeof index !== undefined) {

      }

      $tabs.each(function() {
        var  $item = $(this).find('.tabs__item'),
             $currentItem = $item.filter('.tabs__item--active'),
             activeItem = $currentItem.index() - 1;

        // Tabs control button
        if (control === 'prev') {
          activeItem = activeItem - 1;
        } else if (control === 'next') {
          activeItem = activeItem + 1;
        } else if (control === 'index') {
          activeItem = parseInt(index, 10);
          $indexControl.removeClass('tabs-control__link--active').eq(activeItem).addClass('tabs-control__link--active');
        }

        $item.removeClass('tabs__item--active').eq(activeItem).addClass('tabs__item--active');
        
      });
    e.preventDefault();
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
        newName = function() {
          var $childrean = $("[data-childrean-item]");

          $childrean.each(function() {
            var $check = $(this).find("[data-new-name]"),
                target = $check.data("new-name"),
                $group = $(target),
                $input = $group.find("input.form-control"),
                $select = $group.find(".select"),
                $selectContainer = $select.next(".select2-container"),
                $gender     = $(this).find(".js-gender"),
                genderVal = $gender.val(),
                selectIndex = 0;


            if(genderVal !== "" && !isNaN(genderVal)) {
              var gender = parseInt(genderVal, 10);
              console.log("genderVal", gender);
              if (gender === 0) {
                selectIndex = 0;
              } else {
                selectIndex = 1;
              }

            }
            console.log("selectIndex", selectIndex);



            if ($check.prop("checked")) {
              $input.fadeIn();
              $input.prop('required', true);
              $select.prop('required', false);
              $selectContainer.fadeOut(0);
            } else {
              $input.fadeOut(0);
              $input.prop('required', false);
              $select.eq(selectIndex).prop('required', true);
              $selectContainer.eq(selectIndex).fadeIn();
              $select.eq(+!selectIndex).prop('required', false);
              $selectContainer.eq(+!selectIndex).fadeOut(0);
            }
          });
        };

    newName();

    $checkbox.on("click change", function() {
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

  (function (factory) {
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
})(function ($) {

  'use strict';

  var console = window.console || { log: function () {} };

  function CropAvatar($element, $modalEl) {
    var _this = this;


    this.$container = $element;
    this.$modal = $modalEl;

    this.$newnames = $("[data-new-name]");

    this.$btnToggle = $('.js-file');
    this.$avatarView = this.$container.find('.avatar-view');
    this.$avatar = this.$avatarView.find('img');
    this.$avatarModal = this.$modal;
    this.$loading = this.$container.find('.loading');

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
      aspectRatio: 3/2,/*
      minCropBoxWidth: 300,
      minCropBoxHeight: 200,*/
      crop: function (e) {

        var json = [
              '{"x":' + e.x,
              '"y":' + e.y,
              '"height":' + e.height,
              '"width":' + e.width,
              '"rotate":' + e.rotate + '}'
            ].join();
        _this.$avatarData.val(json);
      }
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

    init: function () {
      this.support.datauri = this.support.fileList && this.support.blobURLs;

      if (!this.support.formData) {
        this.initIframe();
      }

      this.initModal();
      this.addListener();
    },

    addListener: function () {
      this.$btnToggle.on('click', $.proxy(this.click, this));
      this.$avatarInput.on('change', $.proxy(this.change, this));
      this.$avatarForm.on('submit', $.proxy(this.submit, this));
      this.$avatarBtns.on('click', $.proxy(this.rotate, this));
      this.$avatarRatio.on('change', $.proxy(this.ratio, this));

    },

    initModal: function () {
      this.$avatarModal.modal({
        show: false
      });
    },

    initIframe: function () {
      var target = 'upload-iframe-' + (new Date()).getTime();
      var $iframe = $('<iframe>').attr({
            name: target,
            src: ''
          });
      var _this = this;

      // Ready ifrmae
      $iframe.one('load', function () {

        // respond response
        $iframe.on('load', function () {
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

    click: function () {
      this.$avatarModal.modal('show');
      this.getNames();
    },

    change: function () {
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

    submit: function () {
      if (!this.$avatarSrc.val() && !this.$avatarInput.val()) {
        return false;
      }

      if (this.support.formData) {
        this.ajaxUpload();
        return false;
      }
    },

    rotate: function (e) {
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
        var $this       = $(this),
            targetClass = $this.data(),
            $group      = $(targetClass.newName),
            $input      = $group.find("input.form-control"),
            $select     = $group.find(".select"),
            $gender     = $group.closest("[data-childrean-item]").find(".js-gender"),
            gender      = $gender.val();
        
        if(gender !== "" && !isNaN(gender)) {
          var gender = parseInt(gender, 10);
          genderVal = (gender === 0) ? "m" : "f";
          countgender ++;
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
                      
      for(var i=0; i < text.length; i++) {
          // Если символ найден в массиве то меняем его
          if(transl[text[i]] != undefined) {
               if(curent_sim != transl[text[i]] || curent_sim != space){
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


    isImageFile: function (file) {
      if (file.type) {
        return /^image\/\w+$/.test(file.type);
      } else {
        return /\.(jpg|jpeg|png|gif)$/.test(file);
      }
    },

    startCropper: function () {
      var _this = this;

      if (this.active) {
        this.$img.cropper('replace', this.url);
      } else {
        this.$img = $('<img src="' + this.url + '">');
        this.$avatarWrapper.empty().html(this.$img);
        this.$img.cropper(this.options);

        this.active = true;
      }

      this.$avatarModal.one('hidden.bs.modal', function () {
        _this.stopCropper();
      });
    },

    stopCropper: function () {
      if (this.active) {
        this.$img.cropper('destroy');
        this.$img.remove();
        this.active = false;
      }
    },

    ajaxUpload: function () {
      var url = this.$avatarForm.attr('action');
      var data = new FormData(this.$avatarForm[0]);
      var _this = this;
      var result;
      for (var entry of data.entries())
      {
          result[entry[0]] = entry[1];
      }
      result = JSON.stringify(result)
      console.log(result);

      $.ajax(url, {
        type: 'post',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,

        beforeSend: function () {
          _this.submitStart();
        },

        success: function (data) {
          _this.submitDone(data);
        },

        error: function (XMLHttpRequest, textStatus, errorThrown) {
          _this.submitFail(textStatus || errorThrown);
        },

        complete: function () {
          _this.submitEnd();
        }
      });
    },

    syncUpload: function () {
      this.$avatarSave.click();
    },

    submitStart: function () {
      this.$loading.fadeIn();
    },

    submitDone: function (data) {
      console.log(data);

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

    submitFail: function (msg) {
      this.alert(msg);
    },

    submitEnd: function () {
      this.$loading.fadeOut();
    },

    cropDone: function () {
      this.$avatarForm.get(0).reset();
      this.$avatar.attr('src', this.url);
      this.stopCropper();
      this.$avatarModal.modal('hide');
    },

    alert: function (msg) {
      var $alert = [
            '<div class="alert alert-danger avatar-alert alert-dismissable fade show" role="alert">',
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>',
              msg,
            '</div>'
          ].join('');

      this.$avatarUpload.after($alert);
    }
  };

  $(function () {
    return new CropAvatar($('#crop-avatar'), $('#avatar-modal'));
  });

});





})(jQuery); // End of use strict
