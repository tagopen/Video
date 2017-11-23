<?php
  require_once("mysql/meekrodb.2.3.class.php");

  class viewClass {
    function __construct() {
      
      //DB::$user = 'root';
      //DB::$password = '';
      //DB::$dbName = 'video';
      
      DB::$user = 'b18152559_admin';
      DB::$password = '7I7k6L7y';
      DB::$dbName = 'b18152559_video';

      DB::$host = 'localhost'; //defaults to localhost if omitted
      DB::$encoding = 'utf8'; // defaults to latin1 if omitted

    }

    public function getDiscount() {
      $results = DB::query("SELECT dc.* FROM discount AS dc WHERE dc.permission = %s AND dc.date_start <= %t AND dc.date_end >= %t", "public", date("Y-m-d"), date("Y-m-d"));
      if ($results) {
        foreach ($results as $row) {
          return $row["name"];
        }
      } else {
        return;
      }
    }

    public function getChildreanName() {
      $male = DB::query("SELECT cd.firstname FROM childrean AS cd WHERE cd.gender=%i", 1);
      $female = DB::query("SELECT cd.firstname FROM childrean AS cd WHERE cd.gender=%i", 0);
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
