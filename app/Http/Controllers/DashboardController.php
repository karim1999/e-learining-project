<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(){
        $quizzes= Quiz::orderBy('start_date', 'DESC')->get();
        return Inertia::render('Dashboard', [
            "quizzes"=> $quizzes,
        ]);
    }
}
