<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class DetailController extends Controller
{
  public function view($id)
{
    $job = Job::with('user')->findOrFail($id);

                return view('detail', compact('job'));


}
}
