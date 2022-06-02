<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();

    use Bitrix\Main\Localization\Loc,
        Bitrix\Main,
        Bitrix\Crm;
/**
 * @global \CMain $APPLICATION
 * @global \CUser $USER
 * @global \CDatabase $DB
 * @var \CUserTypeManager $USER_FIELD_MANAGER
 * @var \CBitrixComponent $this
 * @var array $arParams
 * @var array $arResult
 */

global $USER_FIELD_MANAGER, $USER, $APPLICATION, $DB;

$isErrorOccured = false;
$errorMessage = '';

if (!CModule::IncludeModule('crm'))
{
	$errorMessage = GetMessage('CRM_MODULE_NOT_INSTALLED');
	$isErrorOccured = true;
}

$isBizProcInstalled = IsModuleInstalled('bizproc');
if (!$isErrorOccured && $isBizProcInstalled)
{
	if (!CModule::IncludeModule('bizproc'))
	{
		$errorMessage = GetMessage('BIZPROC_MODULE_NOT_INSTALLED');
		$isErrorOccured = true;
	}
	elseif (!CBPRuntime::isFeatureEnabled())
	{
		$isBizProcInstalled = false;
	}
}

$currentUserID = $USER->GetID();

$rsGroup = CUser::GetUserGroupList($currentUserID);
while ($arGroup = $rsGroup->Fetch()) {
    $currentGroups[] = $arGroup['GROUP_ID'];
}

$parametrGroups = $arParams['USER_ROLE'];
$keyAccess = false;

$groupsAccess = array_intersect($parametrGroups, $currentGroups);

if ($groupsAccess[0]) {

    $pageSize = $arParams['ENTITY_COUNT'];
    $entityKeys = $arParams['CRM_ENTITY'];

    $arFilter = [
        'ASSIGNED_BY_ID' => $currentUserID
    ];

    $arSort = array();
    $arSelect = array();

    function getEntitysList($dbResult, $pageSize, $link) {
        $qty = 0;

        while($arEntity = $dbResult->GetNext())
        {

            if($qty < $pageSize)
            {
                $result[$arEntity['ID']] = $arEntity;
                $result[$arEntity['ID']]['LINK'] = $link. $arEntity['ID'].'/';
            } else {
                break;
            }
            $qty++;

        }
        return $result;
    }

    function mergeResult($arResult, $arEntity) {
        if ((is_array($arEntity)) && (!empty($arEntity))) {
            $result = array_merge($arResult, $arEntity);
        }
        return $result;
    }

    $arResult = array();

    foreach ($entityKeys as $key => $entityKey) {
        switch ($entityKey) {
            case 'LEAD':
                $dbResult = CCrmLead::GetListEx(
                    $arSort,
                    $arFilter,
                    false,
                    false,
                    $arSelect
                );
                $arResultLead = getEntitysList($dbResult, $pageSize, '/crm/lead/details/');
                $arResult = mergeResult($arResult, $arResultLead);
                break;
            case 'DEAL':
                $dbResult = CCrmDeal::GetListEx(
                    $arSort,
                    $arFilter,
                    false,
                    false,
                    $arSelect
                );
                $arResultDeal = getEntitysList($dbResult, $pageSize, '/crm/deal/details/');
                $arResult = mergeResult($arResult, $arResultDeal);
                break;
            case 'INVOICE':
                $dbResult = CCrmInvoice::GetList(
                    $arSort,
                    $arFilter,
                    false,
                    false,
                    $arSelect
                );
                $arResultInvoice = getEntitysList($dbResult, $pageSize, '/crm/invoice/show/2/');
                $arResult = mergeResult($arResult, $arResultInvoice);
                break;
            case 'QUOTE':
                $dbResult = CCrmQuote::GetList(
                    $arSort,
                    $arFilter,
                    false,
                    false,
                    $arSelect
                );
                $arResultQuote = getEntitysList($dbResult, $pageSize, '/crm/type/7/details/');
                $arResult = mergeResult($arResult, $arResultQuote);
                break;

            default:
                // code...
                break;
        }
    }
}

$this->IncludeComponentTemplate();


die();
?>
