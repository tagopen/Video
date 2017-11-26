<?php
/**
 * Created by PhpStorm.
 * User: Evgeny
 * Date: 24.11.2017
 * Time: 5:44
 */

// Добавлен код интеграции amoCRM
if (is_file('./mail/lib/amocrm/amo_route.php')) {
    require_once("./mail/lib/amocrm/amo_route.php");
}

echo json_encode(amo_route($_POST, "Обратный звонок", false, 17417974));