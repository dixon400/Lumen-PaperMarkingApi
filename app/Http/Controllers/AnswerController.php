<?php

namespace App\Http\Controllers;

use App\Paper;
use App\Answer;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnswerController extends Controller
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
     * Return a list of Answer
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $answers = Answer::all();
        return  $this->successResponse($answers);
    }
    /**
     * Obtain and show one new Answer
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){
        $answer= Answer::findorfail($id);
        return  $this->successResponse($answer);


    }
    /**
     * create on new Answer
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'answer'=> 'required|min:1',
            'subject_id'=> 'required|min:1',
            'paper_id' => 'required|min:1'

        ];
        $this->validate($request,$rules);
        $answer = Answer::create($request->all());
        return  $this->successResponse($answer, Response::HTTP_CREATED);


    }
    /**
     * create on existing Answer
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'question'=> 'max:100',
            'answers'=> 'max:30',
            'subject_id'=> 'min:1',
        ];

        $this->validate($request, $rules);
        $status = Status::findOrFail($id);
        $status->fill($request->all());

        if($status->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $status->save();
        return $this->successResponse($id);

    } /**
    * Delete an existing Question
    *
    * @return Illuminate\Http\Response
    */
   public function delete($id){
       $answer=Answer::findorfail($id);
       $answer->delete();
       return  $this->successResponse($id);

   }
}

