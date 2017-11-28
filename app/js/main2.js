Raven.config('https://78be30f059544a8ea1eab0bbae62a897@sentry.io/251004').install()
Raven.context(function () {

  (function(global, factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], function($) {
          return factory($, global, global.document, global.Math);
        });
    } else if (typeof exports === "object" && exports) {
        module.exports = factory(require('jquery'), global, global.document, global.Math);
    } else {
        factory(jQuery, global, global.document, global.Math);
    }
  })(typeof window !== 'undefined' ? window : this, function($, window, document, Math, undefined) {

    'use strict';

    var BACK_TO_TOP =             "js-back-to-top";
    var BACK_TO_TOP_SEL =         '.' + BACK_TO_TOP;

    var SCROLL_TRIGGER =          'js-scroll-trigger';
    var SCROLL_TRIGGER_SEL =      '.' + SCROLL_TRIGGER + '[href*="#"]:not([href="#"])';

    var SELECT =                  'form-control--select';
    var SELECT_SEL =              '.' + SELECT;

    var SELECT_ARROW =            'select2-selection__arrow';
    var SELECT_ARROW_SEL =        '.' + SELECT_ARROW;


    var console = window.console || { log: function () {} };
    var $window = $(window);
    var $document = $(document);

    function Init($element) {

      this.$scrollTrigger = $(SCROLL_TRIGGER_SEL);

      this.$select2 = $(SELECT_SEL);
      this.$select2Arrow = $(SELECT_ARROW_SEL);

      this.$container = $element;

      this.$avatarView = this.$container.find('.avatar-view');
      this.$avatar = this.$avatarView.find('img');
      this.$avatarModal = this.$container.find('#avatar-modal');
      this.$loading = this.$container.find('.loading');

      this.$avatarForm = this.$avatarModal.find('.avatar-form');
      this.$avatarUpload = this.$avatarForm.find('.avatar-upload');
      this.$avatarSrc = this.$avatarForm.find('.avatar-src');
      this.$avatarData = this.$avatarForm.find('.avatar-data');
      this.$avatarInput = this.$avatarForm.find('.avatar-input');
      this.$avatarSave = this.$avatarForm.find('.avatar-save');
      this.$avatarBtns = this.$avatarForm.find('.avatar-btns');

      this.$avatarWrapper = this.$avatarModal.find('.avatar-wrapper');
      this.$avatarPreview = this.$avatarModal.find('.avatar-preview');

      this.init();
    }

    Init.prototype = {
      constructor: Init,

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

        this.initTooltip();
        this.initModal();
        this.initSelect2();
        this.addListener();
      },

      addListener: function () {
        this.$scrollTrigger.on('click', $.proxy(this.clickScrollTrigger, this));
        this.$avatarView.on('click', $.proxy(this.click, this));
        this.$avatarInput.on('change', $.proxy(this.change, this));
        this.$avatarForm.on('submit', $.proxy(this.submit, this));
        this.$avatarBtns.on('click', $.proxy(this.rotate, this));
      },

      initTooltip: function () {
        this.$avatarView.tooltip({
          placement: 'bottom'
        });
      },

      initModal: function () {
        this.$avatarModal.modal({
          show: false
        });
      },

      initSelect2: function() {

        if ($.fn.select2) {
          $.fn.select2.amd.define('select2/i18n/ru',[],function () {
          // Russian
            return {
              errorLoading: function () {
                return 'Результат не может быть загружен.';
              },
              inputTooLong: function (args) {
                var overChars = args.input.length - args.maximum;
                var message = 'Пожалуйста, удалите ' + overChars + ' символ';
                if (overChars >= 2 && overChars <= 4) {
                  message += 'а';
                } else if (overChars >= 5) {
                  message += 'ов';
                }
                return message;
              },
              inputTooShort: function (args) {
                var remainingChars = args.minimum - args.input.length;

                var message = 'Пожалуйста, введите ' + remainingChars + ' или более символов';

                return message;
              },
              loadingMore: function () {
                return 'Загружаем ещё ресурсы…';
              },
              maximumSelected: function (args) {
                var message = 'Вы можете выбрать ' + args.maximum + ' элемент';

                if (args.maximum  >= 2 && args.maximum <= 4) {
                  message += 'а';
                } else if (args.maximum >= 5) {
                  message += 'ов';
                }

                return message;
              },
              noResults: function () {
                return 'Ничего не найдено';
              },
              searching: function () {
                return 'Поиск…';
              }
            };
          });
        }

        if (this.$select2.length) {
          this.$select2.select2({
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
          
          $(this.$select2Arrow).html('<svg class="svg svg--arrow-down select2-selection__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img"><use xlink:href="img/sprite.svg#arrow-down"></use></svg>');
        }
      },

      initPreview: function () {
        var url = this.$avatar.attr('src');

        this.$avatarPreview.html('<img src="' + url + '">');
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
        this.initPreview();
      },

      clickScrollTrigger: function() {
        // Trigger anchor scroll
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
          this.$img.cropper({
            aspectRatio: 1,
            preview: this.$avatarPreview.selector,
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
          });

          this.active = true;
        }

        this.$avatarModal.one('hidden.bs.modal', function () {
          _this.$avatarPreview.empty();
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
              '<div class="alert alert-danger avatar-alert alert-dismissable">',
                '<button type="button" class="close" data-dismiss="alert">&times;</button>',
                msg,
              '</div>'
            ].join('');

        this.$avatarUpload.after($alert);
      }
    };

    $(function () {
      return new Init($('#crop-avatar'));
    });

  });
});