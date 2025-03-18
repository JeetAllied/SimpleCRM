<?php
namespace App\Services\OpportunityService;
interface OpportunityService
{
    public function getAllOpportunities();
    public function addOpportunity($data);
    public function getOpportunityById($id);
    public function updateOpportunity($data, $id);
    public function deleteOpportunity($id);
    public function getTotalActiveOpportunities();
}
