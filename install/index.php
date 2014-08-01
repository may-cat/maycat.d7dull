<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (class_exists('maycat_d7dull')) {
	return;
}

class maycat_d7dull extends CModule
{
	public $MODULE_ID = 'maycat.d7dull';
	public $MODULE_VERSION = '0.0.1';
	public $MODULE_VERSION_DATE = '2014-07-17 16:23:14';
	public $MODULE_NAME = 'D7 Образец';
	public $MODULE_DESCRIPTION = 'D7 Образец';
	public $MODULE_GROUP_RIGHTS = 'N';
	public $PARTNER_NAME = "Maycat";
	public $PARTNER_URI = "http://www.may-cat.ru";

	public function DoInstall()
	{
		global $APPLICATION;
        RegisterModule($this->MODULE_ID);
	}


	public function DoUninstall()
	{
		global $APPLICATION;
        UnRegisterModule($this->MODULE_ID);
	}

}

?>