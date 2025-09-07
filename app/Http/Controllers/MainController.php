<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function Main(){
        // Fetch all jobs with their company information
        $jobs = Job::with('user')->paginate(6);

        return view('main', compact('jobs'));
    }
}
