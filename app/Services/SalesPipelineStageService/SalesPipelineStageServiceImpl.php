<?php
namespace App\Services\SalesPipelineStageService;
use App\Models\SalesPipelineStage;

class SalesPipelineStageServiceImpl implements SalesPipelineStageService{
    private $salesPipelineStage;
    public function __construct(){
        $this->salesPipelineStage = new SalesPipelineStage();
    }
    public function getAllSalesPipelineStages()
    {
        return $this->salesPipelineStage->getAllSalesPipelineStages();
    }

    public function addSalesPipelineStage($data)
    {
        return $this->salesPipelineStage->addSalesPipelineStage($data);
    }

    public function getSalesPipelineStageById($id)
    {
        return $this->salesPipelineStage->getSalesPipelineStageById($id);
    }

    public function updateSalesPipelineStage($data, $id)
    {
        return $this->salesPipelineStage->updateSalesPipelineStage($data, $id);
    }

    public function deleteSalesPipelineStage($id)
    {
        return $this->salesPipelineStage->deleteSalesPipelineStage($id);
    }

    public function getTotalActiveSalesPipelineStage()
    {
        return $this->salesPipelineStage->getTotalActiveSalesPipelineStage();
    }
}
