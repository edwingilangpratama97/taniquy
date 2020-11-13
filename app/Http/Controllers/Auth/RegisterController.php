<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Enduser;
use App\Models\Retailer;
use App\Models\KelompokTani;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/v1/dashboard';

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
            'kontak' => ['required','numeric']
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
        if ($data['role'] == 'enduser') {
            $enduser = Enduser::count();
            $date = date("Ymd");
            $kode = sprintf("EU".$date."%'.04d\n", $enduser+1);
            $create = Enduser::create([
                'kontak' => $data['kontak'],
                'kode_enduser' => $kode
            ]);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'id_enduser' => $create->id,
                'password' => Hash::make($data['password']),
            ]);
        } elseif ($data['role'] == 'retailer') {
            $retailer = Retailer::count();
            $date = date("Ymd");
            $kode = sprintf("RT".$date."%'.04d\n", $retailer+1);
            $create = Retailer::create([
                'kontak' => $data['kontak'],
                'kode_retailer' => $kode
            ]);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'id_retailer' => $create->id,
                'password' => Hash::make($data['password']),
            ]);
        } elseif ($data['role'] == 'kelompok') {
            $kelompok = KelompokTani::count();
            $date = date("Ymd");
            $kode = sprintf("KT".$date."%'.04d\n", $kelompok+1);
            $create = KelompokTani::create([
                'kontak' => $data['kontak'],
                'kode_kelompok' => $kode
            ]);

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'id_kelompok' => $create->id,
                'password' => Hash::make($data['password']),
            ]);
        } 
    }
}
