<?php

namespace App\Http\Controllers;

use App\Student;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentController extends Controller
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

    /**s
     * Return a list of Student
     *
     * @return Illuminate\Http\Response
     */
    public function index(){
        $students = Student::all();
        return  $this->successResponse($students);
    }
    /**
     * Obtain and show one new Student
     *
     * @return Illuminate\Http\Response
     */

    public  function show($id){
        $student= Student::findorfail($id);
        return  $this->successResponse($student);

    }
    /**
     * create one new Student
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request){
        $rules=[
            'name'=> 'required|max:255',
        ];

        $this->validate($request,$rules);
        $student = Student::create($request->all());
        
        return  $this->successResponse($student, Response::HTTP_CREATED);

    }
    /**
     * create on existing Student
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request,$id){
        $rules = [
            'name'=> 'max:255',
        ];


        $this->validate($request, $rules);
        $name = Student::findOrFail($id);
        $name->fill($request->all());

        if($name->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $name->save();
        return $this->successResponse($id);

    }

    /**
     * Delete an existing Student
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id){
        $student=Student::findorfail($id);
        $student->delete();
        return  $this->successResponse($id);

    }
}