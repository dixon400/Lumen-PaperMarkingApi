<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Paper;
use App\Student;
use App\StudentPaper;
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

    public $studentscript;

    public function __construct()
    {

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

    public function setpaper($script)
    {

    }

    /**
     * Marking a student paper
     *
     * @return Illuminate\Http\Response
     */
    public function markScript($studentid, $id)
    {
        /**
         * Get student's input
         * Convert to answers by eliminating digit
         * convert to an array
         */
        $paper = Paper::findorfail($id);
        $studentpaper = Answer::findorfail($paper['id']);
        $studentscript = $studentpaper['answer'];
        $studentscript = preg_replace('/[\d,]+/', '', $studentscript);
        $studentscript = explode(';', $studentscript);
        $studentid = Student::findorfail($studentid);
        $studentresult = StudentPaper::findorfail($studentid['id']);
        $studentid = $studentresult['student_id'];

        /**
         * Get corresponding marking guide
         * convert to an array
         */

        $guide = Paper::findorfail(!($paper['paper_type']));
        $markingguide = Answer::findorfail($guide['id']);
        $markingguide = ($markingguide['answer']);
        $markingguide = preg_replace('/[\d,]+/', '', $markingguide);
        $markingguide = explode(';', $markingguide);

        /**
         * Compare both
         * output result
         */
        $correct = 0;
        for ($i = 0; $i < count($studentscript); $i++) {

            if ($studentscript[$i] == $markingguide[$i]) {

                $correct++;
            }
            $output = array($correct, count(($markingguide)));

        }

        $percentage = (($correct / count($markingguide)) * 100);

        $studentscore = $correct;

        $studentresult['score'] = $studentscore;
        $studentresult['percentage'] = $percentage;
        $studentresult->save();

        return $studentresult;

    }

}
