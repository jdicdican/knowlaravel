<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserDetail;
use App\Http\Controllers\Controller;
use App\Http\Requests\Register;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /** 
     * Typecast $request to Register in order to trigger
     * the validation.
     * 
     * Logic taken from parent trait Illuminate\Foundation\Auth\RegistersUsers
     * 
     * @param  App\Http\Requests\Register  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Register $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_type' => (($data['user_type'] == 'author') ? 2 : 3)
        ]);

        $user->userDetail()->save(new UserDetail([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname']
        ]));

        return $user;
    }
}
