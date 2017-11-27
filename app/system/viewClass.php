<?php
  if (is_file('./config.php')) {
    require_once("./config.php");
  }

  if (is_file('system/mysql/meekrodb.2.3.class.php')) {
    require_once("system/mysql/meekrodb.2.3.class.php");
  }

  class viewClass {
    function __construct() {
      
      DB::$user = DB_USERNAME;
      DB::$password = DB_PASSWORD;
      DB::$dbName = DB_DATABASE;

      DB::$host = DB_HOSTNAME; //defaults to localhost if omitted
      DB::$encoding = DB_ENCODING; // defaults to latin1 if omitted

    }

    public function getDiscount() {
      $results = DB::query("SELECT dc.* FROM discount AS dc WHERE dc.permission = %s AND dc.date_start <= %t AND dc.date_end >= %t", "public", date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
          return array(
            "name" => $row["name"],
            "price" => (int)$row["price"]
            );
        }
      } else {
        return array(
          "name" => "",
          "price" => "0"
          );
      }
    }

    public function getChildreanName() {
      $male = DB::query("SELECT cd.firstname FROM childrean AS cd WHERE cd.gender=%i AND cd.status=%s", 1, "1");
      $female = DB::query("SELECT cd.firstname FROM childrean AS cd WHERE cd.gender=%i AND cd.status=%s", 0, "1");
      if ($male && $female) {
        return array(
          "male" => $male,
          "female" => $female
          );
      } else {
        return;
      }
    }

    public function getProductPrice() {

      $results = DB::query("SELECT ps.* FROM product_special AS ps WHERE ps.date_start <= %t AND ps.date_end >= %t ", date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
          return (int)$row['price'];
        }
      } else {
        return;
      }
    }
    
  }
?>
