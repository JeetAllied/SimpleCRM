<?php
namespace App\Services\LeadService;
interface LeadService{
    public function getAllLeads();
    public function addLead($data);
    public function getLeadById($id);
    public function updateLead($data, $id);
    public function deleteLead($id);
    public function getTotalActiveLeads();
    public function getAllLeadsData();
}
