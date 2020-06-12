<?php

namespace App\Http\Controllers;

use App\Subject;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
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
     * Return a list of Subject
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $subjects = Subject::all();
        return  $this->successResponse($subjects);
    }
    /**
     * Obtain and show one new Subject
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){
        $subject= Subject::findorfail($id);
        return  $this->successResponse($subject);

    }
    /**
     * create on new Subject
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'title' => 'max:255',

        ];
        $this->validate($request,$rules);
        $subject = Subject::create($request->all());
        return  $this->successResponse($subject, Response::HTTP_CREATED);
    }
    /**
     * create on existing Subject
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'title'=> 'max:255',
        ];

        $this->validate($request, $rules);
        $subject = Subject::findOrFail($id);
        $subject->fill($request->all());

        if($subject->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $subject->save();
        return $this->successResponse($id);


    }

    /**
     * Delete an existing Subject
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $subject=Subject::findorfail($id);
        $subject->delete();
        return  $this->successResponse($id);
    }
}