<?php
namespace App\Services\CustomerService;
interface CustomerService{
    public function getAllCustomers();
    public function addCustomer($data);
    public function getCustomerById($id);
    public function updateCustomer($data, $id);
    public function deleteCustomer($id);
    public function getTotalActiveCustomers();
    public function getAllCustomersData();
}
