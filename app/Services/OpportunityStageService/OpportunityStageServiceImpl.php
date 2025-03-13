<?php
namespace App\Services\OpportunityStageService;
use App\Models\OpportunityStage;

class OpportunityStageServiceImpl implements OpportunityStageService{
    private $opportunityStage;
    public function __construct(){
        $this->opportunityStage = new OpportunityStage();
    }
    public function getAllOpportunityStages()
    {
        return $this->opportunityStage->getAllOpportunityStages();
    }

    public function addOpportunityStage($data)
    {
        return $this->opportunityStage->addOpportunityStage($data);
    }

    public function getOpportunityStageById($id)
    {
        return $this->opportunityStage->getOpportunityStageById($id);
    }

    public function updateOpportunityStage($data, $id)
    {
        return $this->opportunityStage->updateOpportunityStage($data, $id);
    }

    public function deleteOpportunityStage($id)
    {
        return $this->opportunityStage->deleteOpportunityStage($id);
    }

    public function getTotalActiveOpportunityStages()
    {
        return $this->opportunityStage->getTotalActiveOpportunityStages();
    }
}
