<?php
namespace App\Services\LeadSourceService;
use App\Models\LeadSource;

class LeadSourceServiceImpl implements LeadSourceService{

    private $leadSource;
    public function __construct()
    {
        $this->leadSource = new LeadSource();
    }
    public function getAllLeadSources()
    {
        return $this->leadSource->getAllLeadSources();
    }

    public function addLeadSource($data)
    {
        return $this->leadSource->addLeadSource($data);
    }

    public function getLeadSourceById($id)
    {
        return $this->leadSource->getLeadSourceById($id);
    }

    public function updateLeadSource($data, $id)
    {
        return $this->leadSource->updateLeadSource($data, $id);
    }

    public function deleteLeadSource($id)
    {
        return $this->leadSource->deleteLeadSource($id);
    }

    public function getTotalActiveLeadSources()
    {
        return $this->leadSource->getTotalActiveLeadSources();
    }
}
