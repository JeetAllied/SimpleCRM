<?php
namespace App\Services\OpportunityStageService;
interface OpportunityStageService{
    public function getAllOpportunityStages();
    public function addOpportunityStage($data);
    public function getOpportunityStageById($id);
    public function updateOpportunityStage($data, $id);
    public function deleteOpportunityStage($id);
    public function getTotalActiveOpportunityStages();
}
