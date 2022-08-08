<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use Livewire\Component;
use App\Models\Question;

class ShowQuestion extends Component
{
    public $quizze_id, $student_id, $data, $counter = 0, $question_count = 0 ;

    
    public function render()
    {

        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->question_count = $this->data->count();
        return view('livewire.show-question', ['data']);
    }
    
    public function nextQuestion($question_id, $score, $answer, $right_answer)
    {

        $student_degree = Degree::where('quizze_id', $this->quizze_id)
                                ->where('student_id', $this->student_id)
                                ->first();
        
        if ($student_degree == null) {
            $degree= new Degree();

                $degree->quizze_id = $this->quizze_id;
                $degree->student_id = $this->student_id;
                $degree->question_id = $question_id;
               
                if (strcmp(trim($answer), trim($right_answer)) === 0 ) {
                    $degree->score += $score ;
                } else {
                    $degree->score += 0 ;
                }
                $degree->date = date('Y-m-d');
                $degree->save();

        } else {

            if ($student_degree->question_id >= $this->data[$this->counter]->id ) {
                $student_degree->score = 0 ;
                $student_degree->abuse = '1' ;
                $student_degree->save();
                toastr()->error(trans('quizzes_trans.test_canceled_due_to_system_tampering_detected'));
                return redirect('student_exams');
                
            } else {

                $student_degree->question_id = $question_id;
                if (strcmp(trim($answer), trim($right_answer)) === 0) {
                    $student_degree->score += $score;
                } else {
                    $student_degree->score += 0;
                }
                $student_degree->save();
            }
            
            
             
        }
        
        if($this->counter < $this->question_count -1) {
            $this->counter ++;
        } else {
            toastr()->success('its done');
             return redirect('student_exams');
        }

    }
}
