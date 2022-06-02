<?
use Bitrix\Main\Localization\Loc;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)die();
// $arRes = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields("USER", 0, LANGUAGE_ID);
// $userProp = array();
// if (!empty($arRes))
// {
// 	foreach ($arRes as $key => $val)
// 		$userProp[$val["FIELD_NAME"]] = ($val["EDIT_FORM_LABEL"] <> '' ? $val["EDIT_FORM_LABEL"] : $val["FIELD_NAME"]);
// }

$userRoleList = [
    "Администратор",
    "Пользователь"
];

$entityList = [
    "Лид",
    "Сделка",
    "Счёт",
    "Предложение",
];


$arComponentParameters = array(
	"PARAMETERS" => array(
		"SET_TITLE" => array(),
		"USER_ROLE"=>array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => Loc::getMessage("USER_ROLE"),
			"TYPE" => "LIST",
			"VALUES" => $userRoleList,
			"MULTIPLE" => "Y",
			"DEFAULT" => array(),
		),
        "CRM_ENTITY"=>array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => Loc::getMessage("CRM_ENTITY"),
			"TYPE" => "LIST",
			"VALUES" => $entityList,
			"MULTIPLE" => "Y",
			"DEFAULT" => array(),
		),
	),
);
?>
