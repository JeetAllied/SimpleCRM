<?php
namespace App\Services\ActivityService;
use App\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class ActivityServiceImpl implements ActivityService
{
    private $activity;
    public function __construct(){
        $this->activity = new Activity();
    }
    public function getAllActivities()
    {
        $user = auth()->user();
        $resultData = $this->activity->getAllActivities();

        return DataTables::of($resultData)
            ->addColumn('action', function ($result) use($user) {

                $html = '';
                /*if($user->can('manage_service_order'))
                {
                    $html .= '<a href="'.route('service-orders.show',$result->id).'" class="btn btn-primary mb-1" title="View Service Order"><i class="bi bi-eye"></i> </a>';
                }
                if($user->can('update_service_order'))
                {*/
                if($result->status == 1){
                    $html .= '<button type="button" data-remote="'.route('activities.edit',$result->id).'" class="btn btn-sm btn-warning" title="Edit Activity" data-request="ajaxModal" data-reload="true"><i class="fas fa-pen"></i> </button>';
                }
                /*}
                if($user->can('delete_service_order'))
                {*/
                if($result->status == 1) {
                    $html .= '<a href="javascript:void(0)" class="btn btn-sm btn-danger delete-data ml-2" data-url="' . route('activities.destroy', $result->id) . '" id="' . $result->id . '" title="Delete Activity"><i class="fas fa-trash"></i></a>';
                }
                //}

                return $html;
            })
            ->editColumn('created_at', function ($result) {
                return $result->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($result) {
                return $result->updated_at->format('Y-m-d H:i:s');
            })
            ->editColumn('status', function ($result) {
                $statusText = "";
                if($result->status == 1)
                {
                    $statusText = '<span class="badge rounded-pill bg-primary text-light">Active</span>';
                }
                else
                {
                    $statusText = '<span class="badge rounded-pill bg-warning text-dark">In-Active</span>';
                }
                return $statusText;
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('status', $keyword);
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }

    public function addActivity($data)
    {
        return $this->activity->addActivity($data);
    }

    public function getActivityById($id)
    {
        return $this->activity->getActivityById($id);
    }

    public function updateActivity($data, $id)
    {
        return $this->activity->updateActivity($data, $id);
    }

    public function deleteActivity($id)
    {
        return $this->activity->deleteActivity($id);
    }

    public function getTotalActiveActivities()
    {
        return $this->activity->getTotalActiveActivities();
    }
}
