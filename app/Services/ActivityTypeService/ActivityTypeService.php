<?php
namespace App\Services\ActivityTypeService;
interface ActivityTypeService{
    public function getAllActivityTypes();
    public function addActivityType($data);
    public function getActivityTypeById($id);
    public function updateActivityType($data, $id);
    public function deleteActivityType($id);
    public function getTotalActiveActivityTypes();
}
