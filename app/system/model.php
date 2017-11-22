<?php

  if (is_file('./mysql/meekrodb.2.3.class.php')) {
    require_once("./mysql/meekrodb.2.3.class.php");
  }
  
  if (is_file('./mail/lib/class.phpmailer.php')) {
    require_once("./mail/lib/class.phpmailer.php");
  }
  
  if (is_file('./mail/lib/class.smtp.php')) {
    require_once("./mail/lib/class.smtp.php");
  }
  
  if (is_file('./mail/lib/newsletter.php')) {
    require_once("./mail/lib/newsletter.php");
  }

  class ModelClass {
    private $formNamePlace;
    private $formNamePromocode;
    private $data;
    private $error;
    private $msg;
    private $result;

    function __construct() {
      
      DB::$user = 'root';
      DB::$password = '';
      DB::$dbName = 'video';

      DB::$host = 'localhost'; //defaults to localhost if omitted
      DB::$encoding = 'utf8'; // defaults to latin1 if omitted

      $this -> setData();
      $this -> promocodeIsValid($this -> data["promocode"]);
      $this -> setImage($this -> data["image"]);
      //$this -> sendMail();

    }


    private function setOrder($data) {

      DB::insert('order', $data);

      ModelClass::sendMail();

    }
    
    private function sendMail() {
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

      if ( (!empty($_POST["promocode"])) && (isset($_POST["promocode"])) ) {
        $post["user_method"] = $_POST["promocode"];
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
        $this -> error =  "Что-то пошло не так. " . $mail->ErrorInfo;
        return false;
      } else {
        $this -> msg =  "Сообщение отправлено!";
        return true;
      }
    }

    private function setImage($src) {

      if (empty($src)) {
        return;
      }

      DB::insert('order_image', array(
        'image' => $src,
        'date_added' => DB::sqleval("NOW()")
      ));

    }


    private function promocodeIsValid($promocode) {

      if (empty($promocode)) {
        return;
      }

      $results = DB::query("SELECT cn.* FROM coupon AS cn WHERE cn.name=%s AND cn.date_start <= %t AND cn.date_end >= %t ", $promocode, date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
          if ($row['status'] === '0') {
            $this -> error = "Промокод не активен!";
          } elseif ($row['status'] === '1') {
            $this -> msg = "Промокод активирован!";
            $this -> result = $row['price'];
            $_SESSION['promocode'] = $row['price'];
          }
        }
      } else {
        $this -> error = "Такого промокода не существует!";
      }
    }

    
    public function getResult() {
      return $this -> result;
    }
   
    public function getMsg() {
      return $this -> msg;
    }
   
    public function getError() {
      return $this -> error;
    }

    private function setData() {

      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if (!$post) {
        $this -> error = "Форма пустая";
        return;
      } else {
        foreach($post as $key => $value) {
          $this -> data[$key] = isset($post[$key]) ? $post[$key] : null;
        }
      }
    }
  }

  $obj = new ModelClass();
  
  $response = array(
    'state'  => 200,
    'message' => $obj -> getMsg(),
    'error' => $obj -> getError(),
    'result' => $obj -> getResult()
  );
   
  echo json_encode($response);

?>