<?php

namespace App\Http\Controllers;

use App\Status;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StatusController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return a list of status
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $status = Status::all();
        return  $this->successResponse($status);    }
    /**
     * Obtain and show one new status
     *
     * @return Illuminate\Http\Response
     */

    public function show($id){
            $status= Status::findorfail($id);
            return  $this->successResponse($status);
    }
    /**
     * create on new status
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'name'=> 'required|max:30',

        ];
        $this->validate($request,$rules);
        $status = Status::create($request->all());
        return  $this->successResponse($status, Response::HTTP_CREATED);


    }
    /**
     * create on existing status
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'name'=> 'required|max:30',
        ];

        $this->validate($request, $rules);
        $status = Status::findOrFail($id);
        $status->fill($request->all());

        if($status->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $status->save();
        return $this->successResponse($id);
    }

    /**
     * Delete an existing status
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $status=Status::findorfail($id);
        $status->delete();
        return  $this->successResponse($id);

    }
}