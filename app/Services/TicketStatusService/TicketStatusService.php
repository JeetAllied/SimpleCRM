<?php
namespace App\Services\TicketStatusService;
interface TicketStatusService{
    public function getAllTicketStatuses();
    public function addTicketStatus($data);
    public function getTicketStatusById($id);
    public function updateTicketStatus($data, $id);
    public function deleteTicketStatus($id);
    public function getTotalActiveTicketStatus();
}
