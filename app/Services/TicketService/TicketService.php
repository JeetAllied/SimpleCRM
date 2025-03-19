<?php
namespace App\Services\TicketService;
interface TicketService
{
    public function getAllTickets();
    public function addTicket($data);
    public function getTicketById($id);
    public function updateTicket($data, $id);
    public function deleteTicket($id);
    public function getTotalActiveTickets();
}
