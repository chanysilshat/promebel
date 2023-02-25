<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

/**
 * @arResult
 * @arParams
 */
class GramorSearch extends CBitrixComponent
{
    public function executeComponent()
    {

        $this->arResult["AJAX"] = $this->__path."/ajax.php";

        if ($this->arParams["SEARCH_MODE"] == "Y"){
            $template = "search";
        }

        if (!empty($this->arParams["SEARCH"])){
            $this->collectArResult();
        }

        $this->includeComponentTemplate($template);
    }

    private function collectArResult()
    {
        CModule::IncludeModule("iblock");
        
        $filter = [
            "IBLOCK_ID" => $this->arParams["IBLOCK_ID"],
            "ACTIVE" => "Y",
            "NAME" => "%" . $this->arParams["SEARCH"] . "%"
        ];

        $select = [
            "NAME",
            "ID", 
            "IBLOCK_ID",
            "IBLOCK_SECTION",
            "PROPERTY_GALLERY",
            "PREVIEW_PICTURE",
            "SECTION_PAGE_URL",
            "DETAIL_PAGE_URL" 
        ];

        $cnt = CIBLockElement::GetList([], $filter, [], false, $select);
        $this->arResult["COUNT_ELEMENT"] = $cnt; 
        $res = CIBLockElement::GetList([], $filter, false, ["nPageSize"=>50], $select);

        while ($result = $res->GetNext()){
            
            $this->arResult["ITEMS"][$result["ID"]]["ID"] = $result["ID"];
            $this->arResult["ITEMS"][$result["ID"]]["NAME"] = $result["NAME"];
            $this->arResult["ITEMS"][$result["ID"]]["IBLOCK_SECTION_ID"] = $result["IBLOCK_SECTION_ID"];
            $this->arResult["ITEMS"][$result["ID"]]["DETAIL_PAGE_URL"] = $result["DETAIL_PAGE_URL"];
            $this->arResult["ITEMS"][$result["ID"]]["PRICE"] =  CPrice::GetBasePrice($result["ID"]);
            $this->arResult["ITEMS"][$result["ID"]]["PICTURE"][$result["PREVIEW_PICTURE"]] = CFile::GetPath($result["PREVIEW_PICTURE"]);
            $this->arResult["ITEMS"][$result["ID"]]["PICTURE"][$result["PROPERTY_GALLERY_VALUE"]] = CFile::GetPath($result["PREVIEW_PICTURE"]);
        }

    }
}