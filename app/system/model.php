<?php
  session_start();

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

  // Добавлен код интеграции amoCRM
  if (is_file('./mail/lib/amocrm/amo_route.php')) {
    require_once("./mail/lib/amocrm/amo_route.php");
  }

  class ModelClass {
    private $post;
    private $data;
    private $price;

    private $error;
    private $msg;
    private $result;



    function __construct() {
      
      //DB::$user = 'root';
      //DB::$password = '';
      //DB::$dbName = 'video';

      
      //DB::$user = 'b18152559_admin';
      //DB::$password = '7I7k6L7y';
      //DB::$dbName = 'b18152559_video';

      DB::$user = 'shunkin_videpp';
      DB::$password = 'dqrgxfj5';
      DB::$dbName = 'shunkin_videpp';

      DB::$host = 'shunkin.mysql.tools'; //defaults to localhost if omitted
      DB::$encoding = 'utf8'; // defaults to latin1 if omitted

      $this -> post = $this -> filterDataForm();
      if ($this -> post["form"]) {
        $this -> data = $this -> validateDataForm($this -> post );
        $this -> setTotalPrice($this -> data["price"]);
        if ($this -> post["form"] == "Order") {
          $this -> setOrder();
        }
        //$this -> sendMail();
      } elseif ($this -> post["promocode"]) {
        $this -> promocodeIsValid($this -> post["promocode"]);
      } elseif ($this -> post["discount"]) {
        $this -> discountIsValid($this -> post["discount"]);
      }
    }

    private function setOrder() {

      $image_id = $this -> setImage($this -> data["image"]);

      //echo
     $amoID =  amo_route(array_merge($_POST, array("price"=>$this->data['price']))); // Добавлено для интеграции c Амо

      DB::insert('order', array(
        'order_image_id'   => $image_id,
        'firstname'        => $this -> data['firstname'],
        'email'            => $this -> data['email'],
        'telephone'        => $this -> data['phone'],
        'amo_track_number' => $amoID,
        'total_price'      => $this -> data['price'],
        'coupon_id'        => $_SESSION['promocode']["promocode_id"],
        'discount_id'      => $_SESSION['discount']['discount_id'],
        'date_added'       => DB::sqleval("NOW()"),
        'date_modified'    => DB::sqleval("NOW()"),
      ));
      if(isset($_SESSION['promocode'])) {
        unset($_SESSION['promocode']);
      }

      if(isset($_SESSION['discount'])) {
        unset($_SESSION['discount']);
      }
    }

    private function setPaymentStatus($amo_lead_id) {
      DB::update('order', array(
        'payment_status' => '1'
        ), "amo_track_number=%s", $amo_lead_id);
    }

    private function setTotalPrice($totalPrice = 0.0000) {

      $product = ModelClass::getProductPrice();
      if($product) {
        $totalPrice += $product['price'];
      }

      if(isset($_SESSION['promocode'])) {
        $totalPrice += $_SESSION['promocode']['price'];
      }

      if(isset($_SESSION['discount'])) {
        $totalPrice += $_SESSION['discount']['price'];
      }

      $childrean = ModelClass::childreanCountPrice();
      if($childrean) {
        $totalPrice += $childrean;
      }

      $this -> data["price"] = $totalPrice;
    }

    private function childreanCountPrice() {
      $trigger = ($this -> data["newname"] || $this -> data["childrean"] == 2) ? true : false;
      if ($trigger) {
        $results = DB::query("SELECT dc.* FROM discount AS dc WHERE dc.name=%s  AND dc.date_start <= %t AND dc.date_end >= %t" , "childrean", date("Y-m-d"), date("Y-m-d"));
        if ($results) {
          foreach ($results as $row) {
            return $row['price'];
          }
        }
      } else {
        return;
      }
    }

    private function getDiscount($discount) {
      $results = DB::query("SELECT dc.* FROM discount AS dc WHERE dc.permission = %s AND dc.date_start <= %t AND dc.date_end >= %t", "public", date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
          return $row["price"];
        }
      } else {
        return;
      }
    }

    private function getChildreanName() {
      $results = DB::query("SELECT cd.* FROM childrean AS cd WHERE cd.status=%s", "1");
      if ($results) {
        return $results;
      } else {
        return;
      }
    }

    private function setChildreanName($child) {
      DB::insert('childrean', array(
        'firstname'      => $child['newname'],
        'gender'         => $child['gender'],
        'date_added'     => DB::sqleval("NOW()")
      ));
    }

    private function discountIsValid($discount) {

      if (empty($discount)) {
        return;
      }

      $results = DB::query("SELECT dc.* FROM discount AS dc WHERE dc.name=%s AND dc.date_start <= %t AND dc.date_end >= %t ", $discount, date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
            $_SESSION['discount']["discount_id"] = $row['discount_id'];
            $_SESSION['discount']["price"] = $row['price'];
            return 1;
        }
      } else {
        if(isset($_SESSION['discount'])) {
          unset($_SESSION['discount']);
        }
        $this -> error = "Скидка не активна!";
        return;
      }
    }

    private function getProductPrice() {

      $results = DB::query("SELECT ps.* FROM product_special AS ps WHERE ps.date_start <= %t AND ps.date_end >= %t ", date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
          return array(
                  "product_id" => $row['product_special_id'],
                  "price" => $row['price']
                );
        }
      } else {
        return;
      }
    }
    
    private function sendMail() {
     
    }

    private function setImage($src) {

      if (empty($src)) {
        return;
      }

      DB::insert('order_image', array(
        'image' => $src,
        'date_added' => DB::sqleval("NOW()")
      ));

      return DB::insertId();

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
            return;
          } elseif ($row['status'] === '1') {
            $this -> msg = "Промокод активирован!";

            $_SESSION['promocode']["promocode_id"] = $row['coupon_id'];
            $_SESSION['promocode']["price"] = $row['price'];
            return 1;
          }
        }
      } else {
        $this -> error = "Такого промокода не существует!";
        if(isset($_SESSION['promocode'])) {
          unset($_SESSION['promocode']);
        }
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

    private function vardump($val) {
      header('Content-Type: text/html; charset=utf-8');
      echo "<pre>";
      print_r($val);
      echo "</pre>";
      die;
    }

    private function validateChild($data) {
      $result = array();
      $gender = (int)$data["gender"];

      if ($gender === 1) {
        $result["gender"] = 1;
      } elseif ($gender === 0) {
        $result["gender"] = 0;
      } else {
        $this -> error = "Неправильно указан пол ребенка";
        return;
      }



      if ($data["newname"]) {
        $newname = $data["newname"]["name"];

        $trigger_newname = $data["newname"]["trigger"];
        if (!$newname && !$trigger_newname) {
          $this -> error = "Не заполнено поле с именем ребенка";
          return;
        }
      }



      if ($trigger_newname) {
        $result["newname"] = $newname;
        ModelClass::setChildreanName($result);
      } else {
        $result["name"] = $data["name"];
      }

      return $result;
    }

    private function fieldIsValid($post, $key, $default = null) {
      return isset($post[$key]) ? trim($post[$key]) : $default;
    }

    private function filterDataForm() {
      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = array();
      if (!$post) {
        $this -> error = "Форма пустая";
        return;
      }

      $data = ModelClass::recursivefilterForm($post);
      return $data;
    }

    private function recursivefilterForm($data){
        $result = array();
        foreach ($data as $key => $value) {
          if(is_array($value)) {            
            $result[$key] = ModelClass::recursivefilterForm($value);
          } else {
            $result[$key] = ModelClass::fieldIsValid($data, $key);
          }
        }

        return $result;
    }

    private function validateDataForm($post) {
      $data = array();

      $childrean = (int)$post['childrean'];
      $data['childrean'] = $childrean;

      $child1 = $post['child1'];
      $child2 = $post['child2'];


      if (!($child1 || $child2)) {
        $this -> error = "Данные о ребенке - отсутствуют";
        return;
      }

      if ($child1) {
        $data['child1'] = ModelClass::validateChild($child1);
      } 
      if ($child2 && $childrean === 2){
        $data['child2'] = ModelClass::validateChild($child2);
      }


      $image = $post["image"];
      if (!$image) {
        $this -> error = "Изображение не загружено";
        return;
      }
      $data["image"] = $image;

      $firstname = $post["firstname"];
      if (!($firstname)) {
        $this -> error = "Введите ваше имя";
        return;
      }
      $data["firstname"] = $firstname;

      $phone = $post["phone"];
      if (!($phone)) {
        $this -> error = "Введите ваш телефон";
        return;
      }
      $data["phone"] = $phone;

      $email =  $post["email"];
      if (!($email)) {
        $this -> error = "Введите ваш email";
        return;
      }
      $data["email"] = $email;

      $promocode = $post["promocode"];
      $data["promocode"] =  ModelClass::promocodeIsValid($promocode) ? $promocode : null;

      $discount = $post["discount"];
      $data["discount"] =  ModelClass::discountIsValid($discount) ? $discount : null;

      $form = $post["form"];
      $data["form"] = $form;
      
      return $data;
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
