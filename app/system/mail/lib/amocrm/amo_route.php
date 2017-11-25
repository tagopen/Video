<?php
/**
 * Created by PhpStorm.
 * User: Evgeny Bogdanov
 * Date: 21.11.2017
 * Time: 11:51
 */

require_once(__DIR__."/amocrm.php");

define("LIQPAY_PUBLIC_KEY", "i79436751122");
define("LIQPAY_PRIVATE_KEY", "cpNemwZYOdcFQnH6t03IRbH7t1iMjtPmjVsbZeZZ");

/**
 * @var AmoCRM $amo
 * @param array $data - POST data
 * @param string $leadname - Lead name
 * @param bool $redirect - Go to payment link?
 * @param int $status_id - Lead status ID
 * @return int - Lead ID
 */
function amo_route($data, $leadname = "Заявка с сайта", $redirect = true, $status_id = AMO_DEFAULT_STATUS) {
    global $amo;
    $price = (isset($data["price"]) ? $data["price"] : 0);
    $children = (isset($data["childrean"]) && $data["childrean"] == 2 ? 2 : 1);
    $data["host_referer"] = (isset($data["host_referer"]) ? $data["host_referer"] : @(string)$_SERVER["HTTP_REFERER"]);
    if ($amo->auth()) {
        $contact = $amo->check_contact_entity((isset($data["firstname"]) ? $data["firstname"] : "Новый контакт"), @$data["email"], $data["phone"]);
        if (!empty($contact)) {
            @parse_str(substr(strstr($data["host_referer"], "?"), 1), $params);
            if (!(is_array($params) && !empty($params))) {
                $params = array();
            }
            $res = $amo->leads_add(array(
                "name"=>$leadname,
                "price"=>$price, // Сумма сделки
                "status_id"=>$status_id,
                "custom_fields"=>(AMO_DEFAULT_STATUS == $status_id ? array(
                    array(
                        "id"=>283129,
                        "values"=>array(
                            array(
                                "value"=>$data["discount"]
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
                                "value"=>"http://".$_SERVER["HTTP_HOST"]."/".@$data["image"]
                            )
                        )
                    ), // ID: Фото (ссылка)
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
                                "value"=>(isset($data["child1"]["gender"]) && ($data["child1"]["gender"] === "" || $data["child1"]["gender"] == 1) ? "Мужской":"Женский")
                            )
                        )
                    ), // ID: Пол 1-го ребенка
                    array(
                        "id"=>283175,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["child1"]["newname"]["trigger"]) && $data["child1"]["newname"]["trigger"] == "on" ? 1 : 0)
                            )
                        )
                    ), // ID: Имя 1-го уникальное
                    array(
                        "id"=>283177,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["child1"]["newname"]["trigger"]) && $data["child1"]["newname"]["trigger"] == "on" ? @$data["child1"]["newname"]["name"] : $data["child1"]["name"][(isset($data["child1"]["gender"]) && ($data["child1"]["gender"] === "" || $data["child1"]["gender"] == 1) ? "male":"female")])
                            )
                        )
                    ), // ID: Имя 1-го ребенка
                    array(
                        "id"=>283179,
                        "values"=>array(
                            array(
                                "value"=>($children == 2 ? (isset($data["child2"]["gender"]) && ($data["child2"]["gender"] === "" || $data["child2"]["gender"] == 1) ? "Мужской":"Женский") : "")
                            )
                        )
                    ), // ID: Пол 2-го ребенка
                    array(
                        "id"=>283183,
                        "values"=>array(
                            array(
                                "value"=>(isset($data["child2"]["newname"]["trigger"]) && $data["child2"]["newname"]["trigger"] == "on" ? 1 : 0)
                            )
                        )
                    ), // ID: Имя 2-го уникальное
                    array(
                        "id"=>283187,
                        "values"=>array(
                            array(
                                "value"=>($children == 2 ? (isset($data["child2"]["newname"]["trigger"]) && $data["child2"]["newname"]["trigger"] == "on" ? @$data["child2"]["newname"]["name"] : $data["child2"]["name"][(isset($data["child2"]["gender"]) && ($data["child2"]["gender"] === "" || $data["child2"]["gender"] == 1) ? "male":"female")]) : "")
                            )
                        )
                    ), // ID: Имя 2-го ребенка
                ) : array())
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
                if ($redirect && $price > 0) {
                    $payLink = "https://www.liqpay.ua/api/3/checkout?";
                    $payData = array();
                    $payData["data"] = base64_encode(json_encode(array(
                        "version"=>3,
                        "action"=>"pay",
                        "public_key"=>LIQPAY_PUBLIC_KEY,
                        "amount"=>$price,
                        "currency"=>"UAH",
                        "description"=>"Поздравление для ".($children > 1 ? "двух детей" : "одного ребенка"),
                        "type"=>"buy",
                        "language"=>"ru",
                        "order_id"=>$res
                    )));
                    $payData["signature"] = base64_encode(sha1(LIQPAY_PRIVATE_KEY.$payData["data"].LIQPAY_PRIVATE_KEY,1));
                    $payLink .= http_build_query($payData);
                    sleep(1);
                    $amo->leads_update(
                        array(
                            "id"=>$res,
                            "last_modified"=>time()+10,
                            "custom_fields"=>array(
                                array(
                                    "id"=>283057,
                                    "values"=>array(
                                        array(
                                            "value"=>$payLink
                                        )
                                    )
                                ), // ID: Ссылка на оплату
                            )
                        )
                    );
                    header("Location: ".$payLink);
                }
                return $res;
            }
        }
    }
    return null;
}