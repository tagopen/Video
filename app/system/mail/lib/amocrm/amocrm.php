<?php
/*
Description: amoCRM API connector
Creator: Evgenii Bogdanov <admin@prow.su>
Date: 03.05.2017
*/
define("AMO_DOMAIN",'videopozdravlenie');
define("AMO_USER",'yadedushkamoroz2017@gmail.com');
define("AMO_HASH",'ab1663232e91cbb6d7643ab28551f50c');
define("AMO_DEFAULT_STATUS", 17354662); // Статус по-умолчанию
define("AMO_EMAIL_FIELD", 262519); // ID поля email
define("AMO_PHONE_FIELD", 262517); // ID поля телефон
define("AMO_GLOBAL_SEARCH", "phone"); // Поиск по "email" или "phone"

class amoCRM {
    private $host;
    private $user;
    private $hash;
    public $cookie;
    public $data;

    function __construct() {
        $this->cookie = "user";
        $this->host = AMO_DOMAIN.".amocrm.ru";
        $this->user = AMO_USER;
        $this->hash = AMO_HASH;
    }
    // Метод запросов
    private function call($method, $endpoint, $data = array(), $json = true, $ref = false) {
        if (substr($endpoint,0,8) == "https://") {
            $link = $endpoint;
        } else if (substr($endpoint,0,2) == "//") {
            $link = "https://".$this->host.substr($endpoint,1);
        } else {
            $link = "https://".$this->host."/private/api".($json ? "/v2/json/":"").$endpoint;
        }
        //echo "DEST_URL: [".$method."] ".$link.PHP_EOL;
        $curl=curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/connector');
        if ($ref) curl_setopt($curl, CURLOPT_REFERER, $ref);
        if ($method == "POST") {
            curl_setopt($curl,CURLOPT_URL,$link);
            if (substr($endpoint,0,2) == "//" || substr($endpoint,0,8) == "https://") {
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
                curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
                curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
            }
        } else {
            curl_setopt($curl,CURLOPT_URL,$link.'?'.@http_build_query($data));
            curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
        }

        curl_setopt($curl,CURLOPT_HEADER,false);
        curl_setopt($curl,CURLOPT_COOKIEFILE,__DIR__.'/amo_'.$this->cookie.'.dat');
        curl_setopt($curl,CURLOPT_COOKIEJAR,__DIR__.'/amo_'.$this->cookie.'.dat');
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);

        $out=curl_exec($curl);
        $code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
        $code=(int)$code;
        $errors=array(
            301=>'Moved permanently',
            400=>'Bad request',
            401=>'Unauthorized',
            403=>'Forbidden',
            404=>'Not found',
            500=>'Internal server error',
            502=>'Bad gateway',
            503=>'Service unavailable'
        );
        if($code!=200 && $code!=204) {
            $err='Error: '.(isset($errors[$code]) ? $errors[$code] : 'Undescribed error').PHP_EOL.' ErrorCode: '.$code;
            $eml=$this->host."\r\nБыстро проверить проблему!!!\r\nhttp://".@$_SERVER['HTTP_HOST'].@$_SERVER['REQUEST_URI']."\r\nGET: ".print_r($_GET,1)."\r\nPOST: ".print_r($_POST,1)."\r\n".$out."\r\n---\r\n".$err;
            mail(AMO_USER,"Error!",$eml,"Content-type: text/plain; charset=UTF-8\r\nMime-Version: 1.0");
            die($eml);
        }
        @($out = json_decode($out,true));
        return @$out['response'];
    }
    private function api($method, $endpoint, $data = array()) {
        return $this->call($method, $endpoint, $data);
    }
    // Метод авторизации
    public function auth() {
        $data = $this->call("POST","/auth.php?type=json", array(
            "USER_LOGIN"=>$this->user,
            "USER_HASH"=>$this->hash
        ),false);
        return @$data["auth"] == "1";
    }
    public function contacts_list($query = false) {
        return $this->api("GET", "contacts/list", $query);
    }
    public function contacts_add($arr) {
        return $this->api("POST", "contacts/set", array(
            "request" => array(
                "contacts" => array(
                    "add" => array($arr)
                )
            )
        ));
    }
    public function contacts_update($arr) {
        return $this->api("POST", "contacts/set", array(
            "request" => array(
                "contacts" => array(
                    "update" => array($arr)
                )
            )
        ));
    }
    public function leads_list($query = false) {
        return $this->api("GET", "leads/list", $query);
    }
    public function leads_add($arr) {
        return $this->api("POST", "leads/set", array(
            "request" => array(
                "leads" => array(
                    "add" => array($arr)
                )
            )
        ));
    }
    public function leads_update($arr) {
        return $this->api("POST", "leads/set", array(
            "request" => array(
                "leads" => array(
                    "update" => array($arr)
                )
            )
        ));
    }

    // Дополнительные функции
    public function get_contact_by_id($id) {
        $res = $this->contacts_list(array("id"=>$id));
        if (isset($res["contacts"][0]["id"])) {
            return $res["contacts"][0];
        }
        return null;
    }
    public function get_contact_by_email($email) {
        $res = $this->contacts_list(array("query"=>"'".$email."'"));
        if (isset($res["contacts"][0]["id"])) {
            return $res["contacts"][0];
        }
        return null;
    }
    public function get_contact_by_phone($phone) {
        return $this->get_contact_by_email($phone);
    }

    public function get_lead_by_id($id) {
        $res = $this->leads_list(array("id"=>$id));
        if (isset($res["leads"][0]["id"])) {
            return $res["leads"][0];
        }
        return null;
    }
    public function get_lead_by_email($email) {
        $res = $this->leads_list(array("query"=>"'".$email."'"));
        if (isset($res["leads"][0]["id"])) {
            return $res["leads"][0];
        }
        return null;
    }
    public function get_lead_by_phone($phone) {
        return $this->get_lead_by_email($phone);
    }

    public function check_contact_entity($name, $email, $phone) {
        $var = AMO_GLOBAL_SEARCH;
        $cmd = "get_contact_by_".$var;
        if (!($contact = $this->$cmd($$var))) {
            sleep(1);
            $contact = $this->contacts_add(array(
                "name" => $name,
                "custom_fields" => array(
                    array(
                        "id" => AMO_EMAIL_FIELD, // Email field ID
                        "values" => array(
                            array(
                                "value" => $email,
                                "enum" => "WORK"
                            )
                        )
                    ),
                    array(
                        "id" => AMO_PHONE_FIELD, // Phone field ID
                        "values" => array(
                            array(
                                "value" => $phone,
                                "enum" => "WORK"
                            )
                        )
                    )
                )
            ));
            if (isset($contact["contacts"]["add"][0]["id"])) {
                $contact = $this->get_contact_by_id($contact["contacts"]["add"][0]["id"]);
            }
        }
        return $contact;
    }

    public function check_lead_pair($name, $email, $phone, $status = false) {
        $createLead = false;
        $extLead = null;
        if ($lead = $this->get_lead_by_email($email)) {
            $extLead = $lead;
        } else if ($contact = $this->get_contact_by_email($email)) {
            $createLead = $contact;
        } else {
            sleep(1);
            $contact = $this->contacts_add(array(
                "name"=>$name,
                "custom_fields"=>array(
                    array(
                        "id"=>AMO_EMAIL_FIELD, // Email field ID
                        "values"=>array(
                            array(
                                "value"=>$email,
                                "enum"=>"WORK"
                            )
                        )
                    ),
                    array(
                        "id"=>AMO_PHONE_FIELD, // Phone field ID
                        "values"=>array(
                            array(
                                "value"=>$phone,
                                "enum"=>"WORK"
                            )
                        )
                    )
                )
            ));
            if (isset($contact["contacts"]["add"][0]["id"])) {
                $createLead = array(
                    "id"=>$contact["contacts"]["add"][0]["id"],
                    "linked_leads_id"=>array()
                );
            }
        }

        if ($createLead) {
            sleep(1);
            $leadId = $this->leads_add(array(
                "name"=>$name,
                "price"=>0,
                "status_id"=>($status !== false ? $status : AMO_DEFAULT_STATUS),
                "custom_fields"=>array()
            ));
            if (isset($leadId["leads"]["add"][0]["id"])) {
                sleep(1);
                $leads_ids = (isset($createLead["linked_leads_id"]) ? $createLead["linked_leads_id"] : array());
                $leads_ids[] = $leadId["leads"]["add"][0]["id"];
                $this->contacts_update(array(
                    "id"=>$createLead["id"],
                    "last_modified"=>time()+10,
                    "linked_leads_id"=>$leads_ids
                ));
                sleep(1);
                $extLead = $this->get_lead_by_id($leadId["leads"]["add"][0]["id"]);
            }
        }
        return $extLead;
    }
    public function add_tag_to_lead($lead_id, $tag) {
        if ($lead = (is_array($lead_id) ? $lead_id : $this->get_lead_by_id($lead_id))) {
            sleep(1);
            $tags = (is_array($lead["tags"]) && !empty($lead["tags"]) ? $lead["tags"] : array());
            $tags_out = [$tag];
            foreach ($tags as $t) {
                if ($t["name"] != $tag) {
                    $tags_out[] = $t["name"];
                }
            }
            return !empty($this->leads_update(array(
                "id"=>$lead["id"],
                "last_modified"=>time()+10,
                "tags"=>implode(", ", $tags_out)
            )));
        }
        return null;
    }
    public function change_lead_status($lead_id, $status_id) {
        sleep(1);
        if ($lead = (is_array($lead_id) ? $lead_id : $this->get_lead_by_id($lead_id))) {
            if (is_array($lead) && $status_id !== false && $status_id != AMO_DEFAULT_STATUS) {
                if ($status_id > 0 && $lead["status_id"] != $status_id) {
                    sleep(1);
                    return !empty($this->leads_update(array(
                        "id"=>$lead["id"],
                        "last_modified"=>time()+10,
                        "status_id"=>$status_id
                    )));
                }
            }
        }
        return null;
    }
}
$amo = new AmoCRM();