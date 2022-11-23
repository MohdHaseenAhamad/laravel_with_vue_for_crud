<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employees;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::all();
        return response()->json($employees);
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
        $obj = new Employees();

        $obj->name=$request->input('name');
        $obj->address=$request->input('address');
        $obj->mobile=$request->input('mobile');
        if($obj->save())
        {
            return response()->json(['success'=>true,'msg'=>"Successfully Insert Data"]);
        }
        else
        {
            return response()->json(['success'=>false,'msg'=>"error...."]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee=Employees::find($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
        $employee = Employees::find($id);
        if($employee->update($request->all()))
        {
            return response()->json(['success'=>true,'msg'=>"Successfully Update Data"]);
        }
        else
        {
            return response()->json(['success'=>false,'msg'=>"error...."]);
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
       $employee = Employees::find($id);
       if($employee->delete($id))
       {
           return response()->json(['success'=>true,'msg'=>"Successfully Delete Data"]);
       }
       else
       {
           return response()->json(['success'=>false,'msg'=>"error...."]);
       }
    }
}
