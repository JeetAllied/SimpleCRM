<?php
namespace App\Services\LeadStatusService;
interface LeadStatusService
{
    public function getAllLeadStatuses();
    public function addLeadStatus($data);
    public function getLeadStatusById($id);
    public function updateLeadStatus($data, $id);
    public function deleteLeadStatus($id);
    public function getTotalActiveLeadStatuses();
}
