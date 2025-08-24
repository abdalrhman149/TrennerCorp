<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CompaniesController extends Controller
{
    public function Viewcompany()
    {
        $company = Company::all();

        return view('company.viewcompany', ['allcompany' => $company]);
    }
    public function Storecompany(Request $request)


    {


        $request->validate([
            'name' => 'required|string|max:25',
            'phone' => 'required|numeric|min:0',
            'description' => 'required',
            'imagepath' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048',
        ]);

        $newcompany = new Company();
        $newcompany->name = $request->name;
        $newcompany->phone = $request->phone;
        $newcompany->description = $request->description;

        if ($request->hasFile('imagepath')) {
            $file = $request->file('imagepath');
            $path = $file->move('uploads', Str::uuid()->toString() . '-' . $file->getClientOriginalName());
            $newcompany->imagepath = $path;
        }

        $newcompany->save();

        return redirect('/main');
    }
}
