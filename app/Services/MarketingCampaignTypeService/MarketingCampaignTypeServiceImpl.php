<?php
namespace App\Services\MarketingCampaignTypeService;
use App\Models\MarketingCampaignType;

class MarketingCampaignTypeServiceImpl implements MarketingCampaignTypeService{
    private $marketingCampaignType;
    public function __construct(){
        $this->marketingCampaignType = new MarketingCampaignType();
    }
    public function getAllMarketingCampaignTypes()
    {
        return $this->marketingCampaignType->getAllMarketingCampaignTypes();
    }

    public function addMarketingCampaignType($data)
    {
        return $this->marketingCampaignType->addMarketingCampaignType($data);
    }

    public function getMarketingCampaignTypeById($id)
    {
        return $this->marketingCampaignType->getMarketingCampaignTypeById($id);
    }

    public function updateMarketingCampaignType($data, $id)
    {
        return $this->marketingCampaignType->updateMarketingCampaignType($data, $id);
    }

    public function deleteMarketingCampaignType($id)
    {
        return $this->marketingCampaignType->deleteMarketingCampaignType($id);
    }

    public function getTotalActiveMarketingCampaignTypes()
    {
        return $this->marketingCampaignType->getTotalActiveMarketingCampaignTypes();
    }
}
