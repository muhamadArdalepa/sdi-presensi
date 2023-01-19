<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

// Model
use App\Models\Pegawai;
use App\Models\Task;
use App\Models\Jabatan;
use App\Models\Cabang;
use App\Models\User;


class MenuAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    //* ------------------------------------------------------ A D M I N -------------------------------------------------------------- *//

    public function admin(Request $user) 
    {
        $admin = User::where('role', 'Admin')->paginate(5);
        return view('admin.admin')->with([
            'title' => 'Data User',
            'admin' => $admin,
        ]);
    }


    function validator(Request $user)
    {
        return Validator::make($user, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    

    function createAdmin(Request $user)
    {
        User::create([
            'nama' => $user['nama'],
            'email' => $user['email'],
            'role' => 'Admin',
            'password' => Hash::make($user['password']),
        ]);
        session()->flash('pesan',"Penambahan Data {$user['nama']} berhasil");
        return redirect(route('admin'));
    }


    public function updateAdmin(Request $request)
    {
        // dd($request->all());
        // $validasi = $request->validate([
        //     'nama' => 'required|min:1|max:50',
        //     'email' => ['required', 'string', 'min:3', 'max:30', Rule::unique('user')->ignore($request->id)]
        // ]);

        // User::where('id', '=', Auth::user()->id)
        //     ->update([
        //         'nama' => $request->nama,
        //         'email' => $request->email,
        // ]);

        $validateData = $request->validate([
            'nama' => 'required|min:1|max:50',
            'email' => 'required|unique:users,email',
        ]);
        $user = User::where('id', '=', Auth::user()->id)
            ->update([
                'nama' => $request->nama,
                'email' => $request->email,
            ]);

        session()->flash('pesan',"Perubahan Data {$user['nama']} berhasil");
        return redirect()->route('admin');
    }
    
    
    //* ------------------------------------------------------ P E G A W A I -------------------------------------------------------------- *//


    public function pegawai()
    {
        $pegawai = User::where('role', 'Pegawai')->with('pegawai')->paginate(5);
        $jabatan = Jabatan::all();
        $cabang = Cabang::all();
        return view('admin.pegawai')->with([
            'title' => 'Data Pegawai',
            'pegawai' => $pegawai,
            'jabatan' => $jabatan,
            'cabang' => $cabang
        ]);
    }
}
