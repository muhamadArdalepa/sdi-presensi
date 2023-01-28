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


class AdminController extends Controller
{
     public function __construct()
    {
        $this->middleware('admin');
    }


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
            'nama'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    

    function createAdmin(Request $user)
    {
        User::create([
            'nama'      => $user['nama'],
            'email'     => $user['email'],
            'role'      => 'Admin',
            'password'  => Hash::make($user['password']),
        ]);
        session()->flash('pesan',"Penambahan Data {$user['nama']} berhasil");
        return redirect(route('admin'));
    }


    public function updateAdmin(Request $user)
    { 
        User::where('id', $user->id)
            ->update([
                'nama'  => $user->nama,
                'email' => $user->email,
            ]);

        session()->flash('pesan',"Perubahan Data {$user['nama']} berhasil");
        return redirect()->route('admin');
    }

    
    public function deleteAdmin($id){
        $user = User::where('id',$id)->first();
        $user->delete();
        return redirect()->route('admin')->with('pesan',"Data {$user['nama']} berhasil dihapus" );
    }    
}
