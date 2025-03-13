<?php
namespace App\Services\SalesPipelineStageService;
interface SalesPipelineStageService{
    public function getAllSalesPipelineStages();
    public function addSalesPipelineStage($data);
    public function getSalesPipelineStageById($id);
    public function updateSalesPipelineStage($data, $id);
    public function deleteSalesPipelineStage($id);
    public function getTotalActiveSalesPipelineStage();
}
