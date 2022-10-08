<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Penduduk;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravolt\Indonesia\IndonesiaService;


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
    // protected $redirectTo = RouteServiceProvider::HOME;
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

    public function showRegistrationForm()
    {
        $kecamatan = \Indonesia::findCity(170, ['districts.villages']);

        return view('auth.register', ['kecamatan' => $kecamatan]);
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
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nik' => ['required', 'max:15', 'unique:penduduks'],
            'no_kk' => ['required', 'max:15', 'unique:penduduks'],
            'no_hp' => ['required', 'max:13', 'unique:penduduks'],
        ], [
            'nama.required' => 'Masukkan Nama!',
            'username.required' => 'Masukkan Username!',
            'email.required' => 'Masukkan Email!',
            'nik.required' => 'Masukkan Nomor Induk Kependudukan!',
            'no_kk.required' => 'Masukkan Nomor Kartu Keluarga!',
            'no_hp.required' => 'Masukkan Nomor Handphone!',
            'email.email' => 'Format Email tidak dikenal',
            'password.confirmed' => 'Password tidak sama',
            'email.unique' => 'Email sudah terdaftar',
            'nik.unique' => 'NIK sudah terdaftar',
            'no_kk.unique' => 'Nomor Kartu Keluarga sudah terdaftar',
            'no_hp.unique' => 'Nomor Handphone sudah terdaftar'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     * @return \App\Models\Penduduk
     */
    protected function create(array $data)
    {
        $warga = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $warga->assignRole('warga');

        $penduduk  = Penduduk::create([
            'nama'          => $data['nama'],
            'nik'           => $data['nik'],
            'no_kk'         => $data['no_kk'],
            'no_hp'         => '+' . 62 . $data['no_hp'],
            'district_id'   => $data['kecamatan'],
            'village_id'    => $data['desa'],
            'user_id'       => $warga->id,
        ]);

        return $warga;
    }
}
