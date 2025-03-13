<?php

namespace App\Http\Controllers;

use App\Services\RoleService\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $roleService;
    public function __construct(RoleService $roleService){
        $this->roleService = $roleService;
    }
    public function index()
    {
        $roles = $this->roleService->getAllRoles();
        return view('roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.modal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'role_name'=>'required',
            ];
            $messages = [
                'role_name.required'=> 'Please enter role name.',
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
            $validatedData = [
                'name'=> $request->role_name,
            ];

            //attempt to add the role
            $data = $this->roleService->addRole($validatedData);

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
                    'message' => 'Role created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in role creation.'
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
        $role = $this->roleService->findRoleById($id);
        return view('roles.modal.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'role_name'=>'required'
            ];
            $messages = [
                'role_name.required'=>'Please enter role name.',
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
            $validatedData = [
                'name'=> slugify($request->role_name),
            ];

            // attempt to update role
            $data = $this->roleService->updateRole($validatedData, $id);
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
                    'message' => 'Role updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error in updating role.',
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
        $this->roleService->deleteRole($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Role has been deleted successfully!'
        ], 200);
    }
}
