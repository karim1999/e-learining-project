<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function takeQuiz(Quiz $quiz){
        return Inertia::render('Quiz', [
            "quiz" => $quiz,
            "questions" => $quiz->questions()->with('options')->get()
        ]);
    }
    public function submit(Request $request){
        return Inertia::render('Dashboard');
    }
}
