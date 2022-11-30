<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Admin;
use App\Manager;
use App\Package;
use App\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:manager');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['url' => 'admin']);
    }

    public function showManagerRegisterForm($id)
    {
        $package = $id;
        return view('auth.register', ['url' => 'manager'])->with('packages', $package);
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        return redirect()->intended('login/admin');
    }

    protected function createManager(Request $request)
    {
        $this->validator($request->all())->validate();
        $manager = new Manager();
        $manager->package_id = $request->package;
        $pack = Package::find($request->package);
        $duration = $pack->duration;
        $endDate = date("Y-m-d H:i:s", strtotime($duration));
        $manager->ended_at = $endDate;
        $manager->name = $request->name;
        $manager->email = $request->email;
        $manager->phone = $request->phone;
        $manager->password = Hash::make($request->password);
        if($manager->save()){
            $payment = new Payment();
            $payment->manager_id = $manager->id;
            $payment->package_id = $request->package;
            $payment->paymenttype = $request->payment;
            $payment->transaction_id = $request->transaction_id;

            if($payment->save()){
                return redirect()->intended('login/manager');
            }            
        }        
    }
    public function package()
    {   
        $package = Package::where('status',1)->get();
        return view('subcription.package')->with('packages', $package);
    }

}
