<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\Job;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;

class JobController extends Controller

{

public function accept(Request $request, $id)
{
    $data = $request->validate([
        'job_id' => 'required|exists:jobs,id',
    ]);

    $user_id = auth()->id(); // المستخدم الحالي

    return view('jobs.accept', [
        'job_id' => $data['job_id'],
        'user_id' => $user_id,
    ]);
}

public function CV(Request $request, $job_id)
{
    $request->validate([
        'file_cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
        'message' => 'required|string|max:1000',
    ]);

    $path = $request->file('file_cv')->store('cv', 'public');

    $newCV = new CV();
    $newCV->user_id = auth()->id();
    $newCV->job_id = $job_id;
    $newCV->cv_path = $path;
    $newCV->message = $request->message;
    $newCV->save();

    return redirect('/main')->with('success', 'تم إرسال السيرة الذاتية بنجاح!');
}


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
            'company_id' => 'nullable',
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
