<?php
namespace Maycat\D7dull;

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class ExampleTable extends DataManager
{
    public static function getTableName()
    {
        return 'd7dull_example';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ID'),
            )),
            new StringField('NAME', array(
                'required' => true,
                'title' => Loc::getMessage('NAME'),
                'default_value' => function () {
                    return Loc::getMessage('NAME_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                },
            )),
            new StringField('IMAGE_SET', [
                'required' => false,
                'title' => Loc::getMessage('IMAGE_SET'),
                'fetch_data_modification' => function () {
                    return array(
                        function ($value) {
                            if (strlen($value)) {
                                return explode(',', $value);
                            }
                        },
                    );
                },
                'save_data_modification' => function () {
                    return array(
                        function ($value) {
                            if (is_array($value)) {
                                $value = array_filter($value, 'intval');

                                return implode(',', $value);
                            }
                        },
                    );
                },
            ]),
        );
    }
}
