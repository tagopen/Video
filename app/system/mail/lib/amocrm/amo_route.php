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
    global $amo;
    //echo "<pre>";
    //print_r($data);
    $data["host_referer"] = (isset($data["host_referer"]) ? $data["host_referer"] : @(string)$_SERVER["HTTP_REFERER"]);
    if ($amo->auth()) {
        $contact = $amo->check_contact_entity($data["name"], $data["email"], $data["phone"]);
        if (!empty($contact)) {
            @parse_str(substr($data["host_referer"], strstr($data["host_referer"], "?"), strlen($data["host_referer"])), $params);
            if (!(is_array($params) && !empty($params))) {
                $params = array();
            }
            $res = $amo->leads_add(array(
                "name"=>"Заявка с сайта",
                "price"=>12345,
                "status_id"=>AMO_DEFAULT_STATUS,
                "custom_fields"=>array(
                    array(
                        "id"=>283057,
                        "values"=>array(
                            array(
                                "value"=>"http://no-link.domain.local"
                            )
                        )
                    ), // ID: Ссылка на оплату
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
                    ), // ID: Фото (ссылка)
                    array(
                        "id"=>283151,
                        "values"=>array(
                            array(
                                "value"=>1
                            )
                        )
                    ), // ID: Кол-во детей *** Правка ***
                    array(
                        "id"=>283173,
                        "values"=>array(
                            array(
                                "value"=>"???"
                            )
                        )
                    ), // ID: Пол 1-го ребенка *** Правка ***
                    array(
                        "id"=>283175,
                        "values"=>array(
                            array(
                                "value"=>"0"
                            )
                        )
                    ), // ID: Имя 1-го уникальное *** Правка ***
                    array(
                        "id"=>283177,
                        "values"=>array(
                            array(
                                "value"=>"ххх"
                            )
                        )
                    ), // ID: Имя 1-го ребенка *** Правка ***
                    array(
                        "id"=>283179,
                        "values"=>array(
                            array(
                                "value"=>"Тест"
                            )
                        )
                    ), // ID: Пол 2-го ребенка *** Правка ***
                    array(
                        "id"=>283183,
                        "values"=>array(
                            array(
                                "value"=>"1"
                            )
                        )
                    ), // ID: Имя 2-го уникальное *** Правка ***
                    array(
                        "id"=>283187,
                        "values"=>array(
                            array(
                                "value"=>"нет"
                            )
                        )
                    ), // ID: Имя 2-го ребенка *** Правка ***
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