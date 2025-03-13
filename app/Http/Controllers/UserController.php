<?php

namespace App\Http\Controllers;

use App\Services\UserService\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $userService;
    public function __construct(UserService $userService){
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.modal.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'user_name' => 'required|max:255',
                //'email' => 'required|email|max:255|unique:users,email',
                'email' => ['required','email','max:255',Rule::unique('users')->where(function ($query)  {
                    return $query->where('status', 1);
                })],
                'password' => 'required|min:8|max:20',
                'roles' => 'required'
            ];
            $messages = [
                'user_name.required'=> 'User name is required.',
                'user_name.max' => 'User name must not exceed than 255 characters.',
                'email.required'=> 'E-mail is required.',
                'email.email'=> 'Please enter valid e-mail.',
                'email.max'=> 'E-mail must not exceed than 255 characters.',
                'password.required' => 'Password is required.',
                'password.min'=> 'Password must be minimum of 8 characters.',
                'password.max' => 'Password must not exceed more than 20 characters.',
                'roles.required'=> 'Role is required.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }
            $data = [
                'name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ];

            $user = $this->userService->addUser($data);

            // Redirect based on the result
            if ($user) {
                // All current roles will be removed from the user and replaced by the array given

                $user->syncRoles($request->roles);
                if (is_array($user) && $user['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $user['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'User created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in user creation.',
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
    public function edit(string $id)
    {
        try {
            $roles = Role::pluck('name','name')->all();
            $user = $this->userService->findUserById($id);
            $userRole = $user->roles->pluck('name','name')->all();

            return view('users.modal.edit', compact('user', 'roles', 'userRole'));
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $rules = [
                'user_name' => 'required|max:255',
                //'email' => 'required|email|max:255',
                'email' => ['required','email','max:255',Rule::unique('users')->where(function ($query) use($id) {
                    return $query->where('status',1)->where('id','!=',$id);
                })],
                'password' => 'nullable|min:8|max:20',
                'roles' => 'required'
            ];

            $messages = [
                'user_name.required' => 'User name is required.',
                'user_name.max' => 'User name must not be exceed more than 255 characters.',
                'email.required' => 'E-mail is required.',
                'email.email' => 'Please enter valid e-mail.',
                'email.max' => 'E-mail must not be exceed more than 255 characters.',
                'password.min' => 'Password must be minimum of 8 characters.',
                'password.max' => 'Password must be maximum of 20 characters.',
                'roles.required' => 'Role is required.',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $data = [
                'name' => $request->user_name,
                'email' => $request->email,
                'status' => '1'
            ];

            if (!is_null($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            $user = $this->userService->updateUser($data, $id);
            // lets find user
            $user = $this->userService->findUserById($id);
            // Redirect based on the result
            if ($user) {

                // All current roles will be removed from the user and replaced by the array given
                $user->syncRoles($request->roles);
                if (is_array($user) && $user['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $user['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'User updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating user.',
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
        $this->userService->deleteUser($id);
        return response()->json([
            'status' => 'success',
            'message' => 'User has been deleted successfully!',
        ], 200);
    }
}
