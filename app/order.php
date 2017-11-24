<?php 
  ini_set("display_errors","1");
  ini_set("display_startup_errors","1");
  ini_set('error_reporting', E_ALL);

  require_once 'system/viewClass.php';

  $view = new viewClass;
  $discount = $view -> getDiscount();
  $names = $view -> getChildreanName();
  $male = $names["male"];
  $female = $names["female"];
  $price = $view -> getProductPrice();
    
?>
<!DOCTYPE html>
<html class="html" lang="ru" prefix="og: http://ogp.me/ns#">
  <head>
    <title>Видео-поздравление от Дедушки Мороза</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <!-- Meta SEO - Description, Keywords, Title-->
    <meta name="title" content="Именное видеопоздравление для вашего ребенка от Дедушки Мороза"/>
    <meta name="description" content="Удивите своего ребенка именным видео-поздравлением от Дедушки Мороза. Сказочный герой несколько раз назовет ребенка по имени и посмотрит его фотографию. Восторг и радость вашему малышу гарантированы! "/>
    <meta name="keywords"/>
    <!-- Multilanguage localization-->
    <link rel="alternate" href="/" hreflang="x-default"/>
    <!-- Mobile viewport optimization-->
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="MobileOptimized" content="320"/>
    <!--[if IEMobile]><meta http-equiv='cleartype' content='on' /><![endif]-->
    <!-- Replace favicon.ico and apple-touch-icon.png-->
    <link rel="shortcut icon" type="image/png" href="img/logo/favicon.png">
    <link rel="apple-touch-icon" type="image/png" href="img/logo/apple-touch-icon.png">
    <!-- Disables automatic  of possible phone numbers and address in Safari on iOS-->
    <meta name="format-detection" content="telephone=no"/>
    <meta name="format-detection" content="address=no"/>
    <!-- Microformats Open Graph-->
    <meta property="og:title" content="Именное видеопоздравление от Дедушки Мороза с фотографией ребенка"/>
    <meta property="og:description" content="Удивите своего ребенка именным видео-поздравлением от Дедушки Мороза. Сказочный герой несколько раз назовет ребенка по имени и посмотрит его фотографию. Восторг и радость вашему малышу гарантированы! "/>
    <meta property="og:type" content="website"/>
    <meta property="og:locale" content="ru_RU"/>
    <meta property="og:image" content="http://video-pozdravlenie.com/img/logo/microformat.png"/>
    <meta property="og:image:type" content="image/png"/>
    <meta property="og:url" content="http://video-pozdravlenie.com/"/>
    <!-- Microformats Twitter Cards-->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@flickr"/>
    <meta name="twitter:title" content="Именное видеопоздравление от Дедушки Мороза с фотографией ребенка"/>
    <meta name="twitter:description" content="Удивите своего ребенка именным видео-поздравлением от Дедушки Мороза. Сказочный герой несколько раз назовет ребенка по имени и посмотрит его фотографию. Восторг и радость вашему малышу гарантированы! "/>
    <meta name="twitter:image" content="http://video-pozdravlenie.com/img/logo/microformat.png"/>
    <!-- build:css css/bundle.min.css-->
    <!-- Fonts CSS-->
    <link rel="stylesheet" href="css/fonts.css">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Font-Awesome CSS-->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- endbuild-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file://--><!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
  </head>
  <body class="body">
    <header class="header header--100vh">
      <article class="intro">
        <section class="intro__menu menu">
          <div class="container">
            <div class="row flex-md-row-reverse justify-content-between">
              <div class="col-24 col-md-6">
                <div class="header__call h-call">
                  <div class="row justify-content-center">
                    <div class="col-auto col-md-24 text-left text-md-right"><a class="h-call__number h-call__number--white" href="tel:380985430430">098 5 430 430</a></div>
                    <div class="col-auto col-md-24 text-right"> <a class="h-call__button" href="#callback" data-toggle="modal">Заказать звонок</a></div>
                  </div>
                </div>
              </div>
              <div class="col-24 col-md-14 col-lg-10">
                <a class="header__logo logo logo--white" href="/">
                  <div class="row">
                    <div class="col-24 col-md-auto">
                      <div class="logo__image"><img class="img-fluid logo__img" src="img/logo/logo.png" alt="logo"></div>
                    </div>
                    <div class="col-24 col-md-auto logo__col align-items-center"> 
                      <p class="logo__text">Именное видеопоздравление <br>для вашего ребенка от Дедушки Мороза</p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>
        <section class="h-content intro__content h-100">
          <div class="container h-100">
            <div class="row justify-content-center flex-lg-row-reverse h-100">
              <div class="col-24 h-100">
                <form class="form h-100" action="system/model.php" method="post" novalidate>
                  <div class="tabs h-100" data-tabs="test-tabs">
                    <div class="tabs__control tabs-control">
                      <div class="tabs-control__item"><a class="tabs-control__link tabs-control__link--active" href="#" data-tabs-control="index" data-tabs-toggle="test-tabs" data-tabs-index="0">Шаг 1</a></div>
                      <div class="tabs-control__item"><a class="tabs-control__link" href="#" data-tabs-control="index" data-tabs-toggle="test-tabs" data-tabs-index="1">Шаг 2</a></div>
                      <div class="tabs-control__item"><a class="tabs-control__link" href="#" data-tabs-control="index" data-tabs-toggle="test-tabs" data-tabs-index="2">Шаг 3</a></div>
                    </div>
                    <div class="tabs__item tabs__item--active">
                      <div class="row">
                        <div class="col-24">
                          <h2 class="heading tabs__heading">Сколько детей нужно поздравить?</h2>
                        </div>
                        <div class="col-24">
                          <div class="tabs__radio-group">
                            <div class="row">
                              <div class="col-12 col-md-auto text-center">
                                <label class="radio-btn">
                                  <input class="radio-btn__control" id="rbtn11" type="radio" name="childrean" data-childrean="1" value="1" checked>
                                  <label class="radio-btn__box" for="rbtn11"><i class="radio-btn__icon"> </i>1 ребенок</label>
                                </label>
                              </div>
                              <div class="col-12 col-md-auto text-center">
                                <label class="radio-btn">
                                  <input class="radio-btn__control" id="rbtn12" type="radio" name="childrean" data-childrean="2" value="2">
                                  <label class="radio-btn__box" for="rbtn12"><i class="radio-btn__icon"></i>2 ребенка</label>
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-24 col-md-12" data-childrean-item="0">
                          <fieldset class="form-group">
                            <select class="form-control form-control--select select js-gender" data-placeholder="Выберите пол ребенка" name="child1[gender]" required>
                              <option></option>
                              <option value="1">Мужской</option>
                              <option value="0">Женский</option>
                            </select>
                          </fieldset>
                          <fieldset class="form-group" id="new1">
                            <select class="form-control form-control--select select" data-placeholder="Выберите имя из списка" name="child1[name][male]" data-gender="male" required>
                              <option></option>
                              <?php foreach ($male as $value) {
                                $name = $value["firstname"];
                              ?>
                              <option value="<?=$name?>"><?=$name?></option>

                              <?php } ?>
                            </select>
                            <select class="form-control form-control--select select" data-placeholder="Выберите имя из списка" name="child1[name][female]" data-gender="female">
                              <option></option>
                              <?php foreach ($female as $value) {
                                $name = $value["firstname"];
                              ?>
                              <option value="<?=$name?>"><?=$name?></option>

                              <?php } ?>
                            </select>
                            <input class="form-control" type="text" placeholder="Введите новое имя" name="child1[newname][name]">
                          </fieldset>
                          <label class="radio-btn radio-btn--size">
                            <input class="radio-btn__control" id="rbtn21" type="checkbox" name="child1[newname][trigger]" data-new-name="#new1">
                            <label class="radio-btn__box" for="rbtn21"><i class="radio-btn__icon"></i>Добавить имя ребенка</label>
                          </label>
                          <div class="btn-groups text-center text-md-left">
                            <button class="btn btn--default btn--sm" data-tabs-control="next" data-tabs-toggle="test-tabs">Далее</button>
                          </div>
                        </div>
                        <div class="col-24 col-md-12" data-childrean-item="1">
                          <fieldset class="form-group">
                            <select class="form-control form-control--select select js-gender" data-placeholder="Выберите пол ребенка" name="child2[gender]" required>
                              <option></option>
                              <option value="1">Мужской</option>
                              <option value="0">Женский</option>
                            </select>
                          </fieldset>
                          <fieldset class="form-group" id="new2">
                            <select class="form-control form-control--select select" data-placeholder="Выберите имя из списка" name="child2[name][male]" data-gender="male" required>
                              <option></option>
                              <?php foreach ($male as $value) {
                                $name = $value["firstname"];
                              ?>
                              <option value="<?=$name?>"><?=$name?></option>

                              <?php } ?>
                            </select>
                            <select class="form-control form-control--select select" data-placeholder="Выберите имя из списка" name="child2[name][female]" data-gender="female">
                              <option></option>
                              <?php foreach ($female as $value) {
                                $name = $value["firstname"];
                              ?>
                              <option value="<?=$name?>"><?=$name?></option>

                              <?php } ?>
                            </select>
                            <input class="form-control" type="text" placeholder="Введите новое имя" name="child2[newname][name]">
                          </fieldset>
                          <label class="radio-btn radio-btn--size">
                            <input class="radio-btn__control" id="rbtn22" type="checkbox" name="child2[newname][trigger]" data-new-name="#new2">
                            <label class="radio-btn__box" for="rbtn22"><i class="radio-btn__icon"></i>Добавить имя ребенка</label>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="tabs__item">
                      <div class="row">
                        <div class="col-24">
                          <h2 class="heading tabs__heading">Загрузите фотографию ребенка</h2>
                          <h2 class="heading tabs__heading">Фотография появится в книге Дедушки Мороза</h2>
                        </div>
                        <div class="col-24 col-md-12">
                          <div class="btn-groups text-left">
                            <button class="form-control btn--file js-file" type="button">Загрузите фотографию
                              <svg class="svg svg--clip btn__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
                                <use xlink:href="img/sprite.svg#clip"></use>
                              </svg>
                            </button>
                          </div>
                        </div>
                        <div class="col-24 col-md-12">         
                          <div class="avatar" id="crop-avatar">
                            <!-- Current avatar-->
                            <div class="avatar-view avatar__photo"><img class="img-fluid avatar__img" alt="Avatar">
                              <input id="image" type="hidden" name="image">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="btn-groups text-center">
                        <div class="row">
                          <div class="col-24 col-md-8 col-lg-6 text-center text-md-left">
                            <button class="btn btn--default btn--sm" data-tabs-control="next" data-tabs-toggle="test-tabs">Далее</button>
                          </div>
                          <div class="col-24 col-md-6 text-center text-md-left"><a class="quiz__btn quiz__btn--prev test__btn--prev" href="#" data-tabs-control="prev" data-tabs-toggle="test-tabs">Назад</a></div>
                        </div>
                      </div>
                    </div>
                    <div class="tabs__item">
                      <div class="row flex-md-row-reverse justify-content-between">
                        <div class="col-24 col-md-12 col-lg-10 offset-lg-2">
                          <h2 class="heading tabs__heading">Детали заказа</h2>
                          <div class="total-price">
                            <div class="row justify-content-between total-row">
                              <div class="col-auto"><span class="tb-price">Стоимость пакета:</span></div>
                              <div class="col-auto"><span class="nt-price"><?= $price?> грн</span></div>
                            </div>
                            <div class="row justify-content-between total-row">
                              <div class="col-auto"><span class="tb-price">Ваша скидка:</span></div>
                              <div class="col-auto"><span class="nt-price">-150 грн</span></div>
                              <input class="js-discount" type="hidden" name="discount" value="<?=$discount?>">
                            </div>
                            <div class="row justify-content-between total-row">
                              <div class="col-auto"><span class="tb-price">Итоговая цена:</span></div>
                              <div class="col-auto"><span class="nt-price">100 грн</span></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-24 col-md-12 col-lg-10">
                          <h2 class="heading tabs__heading">Контактные данные</h2>
                          <fieldset class="form-group form__group--select">
                            <input class="form-control" type="text" name="firstname" placeholder="Введите ваше имя" required>
                          </fieldset>
                          <fieldset class="form-group form__group--select">
                            <input class="form-control" type="tel" name="phone" placeholder="Введите номер телефона" required>
                          </fieldset>
                          <fieldset class="form-group form__group--select">
                            <input class="form-control" type="email" name="email" placeholder="Введите ваш E-mail">
                          </fieldset>
                          <p class="tabs__text">На указаный вами e-mail придёт ссылка для скачивания видеопоздравления. Чтобы избежать попадания нашего письма в спам, рекомендуем не указывать адрес корпоративной почты, а указывать ваш личный E-mail</p>
                        </div>
                        <div class="col-24">
                          <div class="btn-groups form__btn-groups">
                            <div class="row">
                              <div class="col-24 col-md-8 col-lg-6 text-center text-md-left">
                                <div class="btn-groups">
                                  <button class="btn btn--default btn--sm" name="form" value="Order" type="submit" data-loading-text="&lt;i class='fa fa-circle-o-notch fa-spin'&gt;&lt;/i&gt; Файл отправляется...">Перейти к оплате</button>
                                </div>
                              </div>
                              <div class="col-24 col-md-6 text-center text-md-left"><a class="quiz__btn quiz__btn--prev test__btn--prev" href="#" data-tabs-control="prev" data-tabs-toggle="test-tabs">Назад</a></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </section>
      </article>
    </header>
    <main class="main">
    </main>
    <div class="modal fade" id="callback" tabindex="-1" role="dialog" aria-labelledby="callbackLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"><i class="d-none d-sm-inline-block ic ic--wreath modal__icon modal__icon--1"></i><i class="d-none d-lg-inline-block ic ic--manager modal__icon modal__icon--2"></i>
          <button class="close modal__close" type="button" data-dismiss="modal" aria-label="Close">
            <svg class="svg svg--close close__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
              <use xlink:href="img/sprite.svg#close"></use>
            </svg>
          </button>
          <div class="modal-body">
            <div class="row justify-content-center justify-content-lg-start">
              <div class="col-24 col-sm-18 col-md-24 col-lg-16">
                <h5 class="mb-3 dm-descr" id="callbackLabel">Оставьте свой номер телефона что бы мы вам перезвонили!</h5>
                <p class="mb-3 sv-descr">Если у вас возникли вопросы или вы хотите оформить заказ по телефону, то укажите ваш номер телефона, что бы менеджер Екатерина вам перезвонила</p>
              </div>
              <div class="col-24 col-sm-18 col-md-24 col-lg-12">
                <form class="form js-form" action="system/modal.php" method="post">
                  <fieldset class="form-group">
                    <input class="form-control" type="tel" name="phone" placeholder="Введите ваш номер телефона" required>
                  </fieldset>
                  <div class="btn-groups form__btn-groups">
                    <button class="btn btn--default btn--size" name="form" value="Модалка" type="submit" data-loading-text="&lt;i class='fa fa-circle-o-notch fa-spin'&gt;&lt;/i&gt; Файл отправляется...">Перезвоните мне</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="kid modal fade" id="kid__modal" tabindex="-1" role="dialog" aria-labelledby="callbackLabel" aria-hidden="true">
      <div class="modal-dialog kid__dialog" role="document">
        <div class="modal-content kid__content"><i class="d-none d-md-inline-block ic ic--babochka kid__icon kid__icon--1"></i><i class="d-none d-md-inline-block ic ic--sharik kid__icon kid__icon--2"></i>
          <button class="close modal__close" type="button" data-dismiss="modal" aria-label="Close">
            <svg class="svg svg--close close__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
              <use xlink:href="img/sprite.svg#close"></use>
            </svg>
          </button>
          <div class="modal-body">
            <div class="row justify-content-center">
              <div class="col-24 text-center"> 
                <div class="mb-3 kid__descr">Заказы на поздравление двоих детей в одном видео выполняются в течении 2-х дней. Мы запишем имена и согласуем с вами их звучание. Процедура записи имен, которых нет в списке аналогична.</div>
                <div class="mb-3 kid__text">Переходите на следующий шаг, чтобы указать нужные имена. На странице оформления заказа вы также сможете загрузить фотографии детей и получить скидку за репост!</div><a class="btn btn--default btn--size" href="#">Перейти к оформлению заказа</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="video__modal" tabindex="-1" role="dialog" aria-labelledby="callbackLabel" aria-hidden="true">
      <div class="modal-dialog modal-video" role="document">
        <div class="modal-content modal-video__content">
          <button class="close modal__close modal__close--video" type="button" data-dismiss="modal" aria-label="Close">
            <svg class="svg svg--close close__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
              <use xlink:href="img/sprite.svg#close"></use>
            </svg>
          </button>
          <div class="modal-body modal__body">
            <div class="modal__iframe">
              <iframe class="modal__iframe" src="https://www.youtube.com/embed/kg-qEHftDd8" frameborder="0" gesture="media" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cropping modal-->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg"> 
        <div class="modal-content modal-content--default">
          <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <!-- Upload image and data-->
              <div class="avatar-upload">
                <input class="avatar-src" type="hidden" name="avatar_src">
                <input class="avatar-data" type="hidden" name="avatar_data">
                <input class="avatar-filename" type="hidden" name="avatar_filename">
                <!-- Crop and preview-->
                <div class="row">
                  <div class="col-24">
                    <div class="avatar-wrapper avatar__wrapper"></div>
                  </div>
                </div>
                <div class="row justify-content-center align-items-center avatar-btns">
                  <div class="col-24 col-lg-17">
                    <div class="btn-groups btn-groups--group">
                      <label class="btn btn--primary btn--upload btn-upload" for="avatarInput" title="Upload image file">
                        <input class="sr-only avatar-input" id="avatarInput" type="file" name="avatar_file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff"><span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"><span class="fa fa-upload"></span></span>
                      </label>
                      <button class="btn btn--primary" type="button" data-method="zoom" data-option="0.1" title="Zoom In"><span class="docs-tooltip" data-toggle="tooltip" title="" data-title="cropper.zoom(0.1)"><i class="fa fa-search-plus"></i></span></button>
                      <button class="btn btn--primary" type="button" data-method="zoom" data-option="-0.1" title="Zoom Out"><span class="docs-tooltip" data-toggle="tooltip" title="" data-title="cropper.zoom(-0.1)"><i class="fa fa-search-minus"></i></span></button>
                      <button class="btn btn--primary" type="button" data-method="rotate" data-option="90" title="Rotate 90 degrees"><i class="fa fa-rotate-left"></i></button>
                      <button class="btn btn--primary" type="button" data-method="rotate" data-option="-90" title="Rotate -90 degrees"><i class="fa fa-rotate-right"></i></button>
                      <label class="btn btn--primary avatar__checkbox-group avatar-ratio" for="aspectRatio0">
                        <input class="sr-only avatar-ratio__control" id="aspectRatio0" type="radio" name="aspectRatio" value="1.5" checked><span class="docs-tooltip avatar-ratio__text" data-toggle="tooltip" data-animation="false" title="" data-original-title="aspectRatio: 3 / 2">3:2</span>
                      </label>
                      <label class="btn btn--primary avatar__checkbox-group avatar-ratio" for="aspectRatio1">
                        <input class="sr-only avatar-ratio__control" id="aspectRatio1" type="radio" name="aspectRatio" value="0.66666666666"><span class="docs-tooltip avatar-ratio__text" data-toggle="tooltip" data-animation="false" title="" data-original-title="aspectRatio: 2 / 3">2:3</span>
                      </label>
                    </div>
                  </div>
                  <div class="col-24 col-md-15 col-lg-7">
                    <button class="btn btn--default btn--size avatar-save" type="submit">Обрезать</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="modal fade" id="facebook" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <div class="row">
              <div class="col-24 align-self-start">
                <h2 class="heding">Поделитесь нашим сайтом в социальных сетях, чтобы получить дополнительную скидку 17 грн на вашу покупку!</h2>
              </div>
              <div class="col-24 align-self-center">
                <div class="btn btn--facebook" id="shareBtn" data-layout="button_count">Я рекомендую</div>
              </div>
              <div class="col-24 align-self-end"><a href="#dismiss" data-dismiss="modal">Нет, спасибо</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    <!-- build:js js/bundle.min.js-->
    <!-- Popper JavaScript-->
    <script src="js/popper.js"></script>
    <!-- jQuery-->
    <script src="js/jquery.js"></script>
    <!-- Bootstrap JavaScript-->
    <script src="js/bootstrap.js"></script>
    <!-- Old browsers reject JavaScript-->
    <script src="js/jquery.reject.js"></script>
    <!-- Cropper JavaScript-->
    <script src="js/cropper.js"></script>
    <!-- CountDown JavaScript-->
    <script src="js/jquery.countdown.js"></script>
    <!-- Match Height JavaScript-->
    <script src="js/jquery.matchHeight.js">   </script>
    <!-- Validator JavaScript-->
    <script src="js/validator.js"></script>
    <script src="js/contact_me.js"> </script>
    <!-- Select2 JavaScript-->
    <script src="js/select2.js"></script>
    <!-- Custom JavaScript-->
    <script src="js/main.js"></script>
    <!-- CRM AMO-->
    <script>var amo_social_button = {id: 3324, hash: "c0f3fc79deb5c762002d0eaec20b1cdec73ad6904e7f99b643097abe976effad", locale: "ru"};</script>
    <script id="amo_social_button_script" async="async" src="https://gso.amocrm.ru/js/button.js"></script>
    <!-- Google Tag Manager-->
    <script>
      (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-TGMCLGR');
    </script>
    <!-- End Google Tag Manager-->
    <!-- Google Tag Manager (noscript)-->
    <noscript>
      <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TGMCLGR" height="0" width="0" style="display:none;visibility:hidden;"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript)-->
  </body>
</html>