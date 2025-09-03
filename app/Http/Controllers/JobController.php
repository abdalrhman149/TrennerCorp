<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{


    public function Addjob()
    {
        $job = Job::all();
        return view('jobs.viewjob', ['alljob' => $job]);
    }

    public function Storejob(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'requirements' => 'nullable|string|max:255',
            'company_id' => 'nullable|exists:companies,id',
            'person_need' => 'required|integer|min:1|max:50',
        ]);


        $newjob = new Job();
        $newjob->title = $request->title;
        $newjob->category = $request->category;
        $newjob->requirements = $request->requirements;
        $newjob->person_need = $request->person_need;
        $newjob->company_id = auth()->user()->id;

        $newjob->save();


        return redirect('/main');
    }
}
