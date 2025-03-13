<?php
namespace App\Services\TicketStatusService;
use App\Models\TicketStatus;

class TicketStatusServiceImpl implements TicketStatusService{
    private $ticketStatus;
    public function __construct(){
        $this->ticketStatus = new TicketStatus();
    }
    public function getAllTicketStatuses()
    {
        return $this->ticketStatus->getAllTicketStatuses();
    }

    public function addTicketStatus($data)
    {
        return $this->ticketStatus->addTicketStatus($data);
    }

    public function getTicketStatusById($id)
    {
        return $this->ticketStatus->getTicketStatusById($id);
    }

    public function updateTicketStatus($data, $id)
    {
        return $this->ticketStatus->updateTicketStatus($data, $id);
    }

    public function deleteTicketStatus($id)
    {
        return $this->ticketStatus->deleteTicketStatus($id);
    }

    public function getTotalActiveTicketStatus()
    {
        return $this->ticketStatus->getTotalActiveTicketStatus();
    }
}
