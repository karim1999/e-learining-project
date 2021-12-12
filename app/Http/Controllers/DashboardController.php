<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Carbon\Carbon;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $user= auth()->user();
        $quizzes= Quiz::withCount('questions')->with(['assessments'=> function ($query) use ($user){
            $query->where('user_id', $user->id);
        }])->whereHas('questions', null, '>', 0)->orderBy('start_date', 'DESC')->whereDate('start_date', '<=', Carbon::now())->get();

        return Inertia::render('Dashboard', [
            "quizzes"=> $quizzes,
        ]);
    }
}
