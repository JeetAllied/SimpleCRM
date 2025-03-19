<?php
namespace App\Services\SalesPipelineService;
interface SalesPipelineService{
    public function getAllSalesPipelines();
    public function addSalesPipeline($data);
    public function getSalesPipelineById($id);
    public function updateSalesPipeline($data, $id);
    public function deleteSalesPipeline($id);
    public function getTotalActiveSalesPipelines();
}
