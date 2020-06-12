<?php

namespace App\Http\Controllers;

use App\Paper;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaperController extends Controller
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
     * Return a list of papers
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $papers = Paper::all();
        return  $this->successResponse($papers);

    }
    /**
     * Obtain and show one new paper
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){

        $paper= Paper::findorfail($id);
        return  $this->successResponse($paper);

    }

    /**
     * create a new paper
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'subject_id'=> 'required|min:1',
            'paper_type_id'=> 'required|min:1',

        ];
        $this->validate($request,$rules);
        $paper = Paper::create($request->all());
        return  $this->successResponse($paper, Response::HTTP_CREATED);
    }

    /**
     * edit on existing paper
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'subject_id'=> 'required|min:1',
            'paper_type_id'=> 'required|min:1',
        ];

        $this->validate($request, $rules);
        $paper = Paper::findOrFail($id);
        $paper->fill($request->all());

        if($paper->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $paper->save();

        return $this->successResponse($id);

    }

    /**
     * Delete an existing paper
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $paper= Paper::findorfail($id);
        $paper->delete();
        return $this->successResponse($id);

    }
}