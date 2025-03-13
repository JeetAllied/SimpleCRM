<?php
namespace App\Services\LeadStatusService;
use App\Models\LeadStatus;

class LeadStatusServiceImpl implements LeadStatusService{
    private $leadStatus;
    public function __construct()
    {
        $this->leadStatus = new LeadStatus();
    }
    public function getAllLeadStatuses()
    {
        return $this->leadStatus->getAllLeadStatuses();
    }

    public function addLeadStatus($data)
    {
        return $this->leadStatus->addLeadStatus($data);
    }

    public function getLeadStatusById($id)
    {
        return $this->leadStatus->getLeadStatusById($id);
    }

    public function updateLeadStatus($data, $id)
    {
        return $this->leadStatus->updateLeadStatus($data, $id);
    }

    public function deleteLeadStatus($id)
    {
        return $this->leadStatus->deleteLeadStatus($id);
    }

    public function getTotalActiveLeadStatuses()
    {
        return $this->leadStatus->getTotalActiveLeadStatuses();
    }
}
