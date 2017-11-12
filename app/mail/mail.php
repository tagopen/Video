<?php

  if (is_file('lib/class.phpmailer.php')) {
    require_once("lib/class.phpmailer.php");
  }
  
  if (is_file('lib/class.smtp.php')) {
    require_once("lib/class.smtp.php");
  }
  
  if (is_file('lib/newsletter.php')) {
    require_once("lib/newsletter.php");
  }

  $http_host = $_SERVER["HTTP_HOST"];
  $body = "";
  $data = array();

  if ( substr($http_host, 0, 4)=="www.") {
    $host_name = substr($http_host, 4);
  } else {
    $host_name = $http_host;
  }
  if (isset($_SERVER["HTTP_REFERER"])) {
    $http_referer = $_SERVER["HTTP_REFERER"];
  } else {
    $http_referer = "";
  }
  define ("HTTP_SERVER", "http://" . $http_host . "/");
  define ("HOST_NAME", $host_name);
  define ("HTTP_REFERER", $http_referer);
  $post = array( 
    "host_name"     => HOST_NAME,
    "host_dir"      => HTTP_SERVER,
    "host_referer"  => HTTP_REFERER
  );

  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

  if (!$_POST) {
    echo "Форма пустая!";
    exit;
  }
  
  //header("Content-Type: text/html; charset=utf-8");
  //echo "<pre>";
  //var_dump($_POST);
  //echo "</pre>";
  //exit;

  if ( (!empty($_POST["form"])) && (isset($_POST["form"])) ) {
    $post["user_form"] = $_POST["form"];

    $stack = array(
      "key"   => "Форма: ",
      "value" => $post["user_form"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["email"])) && (isset($_POST["email"])) ) {
    $post["user_email"] = $_POST["email"];
    $stack = array(
      "key"   => "Email: ",
      "value" => $post["user_email"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["phone"])) && (isset($_POST["phone"])) ) {
    $post["user_phone"] = $_POST["phone"];
    $stack = array(
      "key"   => "Телефон: ",
      "value" => $post["user_phone"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["name"])) && (isset($_POST["name"])) ) {
    $post["user_name"] = $_POST["name"];
    $stack = array(
      "key"   => "Имя: ",
      "value" => $post["user_name"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["message"])) && (isset($_POST["message"])) ) {
    $post["user_message"] = $_POST["message"];
    $stack = array(
      "key"   => "Сообщение: ",
      "value" => $post["user_message"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["method"])) && (isset($_POST["method"])) ) {
    $post["user_method"] = $_POST["method"];
    $stack = array(
      "key"   => "Как связаться: ",
      "value" => $post["user_method"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["time"])) && (isset($_POST["time"])) ) {
    $post["user_time"] = $_POST["time"];
    $stack = array(
      "key"   => "Удобное время: ",
      "value" => $post["user_time"]
    );
    array_push($data, $stack);
  }

  if ( !empty($_POST["period"])  && (isset($_POST["period"])) ) {
    if (is_array($_POST['period'])) {
      $post["period"] = implode(", ", $_POST["period"]);
    } else {
      $post["period"] = $_POST["period"];
    }
    $stack = array(
      "key"   => "Когда позвонить: ",
      "value" => $post["period"]
    );
    array_push($data, $stack);
  }

  if ( !empty($_POST["material"])  && (isset($_POST["material"])) ) {
    if (is_array($_POST['material'])) {
      $post["material"] = implode(", ", $_POST["material"]);
    } else {
      $post["material"] = $_POST["material"];
    }
    $stack = array(
      "key"   => "Чем зашивать: ",
      "value" => $post["material"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["range1"])) && (isset($_POST["range1"])) ) {
    $post["user_range1"] = $_POST["range1"];
    $stack = array(
      "key"   => "Длина ворот: ",
      "value" => $post["user_range1"]
    );
    array_push($data, $stack);
  }

  if ( (!empty($_POST["range2"])) && (isset($_POST["range2"])) ) {
    $post["user_range2"] = $_POST["range2"];
    $stack = array(
      "key"   => "Высота ворот: ",
      "value" => $post["user_range2"]
    );
    array_push($data, $stack);
  }


  $stack = array(
    "key"   => "Форма отправлена с сайта: ",
    "value" => $post["host_referer"]
  );
  array_push($data, $stack);

  foreach ($data as $key => $value) {
    $body .= $value['key'] . $value['value'] . chr(10) . chr(13);
  }

  $mail = new PHPMailer();
  $mail->CharSet = "UTF-8";
  $mail->IsSendmail();

  $from = "no-repeat@" . HOST_NAME;
  $mail->SetFrom($from, HOST_NAME);
  $mail->AddAddress("Artem2431@gmail.com");
  $mail->AddAddress("Marchik88@rambler.ru");
  $mail->isHTML(true);
  $mail->Subject      = HOST_NAME;
  $NewsLetterClass    = new NewsLetterClass();
  $mail->Body         = $NewsLetterClass->generateHTMLLetter($data);
  $mail->AltBody      = $body;

  if(!$mail->send()) {
    echo "Что-то пошло не так. " . $mail->ErrorInfo;
    return false;
  } else {
    header("Location: ../success.html");
    return true;
  }
?>
