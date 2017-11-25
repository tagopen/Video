<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 25.11.2017
 * Time: 16:18
 */
file_put_contents(time().".log", print_r($GLOBALS,1));

if (isset($_POST["data"]) && !empty($_POST["data"])) {
    $data = json_decode(base64_decode($_POST["data"]), true);
    // Добавлен код интеграции amoCRM
    if ($data["status"] == "success" && $data["action"] == "pay" && !empty($data["order_id"])) {
        if (is_file('./mail/lib/amocrm/amo_route.php')) {
            require_once("./mail/lib/amocrm/amo_route.php");
        }
        if ($amo->auth()) {
            sleep(1);
            $amo->leads_update(
                array(
                    "id"=>$data["order_id"],
                    "last_modified"=>time()+10,
                    "status_id"=>17354764,
                    "custom_fields"=>array(
                        array(
                            "id"=>283113,
                            "values"=>array(
                                array(
                                    "value"=>"1"
                                )
                            )
                        ), // ID: Оплачено
                    )
                )
            );
        }

    }
}

