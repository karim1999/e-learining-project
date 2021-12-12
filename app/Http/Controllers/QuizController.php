<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Assessment;
use App\Models\Option;
use App\Models\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function takeQuiz(Quiz $quiz){
        if(Carbon::createFromDate($quiz->start_date)->greaterThan(Carbon::now())){
            return redirect()->route('dashboard')->with('message', "The quiz hasn't started yet");
        }
        if($quiz->questions->count() <= 0){
            return redirect()->route('dashboard')->with('message', "The quiz is still being created");
        }
        $user= auth()->user();
        $assessment= Assessment::where('user_id', $user->id)->where('quiz_id', $quiz->id)->first();
        if($assessment){
            if($assessment->score || $assessment->finished_at){
                return redirect()->route('dashboard')->with('message', 'You have already completed this test.');
            }
            if($assessment->started_at){
                if(Carbon::createFromDate($assessment->started_at)->addMinutes($quiz->duration)->lessThanOrEqualTo(Carbon::now())){
                    $this->evaluateScore($assessment);
                    return redirect()->route('dashboard')->with('message', "Time is up. You cannot continue the quiz.");
                }
            }
        }else{
            $assessment= new Assessment();
            $assessment->user_id= $user->id;
            $assessment->quiz_id= $quiz->id;
            $assessment->started_at= Carbon::now();
            $assessment->save();
        }
        return Inertia::render('Quiz', [
            "assessment" => $assessment,
            "quiz" => $quiz,
            "questions" => $quiz->questions()->with('options')->get()
        ]);
    }
    public function evaluateScore(Assessment $assessment){
        $assessment->finished_at= Carbon::now();
        $score= 0;
        foreach ($assessment->answers as $answer){
            $score+= $answer->correct ? 1 : 0;
        }
        $assessment->score= $score;
        $assessment->save();
        return $assessment;
    }
    public function submit(Quiz $quiz, Request $request){
        $user= auth()->user();
        $assessment= Assessment::where('user_id', $user->id)->where('quiz_id', $quiz->id)->first();
        if(!$assessment)
            abort(404);

        $answers= $request->input('answers');
        foreach ($answers as $answer){
            $newAnswer= new Answer();
            $option= Option::findOrFail($answer['option_id']);
            $newAnswer->assessment_id= $assessment->id;
            $newAnswer->question_id= $answer['question_id'];
            $newAnswer->option_id= $answer['option_id'];
            $newAnswer->correct= $option->correct;
            $newAnswer->save();
        }
        $this->evaluateScore($assessment);
        return redirect()->route('dashboard')->with('message', 'The quiz was finished successfully.');
    }
}
