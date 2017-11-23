<?php
/**
 * Created by PhpStorm.
 * User: Evgeny Bogdanov
 * Date: 21.11.2017
 * Time: 11:51
 */

require_once(__DIR__."/amocrm.php");

/**
 * @var AmoCRM $amo
 */
function amo_route($data) {
    header("Location: https://www.liqpay.ua/api/3/checkout?data=eyJ2ZXJzaW9uIjozLCJhY3Rpb24iOiJwYXkiLCJwdWJsaWNfa2V5IjoiaTc5NDM2NzUxMTIyIiwiYW1vdW50IjoiMTAwIiwiY3VycmVuY3kiOiJVQUgiLCJkZXNjcmlwdGlvbiI6ItCf0L7Qt9C00YDQsNCy0LvQtdC90LjQtSDQtNC70Y8g0L7QtNC90L7Qs9C%2BINGA0LXQsdC10L3QutCwINGB0L4g0YHQutC40LTQutC%2B0LkgNjAlIiwidHlwZSI6ImJ1eSIsImxhbmd1YWdlIjoicnUifQ%3D%3D&signature=HHVfQqB9VnXoj%2Fsr6%2BjuTENpJOQ%3D");
    global $amo;
    //echo "<pre>";
    //print_r($data);
    $data["host_referer"] = (isset($data["host_referer"]) ? $data["host_referer"] : @(string)$_SERVER["HTTP_REFERER"]);
    if ($amo->auth()) {
        $contact = $amo->check_contact_entity($data["name"], $data["email"], $data["phone"]);
        if (!empty($contact)) {
            @parse_str(substr(strstr($data["host_referer"], "?"), 1), $params);
            if (!(is_array($params) && !empty($params))) {
                $params = array();
            }
            $children = (isset($data["childrean"]) && $data["childrean"] == 2 ? 2 : 1);
            $res = $amo->leads_add(array(
                "name"=>"Заявка с сайта",
                "price"=>12345, // Сумма сделки  *** Правка ***
                "status_id"=>AMO_DEFAULT_STATUS,
                "custom_fields"=>array(
                    array(
                        "id"=>283057,
                        "values"=>array(
                            array(
                                "value"=>"http://no-link.domain.local"
                            )
                        )
                    ), // ID: Ссылка на оплату *** Правка ***
                    array(
                        "id"=>283129,
                        "values"=>array(
                            array(
                                "value"=>$data["promocode"]
                            )
                        )
                    ), // ID: Промокод
                    array(
                        "id"=>283235,
                        "values"=>array(
                            array(
                                "value"=>$data["host_referer"]
                            )
                        )
                    ), // ID: URL
                    array(
                        "id"=>283069,
                        "values"=>array(
                            array(
                                "value"=>@$params["utm_source"]
                            )
                        )
                    ), // ID: utm_source
                    array(
                        "id"=>283073,
                        "values"=>array(
                            array(
                                "value"=>@$params["utm_medium"]
                            )
                        )
                    ), // ID: utm_medium
                    array(
                        "id"=>283075,
                        "values"=>array(
                            array(
                                "value"=>@$params["utm_term"]
                            )
                        )
                    ), // ID: utm_term
                    array(
                        "id"=>283107,
                        "values"=>array(
                            array(
                                "value"=>@$params["utm_campaign"]
                            )
                        )
                    ), // ID: utm_campaign
                    array(
                        "id"=>283077,
                        "values"=>array(
                            array(
                                "value"=>@$params["utm_content"]
                            )
                        )
                    ), // ID: utm_content
                    array(
                        "id"=>283189,
                        "values"=>array(
                            array(
                                "value"=>@$data["image"]
                            )
                        )
                    ), // ID: Фото (ссылка) *** Правка ***
                    array(
                        "id"=>283151,
                        "values"=>array(
                            array(
                                "value"=>$children
                            )
                        )
                    ), // ID: Кол-во детей
                    array(
                        "id"=>283173,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["gender-1"]) && ($data["gender-1"] === "" || $data["gender-1"] == 1) ? "Мужской":"Женский")
                            )
                        )
                    ), // ID: Пол 1-го ребенка
                    array(
                        "id"=>283175,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["new-name-1"]) && $data["new-name-1"] == "on" ? 1 : 0)
                            )
                        )
                    ), // ID: Имя 1-го уникальное
                    array(
                        "id"=>283177,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["new-name-1"]) && $data["new-name-1"] == "on" ? @$data["child-name-new-1"] : $data["child-name-1"])
                            )
                        )
                    ), // ID: Имя 1-го ребенка
                    array(
                        "id"=>283179,
                        "values"=>array(
                            array(
                                "value"=>($children == 2 ? (isset($data["gender-2"]) && ($data["gender-2"] === "" || $data["gender-2"] == 1) ? "Мужской":"Женский") : "")
                            )
                        )
                    ), // ID: Пол 2-го ребенка
                    array(
                        "id"=>283183,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["new-name-2"]) && $data["new-name-2"] == "on" ? 1 : 0)
                            )
                        )
                    ), // ID: Имя 2-го уникальное
                    array(
                        "id"=>283187,
                        "values"=>array(
                            array(
                                "value"=>($children == 2 ? (isset($data["new-name-2"]) && $data["new-name-2"] == "on" ? @$data["child-name-new-2"] : $data["child-name-2"]) : "")
                            )
                        )
                    ), // ID: Имя 2-го ребенка
                )
            ));
            if ($res = $res["leads"]["add"][0]["id"]) {
                sleep(1);
                $leads_ids = (isset($contact["linked_leads_id"]) ? $contact["linked_leads_id"] : array());
                $leads_ids[] = $res;
                $amo->contacts_update(array(
                    "id"=>$contact["id"],
                    "last_modified"=>time()+10,
                    "linked_leads_id"=>$leads_ids
                ));
                return $res;
            }
        }
    }
    return null;
}