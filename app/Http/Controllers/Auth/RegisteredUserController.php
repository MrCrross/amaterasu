<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'last_name'=>'required|string|max:255',
            'first_name'=>'required|string|max:255',
            'phone'=>'required|string|max:16|min:16',
            'birthday'=>'required|date',
            'email'=>'required|email',
            'name' => ['required', 'string', 'max:255'],
            'avatar'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $url = Storage::disk('public')->put('users', $request->avatar);
        $user = User::create([
            'name' => $request->name,
            'avatar'=>'storage/'.$url,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        $user->assignRole(Role::where('name','Клиент')->pluck('id')->first());
        Client::create([
            'last_name'=>$request->last_name,
            'first_name'=>$request->first_name,
            'phone'=>$request->phone,
            'birthday'=>$request->birthday,
            'email' => $request->email,
            'user_id'=>$user->id
        ]);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
