<?php

namespace Maycat\D7dull;

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class model extends Entity\DataManager
{
    public static function getFilePath()
    {
        return __FILE__;
    }

    public static function getTableName()
    {
        return 'd7dull_model';
    }

    public static function getMap()
    {
        return array(
            'ID'      => array(
                'data_type'    => 'integer',
                'primary'      => true,
                'autocomplete' => true,
                'title'        => "ID",
            ),
            'NAME' => array(
                'data_type'  => 'string',
                'required'   => true,
                'validation' => array(__CLASS__, 'validateName'),
                'title'      => "Название",
            ),
        );
    }

    public static function validateName()
    {
        return array(
            new Entity\Validator\Length(null, 255),
        );
    }
}
