<?php

namespace App\Http\Controllers;

use App\Services\ActivityTypeService\ActivityTypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ActivityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $activityTypeService;
    public function __construct(ActivityTypeService $activityTypeService)
    {
        $this->activityTypeService = $activityTypeService;
    }
    public function index()
    {
        $activityTypes = $this->activityTypeService->getAllActivityTypes();
        return view('activity_type.index',compact('activityTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity_type.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'activity_type_name'=> 'required',
            ];

            $messages = [
                'activity_type_name.required'=> 'Please enter activity type.',
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

            // Validated data
            $validatedData = $validator->validated();

            //attempt to add the lead activity type
            $data = $this->activityTypeService->addActivityType($validatedData);

            // Redirect based on the result
            if ($data) {
                if (is_array($data) && $data['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $data['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Activity Type created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in activity type creation.'
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
        $activityType = $this->activityTypeService->getActivityTypeById($id);
        return view('activity_type.modal.edit',compact('activityType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'activity_type_name'=>'required'
            ];
            $messages = [
                'activity_type_name.required'=>'Please enter activity type.',
            ];
            $validator = Validator::make($request->all(),$rules, $messages);
            if($validator->fails())
            {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => $messages,
                    'errors' => $validator->errors(),
                    'old' => $request->all()
                ], 422);
            }

            // Validated data
            $validatedData = $validator->validated();

            // attempt to update activity type
            $data = $this->activityTypeService->updateActivityType($validatedData, $id);
            // Redirect based on the result
            if ($data) {
                if (is_array($data) && $data['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $data['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Activity Type updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating activity type.',
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
        $this->activityTypeService->deleteActivityType($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Activity Type has been deleted successfully!'
        ], 200);
    }
}
