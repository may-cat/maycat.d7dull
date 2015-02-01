<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Config\Option;

if (!$USER->IsAdmin()) {
    return;
}

define('ADMIN_MODULE_NAME', 'maycat.d7dull');

Loc::loadMessages($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/options.php");
Loc::loadMessages(__FILE__);

$tabControl = new CAdminTabControl("tabControl", array(
    array(
        "DIV" => "edit1",
        "TAB" => Loc::getMessage("MAIN_TAB_SET"),
        "TITLE" => Loc::getMessage("MAIN_TAB_TITLE_SET"),
    ),
));

if ((!empty($save) || !empty($restore)) && $REQUEST_METHOD == "POST" && check_bitrix_sessid()) {
    if (!empty($restore)) {
        Option::delete(ADMIN_MODULE_NAME);
        CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage("REFERENCES_OPTIONS_RESTORED"), "TYPE" => "OK"));
    } elseif (
        !empty($_REQUEST["max_image_size"])
        && $_REQUEST["max_image_size"] > 0
        && $_REQUEST["max_image_size"] < 100000
    ) {
        Option::set(
            ADMIN_MODULE_NAME,
            "max_image_size",
            $_REQUEST["max_image_size"],
            Loc::getMessage("REFERENCES_MAX_IMAGE_SIZE")
        );
        CAdminMessage::ShowMessage(array("MESSAGE" => Loc::getMessage("REFERENCES_OPTIONS_SAVED"), "TYPE" => "OK"));
    } else {
        CAdminMessage::ShowMessage(Loc::getMessage("REFERENCES_INVALID_VALUE"));
    }
}

$tabControl->Begin();
?>

<form method="post" action="<?= $APPLICATION->GetCurPage() ?>?mid=<?=urlencode($mid) ?>&amp;lang=<?= LANGUAGE_ID ?>">
	<?php $tabControl->BeginNextTab(); ?>
	<tr>
		<td width="40%">
			<label for="max_image_size"><?=Loc::getMessage("REFERENCES_MAX_IMAGE_SIZE") ?>:</label>
		<td width="60%">
			<input type="text" size="50" maxlength="5" name="max_image_size"
				   value="<?= htmlspecialcharsbx(
                       Option::get(ADMIN_MODULE_NAME, "max_image_size", 500)
                   ) ?>">
		</td>
	</tr>

	<?php $tabControl->Buttons(); ?>
	<input type="submit" name="save" value="<?=Loc::getMessage("MAIN_SAVE") ?>"
		   title="<?=Loc::getMessage("MAIN_OPT_SAVE_TITLE") ?>" class="adm-btn-save">
	<input type="submit" name="restore" title="<?=Loc::getMessage("MAIN_HINT_RESTORE_DEFAULTS") ?>"
		   OnClick="return confirm('<?= AddSlashes(GetMessage("MAIN_HINT_RESTORE_DEFAULTS_WARNING")) ?>')"
		   value="<?=Loc::getMessage("MAIN_RESTORE_DEFAULTS") ?>">
	<?= bitrix_sessid_post(); ?>
	<?php $tabControl->End(); ?>
</form>
