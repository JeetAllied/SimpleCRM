<?php
namespace App\Services\MarketingCampaignService;
interface MarketingCampaignService
{
    public function getAllMarketingCampaigns();
    public function addMarketingCampaign($data);
    public function getMarketingCampaignById($id);
    public function updateMarketingCampaign($data, $id);
    public function deleteMarketingCampaign($id);
    public function getTotalMarketingCampaigns();
}
