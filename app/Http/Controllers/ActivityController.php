<?php

namespace App\Http\Controllers;

use App\Services\ActivityService\ActivityService;
use App\Services\ActivityTypeService\ActivityTypeService;
use App\Services\UserService\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $activityService, $userService, $activityTypeService;
    public function __construct(ActivityService $activityService,UserService $userService, ActivityTypeService $activityTypeService)
    {
        $this->activityService = $activityService;
        $this->userService = $userService;
        $this->activityTypeService = $activityTypeService;
    }
    public function index()
    {
        return view('activity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userService->getAllUsers();
        $activityTypes = $this->activityTypeService->getAllActivityTypes();
        return view('activity.modal.create',compact('users','activityTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'activity_name'=>'required',
                'user_id' => 'required',
                'activity_type_id' => 'required',
                'activity_detail' => 'required',
            ];
            $messages = [
                'activity_name.required'=>'Please enter activity name.',
                'user_id.required'=> 'Please select user.',
                'activity_type_id.required'=> 'Please select activity type.',
                'activity_detail.required'=>'Please enter activity detail.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => $messages,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ], 422);
            }
            $data = [
                'activity_name'=>$request->activity_name,
                'user_id' => $request->user_id,
                'activity_type_id' => $request->activity_type_id,
                'activity_detail' => $request->activity_detail,
            ];

            $activity = $this->activityService->addActivity($data);

            // Redirect based on the result
            if ($activity) {
                if (is_array($activity) && $activity['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $activity['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Activity created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in activity creation.',
                ]);
            }

        }
        catch(\Exception $e)
        {
            return response()->json([
                'alertClass' => 'error',
                'message' => 'An error occurred. Try Again!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $users = $this->userService->getAllUsers();
        $activityTypes = $this->activityTypeService->getAllActivityTypes();
        $activity = $this->activityService->getActivityById($id);
        return view('activity.modal.edit',compact('users','activityTypes','activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $rules = [
                'activity_name'=>'required',
                'user_id' => 'required',
                'activity_type_id' => 'required',
                'activity_detail' => 'required',
            ];

            $messages = [
                'activity_name.required'=>'Please enter activity name.',
                'user_id.required'=> 'Please select user.',
                'activity_type_id.required'=> 'Please select activity type.',
                'activity_detail.required'=>'Please enter activity detail.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => $messages,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ], 422);
            }

            $data = [
                'activity_name'=>$request->activity_name,
                'user_id' => $request->user_id,
                'activity_type_id' => $request->activity_type_id,
                'activity_detail' => $request->activity_detail,
            ];

            $activity = $this->activityService->updateActivity($data, $id);

            // Redirect based on the result
            if ($activity) {
                if (is_array($activity) && $activity['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $activity['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Activity updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating activity.',
                ]);
            }
        }
        catch(\Exception $e)
        {
            return response()->json([
                'alertClass' => 'error',
                'message' => 'An error occurred. Try Again!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->activityService->deleteActivity($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Activity has been deleted successfully!',
        ], 200);
    }

    public function getAllActivities()
    {
        try{
            return $this->activityService->getAllActivities();
        }
        catch(\Exception $e)
        {

        }
    }
}
