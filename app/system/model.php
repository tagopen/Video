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

  class ModelClass {
    private $data;

    private $error;
    private $msg;
    private $result;



    function __construct() {
      
      DB::$user = 'root';
      DB::$password = '';
      DB::$dbName = 'video';
      
      //DB::$user = 'b18152559_admin';
      //DB::$password = '7I7k6L7y';
      //DB::$dbName = 'b18152559_video';

      DB::$host = 'localhost'; //defaults to localhost if omitted
      DB::$encoding = 'utf8'; // defaults to latin1 if omitted

      $this -> setData();
      $this -> setTotalPrice();

      if ($this -> data["form"]) {
        if ($this -> data["form"] == "Order") {
          $this -> setOrder();
        }

        //$this -> sendMail();
      }

    }

    private function setOrder() {

      $image_id = $this -> setImage($this -> data["image"]);

      DB::insert('order', array(
        'order_image_id' => $image_id,
        'firstname'      => $this -> data['firstname'],
        'email'          => $this -> data['email'],
        'telephone'      => $this -> data['phone'],
        'price'          => $this -> data['price'],
        'coupon_id'      => $_SESSION['promocode']["promocode_id"],
        'discount_id'    => $_SESSION['discount']['discount_id'],
        'date_added'     => DB::sqleval("NOW()"),
        'date_modified'  => DB::sqleval("NOW()"),
      ));


      if(isset($_SESSION['promocode'])) {
        unset($_SESSION['promocode']);
      }

      if(isset($_SESSION['discount'])) {
        unset($_SESSION['discount']);
      }

    }

    private function setTotalPrice() {
      $totalPrice = 0.0000;
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
      $results = DB::query("SELECT cd.* FROM childrean AS cd");
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

    private function fieldIsValid($post, $key, $default = null) {
      return isset($post[$key]) ? $post[$key] : $default;
    }

    private function validateChild($child) {
      $result = array();
      $gender = (int)ModelClass::fieldIsValid($child, "gender");

      $newname = ModelClass::fieldIsValid($child["newname"], "name");
      $trigger_newname = ModelClass::fieldIsValid($child["newname"], "trigger");

      if ($gender === 1) {
        $name = ModelClass::fieldIsValid($child["name"], "male");
        $result["gender"] = 1;
      } elseif ($gender === 0) {
        $name = ModelClass::fieldIsValid($child["name"], "female");
        $result["gender"] = 0;
      }

      if ($trigger_newname) {
        $result["newname"] = $newname;
        ModelClass::setChildreanName($result);
      } else {
        $result["name"] = $name;
      }
      return $result;
    }

    private function setData() {

      $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      if (!$post) {
        $this -> error = "Форма пустая";
        return;
      } else {
        $childrean = (int)ModelClass::fieldIsValid($post, "childrean", 1);
        $this -> data["childrean"] = $childrean;
        $child1 = ModelClass::fieldIsValid($post, "child1");
        $child2 = ModelClass::fieldIsValid($post, "child2");
        if (!($child1 || $child2)) {
          $this -> error = "Данные о ребенке - отсутствуют";
          return;
        }

        if ($child1) {
          $this -> data["child1"] = ModelClass::validateChild($child1);
        } 
        if ($child2 && $childrean === 2){
          $this -> data["child2"] = ModelClass::validateChild($child2);
        }

        $image = ModelClass::fieldIsValid($post, "image");
        if (!($image)) {
          $this -> error = "Изображение не загружено";
          return;
        }
        $this -> data["image"] =  $image;

        $firstname = ModelClass::fieldIsValid($post, "firstname");
        if (!($firstname)) {
          $this -> error = "Введите ваше имя";
          return;
        }
        $this -> data["firstname"] =  $firstname;

        $phone = ModelClass::fieldIsValid($post, "phone");
        if (!($phone)) {
          $this -> error = "Введите ваш телефон";
          return;
        }
        $this -> data["phone"] =  $phone;

        $email = ModelClass::fieldIsValid($post, "email");
        if (!($email)) {
          $this -> error = "Введите ваш email";
          return;
        }
        $this -> data["email"] =  $email;

        $promocode = ModelClass::fieldIsValid($post, "promocode");
        $this -> data["promocode"] =  ModelClass::promocodeIsValid($promocode) ? $promocode : null;

        $discount = ModelClass::fieldIsValid($post, "discount");
        $this -> data["discount"] =  ModelClass::discountIsValid($discount) ? $discount : null;

        $form = ModelClass::fieldIsValid($post, "form");
        $this -> data["form"] =  $form;

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
