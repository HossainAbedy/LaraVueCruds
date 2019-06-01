<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Employee;
use App\Mail\Welcome;
use App\Events\EmployeeEvent;
use Session;
use DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
           return Employee::orderBy('id', 'desc')->paginate($request->perPage);
        }
        return view('employee');
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
                'fname' => 'required',
                'lname' => 'required',
                'email' => 'required',
                'mobile' => 'required|numeric',
            ], [
                'fname.required' => 'The First Name field is required.',
                'lname.required' => 'The Last Name field is required.',
                'email.required' => 'The Email field is required.',
                'mobile.required' => 'The Mobile field is required.',
            ]);

        // try {
        DB::beginTransaction();

        // $data = [
        //     'fname' => $request->fname,
        //     'lname' => $request->lname,
        //     'email' => $request->email,
        //     'mobile' => $request->mobile,
        // ];
        $employee=Employee::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            ]);
        DB::commit();  
            event(new EmployeeEvent($employee));
            return response()->json(['status' => 'success', 'message' => 'Save Employee info']);
                  
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return response()->json(['status' => 'error', 'message' => 'Something Error Found !, Please try again']);
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        return Employee::FindOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Employee::FindOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'fname'  => 'required',
            'lname'  => 'required',
            'email'  => 'required',
            'mobile' => 'required|numeric',
        ], [
            'fname.required' => 'The Name field is required.',
            'lname.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'mobile.required' => 'The Mobile field is required.',
        ]);
    try {
        DB::beginTransaction();
   
    $data = [
        'fname' =>  $request->fname,
        'lname' =>  $request->lname,
        'email' =>  $request->email,
        'mobile' => $request->mobile,
      
    ];
    Employee::FindOrFail($id)->update($data);
    DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Update student info']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status' => 'error', 'message' => 'Something Error Found !, Please try again']);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::beginTransaction();
            Employee::where('id', $id)->delete(); 
            DB::commit();
            return response()->json(['status'=>'success','message'=>'Employee Info successfully deleted !']);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>'error','message'=>'Something Error Found !, Please try again']);
        }
    }
}
