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
    });

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
        newName = function($item) {
          var target = $item.data("new-name"),
              $group = $(target),
              $input = $group.find("input.form-control"),
              $select = $group.find(".select"),
              $selectContainer = $select.next(".select2-container");
          if ($item.prop("checked")) {
            $input.fadeIn();
            $input.prop('required', true);
            $select.prop('required', false);
            $selectContainer.fadeOut(0);
          } else {
            $input.fadeOut(0);
            $input.prop('required', false);
            $select.prop('required', true);
            $selectContainer.fadeIn();
          }
        };
    $checkbox.each(function() {
      newName($(this));
    });

    $checkbox.on("click change", function() {
      newName($(this));
    });
  });

  $(function () {

    var console = window.console || { log: function () {} };
    var URL = window.URL || window.webkitURL;
    var $image = $('#image');
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

  });




})(jQuery); // End of use strict
