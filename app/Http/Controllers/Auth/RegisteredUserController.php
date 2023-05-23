<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Plan;
use App\Models\Utility;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function create()
    {
        if (Utility::getValByName('signup_button') == 'on') {
            return view('auth.register');
        } else {
            return abort('404', 'Page not found');
        }
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


        if (env('RECAPTCHA_MODULE') == 'yes') {
            $validation['g-recaptcha-response'] = 'required|captcha';
        } else {
            $validation = [];
        }
        $this->validate($request, $validation);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if (Utility::getValByName('verified_button') == "off") {
            $user = User::create([
                'username' => $request->name,
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at'=>date('H:i:s'),
                'password' => Hash::make($request->password),
                'type' => 'owner',
                'lang' => 'en',
                'title' => '-',
                'avatar' => '',
                'plan' => Plan::first()->id,
                'created_by' => 1,

            ]);

            $adminRole = Role::findByName('owner');

            $user->assignRole($adminRole);
            $user->userDefaultDataRegister($user->id);

            //        $user->assignPlan(1);
            //
            //        $user->userDefaultData();
            //
            //        $user->makeEmployeeRole();
            //
            // event(new Registered($user));

            Auth::login($user);

            return redirect(RouteServiceProvider::HOME);
        } else {
            $user = User::create([
                'username' => $request->name,
                'name' => $request->name,
                'email' => $request->email,
                // 'email_verified_at'=>date('H:i:s'),
                'password' => Hash::make($request->password),
                'type' => 'owner',
                'lang' => 'en',
                'title' => '-',
                'avatar' => '',
                'plan' => Plan::first()->id,
                'created_by' => 1,

            ]);

            if (empty($lang)) {
                $lang = Utility::getValByName('default_language');
            }
            \App::setLocale($lang);


            try {

                event(new Registered($user));
                $role_r = Role::findByName('owner');
                // dd('hi');
                // dd($user->userDefaultDataRegister($user->id));
                $user->userDefaultDataRegister($user->id);
                $user->assignRole($role_r);
                
                // dd($role_r);
            } catch (\Exception $e) {
                // dd($e);
                $user->delete();
                return redirect('/register/lang?')->with('status', __('Email SMTP settings does not configure so please contact to your site admin.'));
            }

            // return redirect(::HOME);
            Auth::login($user);

            return view('auth.verify-email', compact('lang'));
        }
    }


    public function showRegistrationForm($lang = '')
    {
        // dd($lang);
        if (empty($lang)) {
            $lang = Utility::getValByName('default_language');
        }
        // dd($lang);
        \App::setLocale($lang);
        // dd($lang);
        return view('auth.register', compact('lang'));
    }
}
