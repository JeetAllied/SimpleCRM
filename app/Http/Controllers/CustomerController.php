<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CustomerService\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $customerService;
    public function __construct(CustomerService $customerService){
        $this->customerService = $customerService;
    }
    public function index()
    {
        /*$customers = $this->customerService->getAllCustomers();
        return view('customer.index',compact('customers'));*/
        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('customer.modal.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'customer_name' => 'required|max:100',
                'email' => ['required','email','max:100',Rule::unique('customers')->where(function ($query)  {
                    return $query->where('status', 1);
                })],
                'phone' => 'required|min:10|max:20',
                'company_name'=>'nullable',
                'industry'=>'nullable',
                'address' => 'nullable',
                'assigned_to'=>'required',
            ];
            $messages = [
                'customer_name.required'=> 'Customer name is required.',
                'customer_name.max' => 'Customer name must not exceed than 100 characters.',
                'email.required'=> 'E-mail is required.',
                'email.email'=> 'Please enter valid e-mail.',
                'email.max'=> 'E-mail must not exceed than 100 characters.',
                'phone.required' => 'Contact number is required.',
                'phone.min'=> 'Contact number must be minimum of 10 characters.',
                'phone.max' => 'Contact number must not exceed more than 20 characters.',
                'assigned_to.required'=> 'Please select user to assign to customer.',
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
                'name' => $request->customer_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company_name' => $request->company_name,
                'industry' => $request->industry,
                'address' => $request->address,
                'assigned_to' => (int)$request->assigned_to,
            ];
            //dd($data);
            $customer = $this->customerService->addCustomer($data);

            // Redirect based on the result
            if ($customer) {
                if (is_array($customer) && $customer['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $customer['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Customer created successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in customer creation.',
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
        $users = User::all();
        $customer = $this->customerService->getCustomerById($id);
        return view('customer.modal.edit',compact('customer','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

            $rules = [
                'customer_name' => 'required|max:100',
                'email' => ['required','email','max:100',Rule::unique('customers')->where(function ($query) use($id) {
                    return $query->where('status',1)->where('id','!=',$id);
                })],
                'phone' => 'required|min:10|max:20',
                'company_name'=>'nullable',
                'industry'=>'nullable',
                'address' => 'nullable',
                'assigned_to'=>'required'
            ];

            $messages = [
                'customer_name.required' => 'Customer name is required.',
                'customer_name.max' => 'Customer name must not be exceed more than 100 characters.',
                'email.required' => 'E-mail is required.',
                'email.email' => 'Please enter valid e-mail.',
                'email.max' => 'E-mail must not be exceed more than 100 characters.',
                'phone.required' => 'Contact number is required.',
                'phone.min' => 'Contact number must be minimum of 10 characters.',
                'phone.max' => 'Contact number must be maximum of 20 characters.',
                'assigned_to.required' => 'Please select user to assign to customer.',
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
                'name' => $request->customer_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company_name' => $request->company_name,
                'industry' => $request->industry,
                'address' => $request->address,
                'assigned_to' => (int)$request->assigned_to,
            ];


            $customer = $this->customerService->updateCustomer($data, $id);

            // Redirect based on the result
            if ($customer) {
                if (is_array($customer) && $customer['status'] == 0) {
                    return response()->json([
                        'alertClass' => 'error',
                        'message' => $customer['message']
                    ]);
                }
                return response()->json([
                    'alertClass' => 'success',
                    'message' => 'Customer updated successfully.'
                ]);
            } else {
                return response()->json([
                    'alertClass' => 'error',
                    'message' => 'Error occurred in updating customer.',
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
        $this->customerService->deleteCustomer($id);
        return response()->json([
            'status' => 'success',
            'message' => 'Customer has been deleted successfully!',
        ], 200);
    }

    public function getAllCustomers()
    {
        try{
            return $this->customerService->getAllCustomers();
        }
        catch(\Exception $e)
        {

        }
    }
}
