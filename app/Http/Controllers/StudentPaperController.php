<?php

namespace App\Http\Controllers;

use App\Paper;
use App\Student;
use App\StudentPaper;
use App\Answer;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentPaperController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public $answer;
    public $papertype;
    public $markingGuide;

    public function __construct(AnswerController $answer, PaperTypeController $papertype)
    {
        $this->papertype = $papertype;
        $this->answer = $answer;
    }

    /**
     * Return a list of studentPaper
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $studentPapers = StudentPaper::all();
        return $this->successResponse($studentPapers);

    }

    /**
     * Obtain and show one studentPaper
     *
     * @return Illuminate\Http\Response
     */

    public function show($id)
    {
        $studentPaper = StudentPaper::findorfail($id);
        return $this->successResponse($studentPaper);

    }

    /**
     * create a new studentPaper
     *
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'student_id' => 'required|min:1',
            'paper_id' => 'required|min:1',
            'status_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);
        $studentPaper = StudentPaper::create($request->all());

       // $answer = Answer::findorfail($studentPaper['answer_id']);
       // $papertype = PaperType::findorfail($studentPaper['papertype_id']);
        

        return $this->successResponse($studentPaper, Response::HTTP_CREATED);
    }

    /**
     * edit an existing studentPaper
     *
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'student_id' => 'min:1',
            'subject_id' => 'min:1',
            'paper_id' => 'min:1',
            'status_id' => 'min:1',
        ];

        $this->validate($request, $rules);
        $studentPaper = StudentPaper::findOrFail($id);
        $studentPaper->fill($request->all());

        if ($studentPaper->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $studentPaper->save();

        return $this->successResponse($id);

    }

    /**
     * Delete an existing studentPaper
     *
     * @return Illuminate\Http\Response
     */
    public function delete($id)
    {
        $studentPaper = StudentPaper::findorfail($id);
        $studentPaper->delete();
        return $this->successResponse($id);

    }

    /**
     * Marking a student paper
     *
     * @return Illuminate\Http\Response
     */

    public function markScript()
    {

    }

}
