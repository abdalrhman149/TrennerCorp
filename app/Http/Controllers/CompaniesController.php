<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CompaniesController extends Controller
{
    public function Viewcompany(Request $request)
   {
    $search = $request->input('search');

    $alluser = User::query()
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
        ->paginate(10); // تقسيم الصفحات 10 عناصر

    return view('company.viewcompany', compact('alluser', 'search'));
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
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('company.edituser', compact('user'));
}
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,'.$id,
        'phone' => 'required|string|max:20',
        'role' => 'required|in:user,company,admin',
        'imagepath' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'description' => 'nullable|string|max:2000',
    ]);

    // handle image upload if present
    if ($request->hasFile('imagepath')) {
        $path = $request->file('imagepath')->store('users', 'public');
        $user->imagepath = $path;
    }

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->role = $request->role;
    $user->description = $request->description;

    $user->save();

    return redirect()->route('viewcompany')->with('success', 'User updated successfully');
}
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('viewcompany')->with('success', 'User deleted successfully');
}
}
