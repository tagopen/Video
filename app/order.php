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
      <article class="intro intro--mh-100">
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
              <div class="col-24 col-md-14 col-lg-10"><a class="header__logo logo logo--white" href="/">
                  <div class="row">
                    <div class="col-24 col-md-auto">
                      <div class="logo__image"><img class="img-fluid logo__img" src="img/logo/logo.png" alt="logo"></div>
                    </div>
                    <div class="col-24 col-md-auto logo__col align-items-center"> 
                      <p class="logo__text">Именное видеопоздравление <br>для вашего ребенка от Дедушки Мороза</p>
                    </div>
                  </div></a></div>
            </div>
          </div>
        </section>
        <section class="h-content intro__content">
          <div class="container h-100">
            <div class="row justify-content-center flex-lg-row-reverse h-100">
              <div class="col-24 h-100">
                <form class="form js-avatar-form h-100" action="system/model.php" method="post" novalidate>
                  <div class="tabs h-100" data-tabs="test-tabs">
                    <div class="tabs__control tabs-control">
                      <div class="tabs-control__item"><a class="tabs-control__link tabs-control__link--1 tabs-control__link--active" href="#" data-tabs-control="index" data-tabs-toggle="test-tabs" data-tabs-index="0">Шаг 1</a></div>
                      <div class="tabs-control__item"><a class="tabs-control__link tabs-control__link--2" href="#" data-tabs-control="index" data-tabs-toggle="test-tabs" data-tabs-index="1">Шаг 2</a></div>
                      <div class="tabs-control__item"><a class="tabs-control__link tabs-control__link--3" href="#" data-tabs-control="index" data-tabs-toggle="test-tabs" data-tabs-index="2">Шаг 3</a></div>
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
                        <div class="col-24">
                          <div class="btn-groups text-center text-md-left tabs__btn-groups">
                            <button class="btn btn--default btn--sm" data-tabs-control="next" data-tabs-toggle="test-tabs">Далее</button>
                          </div>
                        </div>
                        <div class="col-24 mb-5"><a class="confident__link" data-toggle="modal" href="#confident">Обработка Ваших персональных данных строго конфиденциальна</a></div>
                      </div>
                    </div>
                    <div class="tabs__item">
                      <div class="row">
                        <div class="col-24">
                          <h2 class="heading tabs__heading">Загрузите фотографию ребенка <br/>Фотография появится в книге Дедушки Мороза</h2>
                        </div>
                        <div class="col-24 col-md-12">
                          <div class="btn-groups text-left tabs__btn-group">
                            <button class="form-control btn--file js-file" type="button">Загрузите фотографию
                              <svg class="svg svg--clip btn__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
                                <use xlink:href="img/sprite.svg#clip"></use>
                              </svg>
                            </button>
                            <p class="nt-info tabs__info"><i class="fa fa-info-circle nt-info__icon"></i><i class="nt-info__text">
                                 Если у вас возникли сложности с загрузкой фотографии — звоните или пишите в Viber по номеру 
                                <nobr>098 5 430 430</nobr>. Мы поможем вам с оформлением заказа!</i></p>
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
                        <div class="col-24">
                          <div class="btn-groups text-center tabs__btn-groups">
                            <div class="row">
                              <div class="col-24 col-md-8 col-lg-6 text-center text-md-left">
                                <button class="btn btn--default btn--sm" data-tabs-control="next" data-tabs-toggle="test-tabs">Далее</button><a class="quiz__btn quiz__btn--prev test__btn--prev" href="#" data-tabs-control="prev" data-tabs-toggle="test-tabs">Назад</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-24 mb-5"><a class="confident__link" data-toggle="modal" href="#confident">Обработка Ваших персональных данных строго конфиденциальна</a></div>
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
                            <div class="row justify-content-between total-row d-none js-hidden-discount">
                              <div class="col-auto"><span class="tb-price">Ваша скидка:</span></div>
                              <div class="col-auto"><span class="nt-price"> <span class="js-discount-price"><?=$discount["price"]?></span> грн</span></div>
                              <input class="js-discount" type="hidden" name="discount" value="<?=$discount['name']?>">
                            </div>
                            <div class="row justify-content-between total-row d-none js-new-name">
                              <div class="col-auto"><span class="tb-price">Дозапись имени:</span></div>
                              <div class="col-auto"><span class="nt-price">40 грн</span></div>
                            </div>
                            <div class="row justify-content-between total-row js-total-discount">
                              <div class="col-auto"><a class="link total-discount" href="#facebook" data-toggle="modal">Получить скидку 17 грн</a></div>
                            </div>
                            <div class="row justify-content-between total-row">
                              <div class="col-auto"><span class="tb-price">Итоговая цена:</span></div>
                              <div class="col-auto"><span class="nt-price js-total-price"> <span class="js-total-price-val"><?= ($price - $discount["price"])?></span> грн</span><span class="nt-price d-none js-total-price"><span class="js-total-price-val"><?=($price - $discount["price"] + 40)?></span> грн</span></div>
                            </div>
                          </div>
                        </div>
                        <div class="col-24 col-md-12 col-lg-10">
                          <h2 class="heading tabs__heading">Контактные данные</h2>
                          <fieldset class="form-group form__group--select">
                            <input class="form-control" type="text" name="firstname" placeholder="Введите ваше имя и фамилию" required>
                          </fieldset>
                          <fieldset class="form-group form__group--select">
                            <input class="form-control" type="tel" name="phone" placeholder="Введите номер телефона" pattern="\+380\s\d{2}\s\d{3}\s\d{2}\s\d{2}$" required>
                          </fieldset>
                          <fieldset class="form-group form__group--select">
                            <input class="form-control" type="email" name="email" placeholder="Введите ваш E-mail">
                          </fieldset>
                          <p class="tabs__text">На указаный вами e-mail придёт ссылка для скачивания видеопоздравления. Чтобы избежать попадания нашего письма в спам, рекомендуем не указывать адрес корпоративной почты, а указывать ваш личный E-mail</p>
                        </div>
                        <div class="col-24">
                          <div class="success"> </div>
                          <div class="btn-groups tabs__btn-groups">
                            <div class="row">
                              <div class="col-24 col-md-8 col-lg-6 text-center text-md-left">
                                <div class="btn-groups">
                                  <button class="btn btn--default btn--sm" name="form" value="Order" type="submit" data-loading-text="&lt;i class='fa fa-circle-o-notch fa-spin'&gt;&lt;/i&gt; Файл отправляется...">Перейти к оплате</button>
                                </div>
                              </div>
                              <div class="col-24 col-md-6 text-center text-md-left"><a class="quiz__btn quiz__btn--prev test__btn--prev" href="#" data-tabs-control="prev" data-tabs-toggle="test-tabs">Назад</a></div>
                              <div class="col-24 mb-5"><a class="confident__link" data-toggle="modal" href="#confident">Обработка Ваших персональных данных строго конфиденциальна</a></div>
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
                <form class="form js-form" action="/system/modal.php" method="post">
                  <fieldset class="form-group">
                    <input class="form-control" type="tel" name="phone" placeholder="Введите ваш номер телефона" pattern="\+380\s\d{2}\s\d{3}\s\d{2}\s\d{2}$" required>
                  </fieldset>
                  <div class="btn-groups form__btn-groups">
                    <button class="btn btn--default btn--size" name="form" value="Модалка" type="submit" data-loading-text="&lt;i class='fa fa-circle-o-notch fa-spin'&gt;&lt;/i&gt; Файл отправляется...">Перезвоните мне</button>
                  </div>
                </form><a class="confident__link" data-toggle="modal" href="#confident">Обработка Ваших персональных данных строго конфиденциальна</a>
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
                <div class="mb-3 kid__text">Переходите на следующий шаг, чтобы указать нужные имена. На странице оформления заказа вы также сможете загрузить фотографии детей и получить скидку за репост!</div><a class="btn btn--default btn--size" href="order.php">Перейти к оформлению заказа</a>
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
          <button class="close modal__close modal__close--confident" type="button" data-dismiss="modal" aria-label="Close">
            <svg class="svg svg--close close__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
              <use xlink:href="img/sprite.svg#close"></use>
            </svg>
          </button>
          <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <!-- Upload image and data-->
              <div class="avatar-upload">
                <input class="avatar-src" type="hidden" name="avatar_src">
                <input class="avatar-data" type="hidden" name="avatar_data">
                <input class="avatar-filename" type="hidden" name="avatar_filename">
                <!-- Crop and preview-->
                <div class="row text-center">
                  <div class="col-24">
                    <p class="nt-info"> <i class="fa fa-info-circle nt-info__icon"></i><i>Загрузите фотографию, затем отредактируйте её перемещая и изменяя размер синей рамки. Вы также можете изменить отображение фотографии на горизонтальное или вертикальное, нажав на кнопки 
                        <nobr>«2:3» или «3:2»</nobr></i></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-24">
                    <div class="avatar-wrapper avatar__wrapper"></div>
                  </div>
                </div>
                <div class="row justify-content-center align-items-center avatar-btns">
                  <div class="col-24 col-md-16 col-lg-12">
                    <label class="btn btn--default btn--size btn--upload btn-upload" for="avatarInput" title="Upload image file">
                      <input class="sr-only avatar-input" id="avatarInput" type="file" name="avatar_file" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff"><span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs"><span class="fa fa-upload"></span>
                        <nobr>Загрузить фото<span class="d-none d-sm-inline">графию</span></nobr></span>
                    </label>
                  </div>
                  <div class="col-24 col-md-8 col-lg-12">
                    <button class="btn btn--default btn--size avatar-save" type="submit">Обрезать</button>
                  </div>
                  <div class="col-24">
                    <div class="btn-groups btn-groups--group">
                      <button class="btn btn--primary" type="button" data-method="zoom" data-option="0.1" title="Zoom In"><span class="docs-tooltip" data-toggle="tooltip" title="" data-title="cropper.zoom(0.1)"><i class="fa fa-search-plus"></i></span></button>
                      <button class="btn btn--primary" type="button" data-method="zoom" data-option="-0.1" title="Zoom Out"><span class="docs-tooltip" data-toggle="tooltip" title="" data-title="cropper.zoom(-0.1)"><i class="fa fa-search-minus"></i></span></button>
                      <button class="btn btn--primary" type="button" data-method="rotate" data-option="90" title="Rotate 90 degrees"><i class="fa fa-rotate-left"></i></button>
                      <button class="btn btn--primary" type="button" data-method="rotate" data-option="-90" title="Rotate -90 degrees"><i class="fa fa-rotate-right"></i></button>
                      <label class="btn btn--primary avatar-ratio" for="aspectRatio0">
                        <input class="sr-only avatar-ratio__control" id="aspectRatio0" type="radio" name="aspectRatio" value="1.5" checked><span class="docs-tooltip avatar-ratio__text" data-toggle="tooltip" data-animation="false" title="" data-original-title="aspectRatio: 3 / 2">3:2</span>
                      </label>
                      <label class="btn btn--primary avatar-ratio" for="aspectRatio1">
                        <input class="sr-only avatar-ratio__control" id="aspectRatio1" type="radio" name="aspectRatio" value="0.66666666666"><span class="docs-tooltip avatar-ratio__text" data-toggle="tooltip" data-animation="false" title="" data-original-title="aspectRatio: 2 / 3">2:3</span>
                      </label>
                    </div>
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
            <div class="row text-center">
              <div class="col-24 align-self-start">
                <h2 class="heding heading--neumann mb-5">Поделитесь нашим сайтом в социальных сетях, чтобы получить дополнительную скидку 30 грн на вашу покупку!</h2>
              </div>
              <div class="col-24 align-self-center">
                <div class="btn btn--facebook" id="shareBtn" data-layout="button_count"> <i class="fa fa-facebook mr-3"></i>Я рекомендую</div>
              </div>
              <div class="col-24 align-self-end mt-5"><a class="link-gray" href="#dismiss" data-dismiss="modal">Нет, спасибо</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
    <div class="modal fade" id="confident" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal--size" role="document">
        <div class="modal-content">
          <button class="close modal__close modal__close--confident" type="button" data-dismiss="modal" aria-label="Close">
            <svg class="svg svg--close close__icon" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" role="img">
              <use xlink:href="img/sprite.svg#close"></use>
            </svg>
          </button>
          <div class="modal-body">
            <div class="confident">
              <div class="confident__title">ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ</div>
              <div class="confident__subtitle">Настоящая Политика конфиденциальности персональных данных (далее - политика конфиденциальности) действует в отношении всей информации, которую сайт "Именное видео-поздравление от Дедушки Мороза", расположенный на доменном имени http://video-pozdravlenie.com/ может получить о Пользователе во время использования сайта, программ и продуктов.</div>
              <p class="confident__heading">1. ОПРЕДЕЛЕНИЕ ТЕРМИНОВ</p>
              <p class="confident__text">1.1. В настоящей Политике конфиденциальности используются следующие термины:</p>
              <p class="confident__text">1.1.1. "Администрация сайта (далее - Администрация сайта)" - уполномоченные сотрудники на управление сайтом, которые организуют и (или) осуществляют обработку персональных данных, а также определяют цели обработки персональных данных, состав персональных данных, подлежащих обработке, действия (операции), совершаемые с персональными данными.</p>
              <p class="confident__text">1.1.2. «Персональные данные» - любая информация, относящаяся к прямо или косвенно определенному или определяемому физическому лицу (субъекту персональных данных).</p>
              <p class="confident__text">1.1.3. «Обработка персональных данных» - любое действие (операция) или совокупность действий (операций), совершаемых с использованием средств автоматизации или без использования таких средств с персональными данными, включая сбор, запись, систематизацию, накопление, хранение, уточнение (обновление, изменение), извлечение, использование, передачу (распространение, предоставление, доступ), обезличивание, блокирование, удаление, уничтожение персональных данных.</p>
              <p class="confident__text">1.1.4. «Конфиденциальность персональных данных» - обязательное для соблюдения Оператором или иным получившим доступ к персональным данным лицом требование не допускать их распространения без согласия субъекта персональных данных или наличия иного законного основания.</p>
              <p class="confident__text">1.1.5. «Пользователь сайта (далее ? Пользователь)» – лицо, имеющее доступ к Сайту, посредством сети Интернет и использующее сайт.</p>
              <p class="confident__text">1.1.6. «Cookies» — небольшой фрагмент данных, отправленный веб-сервером и хранимый на компьютере пользователя, который веб-клиент или веб-браузер каждый раз пересылает веб-серверу в HTTP-запросе при попытке открыть страницу соответствующего сайта.</p>
              <p class="confident__text">1.1.7. «IP-адрес» — уникальный сетевой адрес узла в компьютерной сети, построенной по протоколу IP.</p>
              <p class="confident__heading">2. ОБЩИЕ ПОЛОЖЕНИЯ</p>
              <p class="confident__text">2.1. Использование Пользователем сайта означает согласие с настоящей Политикой конфиденциальности и условиями обработки персональных данных Пользователя.</p>
              <p class="confident__text">2.2. В случае несогласия с условиями Политики конфиденциальности Пользователь должен прекратить использование сайта.</p>
              <p class="confident__text">2.3. Настоящая Политика конфиденциальности применяется только к сайту  “Именное видео-поздравление от Дедушки Мороза”. Сайт не контролирует и не несет ответственность за сайты третьих лиц, на которые Пользователь может перейти по ссылкам, доступным на сайте.</p>
              <p class="confident__text">2.4. Администрация сайта не проверяет достоверность персональных данных, предоставляемых Пользователем сайта.</p>
              <p class="confident__heading">3. ПРЕДМЕТ ПОЛИТИКИ КОНФИДЕНЦИАЛЬНОСТИ</p>
              <p class="confident__text">3.1. Настоящая Политика конфиденциальности устанавливает обязательства Администрации сайта по неразглашению и обеспечению режима защиты конфиденциальности персональных данных, которые Пользователь предоставляет по запросу Администрации сайта при регистрации на сайте или при оформлении заказа для приобретения Товара.</p>
              <p class="confident__text">3.2. Персональные данные, разрешённые к обработке в рамках настоящей Политики конфиденциальности, предоставляются Пользователем путём заполнения регистрационных форм на данном Сайте и могут включать в себя следующую информацию:</p>
              <p class="confident__text">3.2.1. фамилию, имя, отчество Пользователя;</p>
              <p class="confident__text">3.2.2. контактный телефон Пользователя;</p>
              <p class="confident__text">3.2.3. адрес электронной почты (e-mail) Пользователя;</p>
              <p class="confident__text">3.2.4. адрес доставки Товара(ов) Пользователю;</p>
              <p class="confident__text">3.2.5. место жительство Пользователя;</p>
              <p class="confident__text">3.2.6. логин Пользователя.</p>
              <p class="confident__text">3.3. Сайт защищает Данные, которые автоматически передаются в процессе просмотра рекламных блоков и при посещении страниц, на которых установлен статистический скрипт системы ("пиксель"):</p>
              <ul>
                <li>IP адрес;</li>
                <li>Информация из cookies;</li>
                <li>информация о браузере (или иной программе, которая осуществляет доступ к показу рекламы);</li>
                <li>Время доступа;</li>
                <li>Адрес страницы, на которой расположен рекламный блок;</li>
                <li>Реферер (адрес предыдущей страницы).</li>
              </ul>
              <p class="confident__text">3.3.1. Отключение cookies может повлечь невозможность доступа к частям сайта, требующим авторизации.</p>
              <p class="confident__text">3.3.2. Сайтом осуществляет сбор статистики об IP-адресах своих посетителей. Данная информация используется с целью выявления и решения технических проблем, для контроля законности проводимых финансовых платежей.</p>
              <p class="confident__text">
                3.4. Любая иная персональная информация неоговоренная выше (история покупок, используемые браузеры и
                операционные системы и т.д.) подлежит надежному хранению и нераспространению, за исключением случаев,
                предусмотренных в п.п. 5.2. и 5.3. настоящей Политики конфиденциальности.
              </p>
              <p class="confident__heading">4. ЦЕЛИ СБОРА ПЕРСОНАЛЬНОЙ ИНФОРМАЦИИ ПОЛЬЗОВАТЕЛЯ</p>
              <p class="confident__text">4.1. Персональные данные Пользователя Администрация сайта может использовать в целях:</p>
              <p class="confident__text">4.1.1. Идентификации Пользователя, зарегистрированного на сайте, для оформления заказа и (или) заключения Договора купли-продажи товара дистанционным способом с сайтом “Именное видео-поздравление от Дедушки Мороза”</p>
              <p class="confident__text">4.1.2. Предоставления Пользователю доступа к персонализированным ресурсам Сайта интернет-магазина.</p>
              <p class="confident__text">4.1.3. Установления с Пользователем обратной связи, включая направление уведомлений, запросов, касающихся использования сайта, оказания услуг, обработка запросов и заявок от Пользователя.</p>
              <p class="confident__text">4.1.4 Определения места нахождения Пользователя для обеспечения безопасности, предотвращения мошенничества.</p>
              <p class="confident__text">4.1.5 Подтверждения достоверности и полноты персональных данных, предоставленных Пользователем.</p>
              <p class="confident__text">4.1.6 Создания учетной записи для совершения покупок, если Пользователь дал согласие на создание учетной записи.</p>
              <p class="confident__text">
                 4.1.7 Уведомления Пользователя сайта о состоянии Заказа.</p>
              <p class="confident__text">4.1.8 Обработки и получения платежей, подтверждения налога или налоговых льгот, оспаривания платежа.</p>
              <p class="confident__text">4.1.9 Предоставления Пользователю эффективной клиентской и технической поддержки при возникновении проблем связанных с использованием сайта.</p>
              <p class="confident__text">4.1.10 Предоставления Пользователю с его согласия, обновлений продукции, специальных предложений, информации о ценах, новостной рассылки и иных сведений от имени сайта или от имени партнеров.</p>
              <p class="confident__text">4.1.11 Осуществления рекламной деятельности с согласия Пользователя.</p>
              <p class="confident__text">4.1.12 Предоставления доступа Пользователю на сайты или сервисы партнеров сайта с целью получения продуктов, обновлений и услуг.</p>
              <p class="confident__heading">5. СПОСОБЫ И СРОКИ ОБРАБОТКИ ПЕРСОНАЛЬНОЙ ИНФОРМАЦИИ</p>
              <p class="confident__text">
                5.1. Обработка персональных данных Пользователя осуществляется без ограничения срока, любым законным способом,
                в том числе в информационных системах персональных данных с использованием средств автоматизации или без
                использования таких средств.
              </p>
              <p class="confident__text">5.2. Пользователь соглашается с тем, что Администрация сайта вправе передавать персональные данные третьим лицам, в частности, курьерским службам, организациями почтовой связи, операторам электросвязи, исключительно в целях выполнения заказа Пользователя, оформленного на сайте «Именное видео-поздравление от Дедушки Мороза», включая доставку Товара.</p>
              <p class="confident__text">5.3. Персональные данные Пользователя могут быть переданы уполномоченным органам государственной власти Украины только по основаниям и в порядке, установленным законодательством Украины.</p>
              <p class="confident__text">
                5.4. При утрате или разглашении персональных данных Администрация сайта информирует Пользователя об
                утрате или разглашении персональных данных.
              </p>
              <p class="confident__text">
                5.5. Администрация сайта принимает необходимые организационные и технические меры для защиты персональной
                информации Пользователя от неправомерного или случайного доступа, уничтожения, изменения, блокирования,
                копирования, распространения, а также от иных неправомерных действий третьих лиц.
              </p>
              <p class="confident__text">
                5.6. Администрация сайта совместно с Пользователем принимает все необходимые меры по предотвращению
                убытков или иных отрицательных последствий, вызванных утратой или разглашением персональных данных
                Пользователя.
              </p>
              <p class="confident__heading">6. ОБЯЗАТЕЛЬСТВА СТОРОН</p>
              <p class="confident__text bold">6.1. Пользователь обязан:</p>
              <p class="confident__text">6.1.1. Предоставить информацию о персональных данных, необходимую для пользования сайтом.</p>
              <p class="confident__text">6.1.2. Обновить, дополнить предоставленную информацию о персональных данных в случае изменения данной информации.</p>
              <p class="confident__text bold">6.2. Администрация сайта обязана:</p>
              <p class="confident__text">
                6.2.1. Использовать полученную информацию исключительно для целей, указанных в п. 4 настоящей
                Политики конфиденциальности.
              </p>
              <p class="confident__text">
                6.2.2. Обеспечить хранение конфиденциальной информации в тайне, не разглашать без предварительного
                письменного разрешения Пользователя, а также не осуществлять продажу, обмен, опубликование, либо разглашение
                иными возможными способами переданных персональных данных Пользователя, за исключением п.п. 5.2. и 5.3.
                настоящей Политики Конфиденциальности.
              </p>
              <p class="confident__text">
                6.2.3. Принимать меры предосторожности для защиты конфиденциальности персональных данных Пользователя
                согласно порядку, обычно используемого для защиты такого рода информации в существующем деловом обороте.
              </p>
              <p class="confident__text">
                6.2.4. Осуществить блокирование персональных данных, относящихся к соответствующему Пользователю, с момента
                обращения или запроса Пользователя или его законного представителя либо уполномоченного органа по защите
                прав субъектов персональных данных на период проверки, в случае выявления недостоверных персональных данных
                или неправомерных действий.
              </p>
              <p class="confident__heading">7. ОТВЕТСТВЕННОСТЬ СТОРОН</p>
              <p class="confident__text">7.1. Администрация сайта, не исполнившая свои обязательства, несёт ответственность за убытки, понесённые Пользователем в связи с неправомерным использованием персональных данных, в соответствии с законодательством Украины, за исключением случаев, предусмотренных п.п. 5.2., 5.3. и 7.2. настоящей Политики Конфиденциальности.</p>
              <p class="confident__text">
                7.2. В случае утраты или разглашения Конфиденциальной информации Администрация сайта не несёт
                ответственность, если данная конфиденциальная информация:
              </p>
              <p class="confident__text">7.2.1. Стала публичным достоянием до её утраты или разглашения.</p>
              <p class="confident__text">7.2.2. Была получена от третьей стороны до момента её получения Администрацией сайта.</p>
              <p class="confident__text">7.2.3. Была разглашена с согласия Пользователя.</p>
              <p class="confident__heading">8. РАЗРЕШЕНИЕ СПОРОВ</p>
              <p class="confident__text">
                8.1. До обращения в суд с иском по спорам, возникающим из отношений между Пользователем сайта
                Интернет-магазина и Администрацией сайта, обязательным является предъявление претензии (письменного
                предложения о добровольном урегулировании спора).
              </p>
              <p class="confident__text">
                8.2. Получатель претензии в течение 30 календарных дней со дня получения претензии, письменно уведомляет
                заявителя претензии о результатах рассмотрения претензии.
              </p>
              <p class="confident__text">8.3.  При недостижении соглашения спор будет передан на рассмотрение в судебный орган в соответствии с действующим законодательством Украины.</p>
              <p class="confident__text">8.4. К настоящей Политике конфиденциальности и отношениям между Пользователем и Администрацией сайта применяется действующее законодательство Украины.</p>
              <p class="confident__heading">9. ДОПОЛНИТЕЛЬНЫЕ УСЛОВИЯ</p>
              <p class="confident__text">9.1. Администрация сайта вправе вносить изменения в настоящую Политику конфиденциальности без согласия Пользователя.</p>
              <p class="confident__text">
                9.2. Новая Политика конфиденциальности вступает в силу с момента ее размещения на Сайте интернет-магазина, если
                иное не предусмотрено новой редакцией Политики конфиденциальности.
              </p>
              <p class="confident__text">9.3. Все предложения или вопросы по настоящей Политике конфиденциальности следует адресовать на электронный адрес: yadedushkamoroz2017@gmail.com</p>
              <p class="confident__text">9.4. Действующая Политика конфиденциальности размещена на странице по адресу http://video-pozdravlenie.com/</p>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    <!-- Clave.js JavaScript-->
    <script src="js/cleave.js"></script>
    <!-- Trace Library JavaScript-->
    <script src="https://cdn.ravenjs.com/3.20.1/raven.min.js" crossorigin="anonymous"></script>
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
