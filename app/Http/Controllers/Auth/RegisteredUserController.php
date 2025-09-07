<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'phone' => ['required', 'string', 'max:20'],
    'description' => ['nullable', 'file', 'mimes:pdf,doc,docx,txt', 'max:5120'], // 5MB
        'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
    ]);
$descriptionPath = null;
if ($request->hasFile('description')) {
    $descriptionPath = $request->file('description')->store('descriptions', 'public');
}
    // رفع الصورة إن وُجدت
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('users', 'public');
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'phone' => $request->phone,
        'description' =>$descriptionPath,
        'imagepath' => $imagePath,
        'role' => 'user', // افتراضي
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect('/main');
}

}
