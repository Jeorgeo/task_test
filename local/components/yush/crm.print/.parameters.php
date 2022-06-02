<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)die();

use Bitrix\Main\Localization\Loc,
    Bitrix\Main;

$rsGroups = CGroup::GetList(($by="c_sort"), ($order="desc"), array());

while($arEntity = $rsGroups->GetNext())
{
    $userRoleList[$arEntity['ID']] = $arEntity['NAME'];
};

$entityList = [
    'LEAD' => 'Лид',
    'DEAL' => 'Сделка',
    'INVOICE' => 'Счёт',
    'QUOTE' => 'Предложение'
];

$arComponentParameters = array(
	'PARAMETERS' => array(
        'ENTITY_COUNT' => array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => GetMessage('CRM_DEAL_COUNT'),
			'TYPE' => 'STRING',
			'DEFAULT' => '50'
		),
		'USER_ROLE'=>array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => Loc::getMessage('USER_ROLE'),
			'TYPE' => 'LIST',
			'VALUES' => $userRoleList,
			'MULTIPLE' => 'Y',
			'DEFAULT' => array(),
		),
        'CRM_ENTITY'=>array(
			'PARENT' => 'ADDITIONAL_SETTINGS',
			'NAME' => Loc::getMessage('CRM_ENTITY'),
			'TYPE' => 'LIST',
			'VALUES' => $entityList,
			'MULTIPLE' => 'Y',
			'DEFAULT' => array(),
		),
	),
);
?>
