<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

$pageId = "user_blog";
include("util_menu.php");
include("util_profile.php");

$APPLICATION->IncludeComponent(
	"bitrix:socialnetwork.blog.menu",
	"",
	Array(
		"PATH_TO_USER" => $arResult["PATH_TO_USER"],
		"PATH_TO_POST_EDIT" => $arResult["PATH_TO_USER_BLOG_POST_EDIT"],
		"PATH_TO_DRAFT" => $arResult["PATH_TO_USER_BLOG_DRAFT"],
		"PATH_TO_TAGS" => $arResult["PATH_TO_USER_BLOG_TAGS"],
		"USER_ID" => $arResult["VARIABLES"]["user_id"],
		"USER_VAR" => $arResult["ALIASES"]["user_id"] ?? null,
		"PAGE_VAR" => $arResult["ALIASES"]["blog_page"] ?? null,
		"POST_VAR" => $arResult["ALIASES"]["post_id"] ?? null,
		"PATH_TO_BLOG" => $arResult["PATH_TO_USER_BLOG"],
		"SET_NAV_CHAIN" => $arResult["SET_NAV_CHAIN"],
		"GROUP_ID" => $arParams["BLOG_GROUP_ID"],
		"NAME_TEMPLATE" => $arParams["NAME_TEMPLATE"],
		"SHOW_LOGIN" => $arParams["SHOW_LOGIN"],
		"PATH_TO_MODERATION" => $arResult["PATH_TO_USER_BLOG_MODERATION"],
		"CURRENT_PAGE" => "draft",
		'HIDE_OWNER_IN_TITLE' => $arParams['HIDE_OWNER_IN_TITLE']
	),
	$this->getComponent()
);

$arResult["PATH_TO_BLOG_CATEGORY"] = $arResult["PATH_TO_USER_BLOG"].(mb_strpos($arResult["PATH_TO_USER_BLOG"], "?") === false ? "?" : "&")."category=#category_id#";

$arComponentParams = [
	"MESSAGE_COUNT" => "25",
	"DATE_TIME_FORMAT" => $arParams["DATE_TIME_FORMAT"],
	"PATH_TO_BLOG" => $arResult["PATH_TO_USER_BLOG"],
	"PATH_TO_BLOG_CATEGORY" => $arResult["PATH_TO_BLOG_CATEGORY"],
	"PATH_TO_POST" => $arResult["PATH_TO_USER_BLOG_POST"],
	"PATH_TO_POST_EDIT" => $arResult["PATH_TO_USER_BLOG_POST_EDIT"],
	"PATH_TO_USER" => $arResult["PATH_TO_USER"],
	"PATH_TO_SMILE" => $arParams["PATH_TO_BLOG_SMILE"],
	"USER_ID" => $arResult["VARIABLES"]["user_id"],
	"CACHE_TYPE" => $arResult["CACHE_TYPE"],
	"CACHE_TIME" => $arResult["CACHE_TIME"],
	"CACHE_TIME_LONG" => "604800",
	"SET_NAV_CHAIN" => "N",
	"SET_TITLE" => $arResult["SET_TITLE"],
	"NAV_TEMPLATE" => "",
	"POST_PROPERTY_LIST" => array(),
	"USER_VAR" => $arResult["ALIASES"]["user_id"] ?? null,
	"PAGE_VAR" => $arResult["ALIASES"]["blog_page"] ?? null,
	"POST_VAR" => $arResult["ALIASES"]["post_id"] ?? null,
	"GROUP_ID" => $arParams["BLOG_GROUP_ID"] ?? null,
	"IMAGE_MAX_WIDTH" => $arParams["BLOG_IMAGE_MAX_WIDTH"] ?? null,
	"IMAGE_MAX_HEIGHT" => $arParams["BLOG_IMAGE_MAX_HEIGHT"] ?? null,
	"ALLOW_POST_CODE" => $arParams["BLOG_ALLOW_POST_CODE"],
	"PATH_TO_GROUP" => $arParams["PATH_TO_GROUP"] ?? null,
	"BLOG_NO_URL_IN_COMMENTS" => $arParams["BLOG_NO_URL_IN_COMMENTS"] ?? null,
	"BLOG_NO_URL_IN_COMMENTS_AUTHORITY" => $arParams["BLOG_NO_URL_IN_COMMENTS_AUTHORITY"] ?? null
];

$APPLICATION->IncludeComponent(
	"bitrix:ui.sidepanel.wrapper",
	"",
	array(
		'POPUP_COMPONENT_NAME' => "bitrix:socialnetwork.blog.draft",
		"POPUP_COMPONENT_TEMPLATE_NAME" => "",
		"POPUP_COMPONENT_PARAMS" => $arComponentParams,
		"POPUP_COMPONENT_PARENT" => $this->getComponent(),
	)
);
?>
