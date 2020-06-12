<?php

namespace App\Http\Controllers;

use App\PaperType;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaperTypeController extends Controller
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
     * Return a list of paperType
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $papertype = PaperType::all();
        return  $this->successResponse($papertype);    }
    /**
     * Obtain and show one new paperType
     *
     * @return Illuminate\Http\Response
     */

    public function show($id){
            $papertype= PaperType::findorfail($id);
            return  $this->successResponse($papertype);
    }
    /**
     * create on new paperType
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'name'=> 'required|max:30',

        ];
        $this->validate($request,$rules);
        $papertype = PaperType::create($request->all());
        return  $this->successResponse($papertype, Response::HTTP_CREATED);


    }
    /**
     * create on existing paperType
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'name'=> 'required|max:30',
        ];

        $this->validate($request, $rules);
        $papertype = PaperType::findOrFail($id);
        $papertype->fill($request->all());

        if($papertype->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $papertype->save();
        return $this->successResponse($id);
    }

    /**
     * Delete an existing paperType
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $papertype=PaperType::findorfail($id);
        $papertype->delete();
        return  $this->successResponse($id);

    }
}