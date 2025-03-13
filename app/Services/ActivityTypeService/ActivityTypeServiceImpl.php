<?php
namespace App\Services\ActivityTypeService;
use App\Models\ActivityType;

class ActivityTypeServiceImpl implements ActivityTypeService
{
    private $activityType;
    public function __construct()
    {
        $this->activityType = new ActivityType();
    }
    public function getAllActivityTypes()
    {
        return $this->activityType->getAllActivityTypes();
    }
    public function addActivityType($data)
    {
        return $this->activityType->addActivityType($data);
    }
    public function getActivityTypeById($id)
    {
        return $this->activityType->getActivityTypeById($id);
    }
    public function updateActivityType($data, $id)
    {
        return $this->activityType->updateActivityType($data, $id);
    }
    public function deleteActivityType($id)
    {
        return $this->deleteActivityType($id);
    }
    public function getTotalActiveActivityTypes()
    {
        return $this->getTotalActiveActivityTypes();
    }
}
