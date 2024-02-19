<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $pwd = Hash::make($request->password);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pwd,
            'user_type' => Client::class,
        ]);

        //$user->sendEmailVerificationNotification();

        //$user->deleteIfNotVerifiedIn(24 * 60);

        event(new Registered($user));

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $pwd,
        ]);

        $cl = Client::where('email', $request->email)->first(); // Remplacez $id par l'ID de l'utilisateur que vous voulez mettre à jour

        $user->update([
            'user_id' => $cl->id, // Remplacez $newUserId par le nouvel ID d'utilisateur
        ]);

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
