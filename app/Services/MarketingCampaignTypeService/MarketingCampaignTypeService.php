<?php
namespace App\Services\MarketingCampaignTypeService;
interface MarketingCampaignTypeService{
    public function getAllMarketingCampaignTypes();
    public function addMarketingCampaignType($data);
    public function getMarketingCampaignTypeById($id);
    public function updateMarketingCampaignType($data, $id);
    public function deleteMarketingCampaignType($id);
    public function getTotalActiveMarketingCampaignTypes();
}
