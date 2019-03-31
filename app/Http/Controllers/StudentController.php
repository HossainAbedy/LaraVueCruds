<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Student;
use Session;
use DB;
use Carbon\Carbon;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Student::orderBy('id', 'desc')->paginate($request->perPage);
         }
         return view('student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'roll'  => 'required|numeric',
            'section' => 'required',
            'class' => 'required',
            'dept' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric',
        ], [
            'fname.required' => 'The First Name field is required.',
            'lname.required' => 'The Last Name field is required.',
            'roll.required' => 'The Roll field is required.',
            'section.required' => 'The Section field is required.',
            'class.required' => 'The Class field is required.',
            'dept.required' => 'The Depertment field is required.',
            'email.required' => 'The Email field is required.',
            'mobile.required' => 'The Mobile field is required.',
        ]);

    // try {
        DB::beginTransaction();

    $data = [
        'fname'  => $request->fname,
        'lname'  => $request->lname,
        'roll'   => $request->roll,
        'section'=> $request->section,
        'class'  => $request->class,
        'dept'   => $request->dept,
        'email'  => $request->email,
        'mobile' => $request->mobile,
    ];


           Student::create($data);

           DB::commit();
           return response()->json(['status' => 'success', 'message' => 'Save Student info']);
        //  } catch (\Exception $e) {
           DB::rollback();
           return response()->json(['status' => 'error', 'message' => 'Something Error Found !, Please try again']);
        //  }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Student::FindOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Student::FindOrFail($id);
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
            'fname' => 'required',
            'lname' => 'required',
            'roll'  => 'required',
            'section' => 'required',
            'class' => 'required',
            'dept' => 'required',
            'email' => 'required',
            'mobile' => 'required|numeric',
        ], [
            'fname.required' => 'The First Name field is required.',
            'lname.required' => 'The Last Name field is required.',
            'roll.required' => 'The Roll field is required.',
            'section.required' => 'The Section field is required.',
            'class.required' => 'The Class field is required.',
            'dept.required' => 'The Depertment field is required.',
            'email.required' => 'The Email field is required.',
            'mobile.required' => 'The Mobile field is required.',
        ]);
    try {
        DB::beginTransaction();
   
        $data = [
            'fname'  => $request->fname,
            'lname'  => $request->lname,
            'roll'   => $request->roll,
            'section'=> $request->section,
            'class'  => $request->class,
            'dept'   => $request->dept,
            'email'  => $request->email,
            'mobile' => $request->mobile,
        ];
    Student::FindOrFail($id)->update($data);
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
            Student::where('id', $id)->delete(); 
            DB::commit();
            return response()->json(['status'=>'success','message'=>'Student Info successfully deleted !']);
        }
        catch(\Exception $e){
            DB::rollback();
            return response()->json(['status'=>'error','message'=>'Something Error Found !, Please try again']);
        }
    }
}
