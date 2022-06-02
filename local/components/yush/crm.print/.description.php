<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage("CRM_PRINT_TITLE"),
	"DESCRIPTION" => Loc::GetMessage("CRM_PRINT_DESCR"),
	"ICON" => "",
	"COMPLEX" => "N",
	"PATH" => array(
        "ID" => "YUSH",
        "CHILD" => array(
            "ID" => "user",
            "NAME" => Loc::GetMessage("CRM_PRINT_TITLE_NAME")
        ),
	),
);

?>
