<?php
namespace App\Services\ActivityService;
interface ActivityService
{
    public function getAllActivities();
    public function addActivity($data);
    public function getActivityById($id);
    public function updateActivity($data, $id);
    public function deleteActivity($id);
    public function getTotalActiveActivities();
}
