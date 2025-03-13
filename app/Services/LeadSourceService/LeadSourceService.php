<?php
namespace App\Services\LeadSourceService;
interface LeadSourceService{
    public function getAllLeadSources();
    public function addLeadSource($data);
    public function getLeadSourceById($id);
    public function updateLeadSource($data, $id);
    public function deleteLeadSource($id);
    public function getTotalActiveLeadSources();
}
