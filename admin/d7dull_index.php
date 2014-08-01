<?php

use Bitrix\Main\Localization\Loc;

define('ADMIN_MODULE_NAME', 'maycat.d7dull');

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_before.php';

// @todo: Здесь - какой-то системный код, читающие данные и всё такое

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_admin_after.php';

Echo "Welcome to admin area";

require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/epilog_admin.php');

?>