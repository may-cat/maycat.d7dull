<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

Bitrix\Main\Loader::registerAutoLoadClasses(
    'maycat.d7dull',
    array(
        'Maycat\D7dull\ExampleTable' => 'lib/ExampleTable.php',
    )
);
