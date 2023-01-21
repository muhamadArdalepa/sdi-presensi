<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Cabang;

class PegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    
    public function pegawai(Request $request)
    {
        $pegawai = User::where('role', 'Pegawai')->with('pegawai')->paginate(5);
        $jabatan = Jabatan::all();
        $cabang = Cabang::all();
        return view('admin.pegawai')->with([
            'title'     => 'Data Pegawai',
            'pegawai'   => $pegawai,
            'jabatan'   => $jabatan,
            'cabang'    => $cabang
        ]);
    }


    public function createPegawai(Request $request)
    {
        $validator = Validator::Make($request->all(), [
            'nip'        => 'required|numeric|unique:App\Models\Pegawai,nip',
            'nama'       => 'required|min:3|max:50',
            'email'      => 'required|email|unique:users',
            'j_k'        => 'required',
            'no_tlp'     => 'numeric|nullable',
            'jabatan_id' => 'required',
            'cabang_id'  => 'required',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => 'Pegawai',
            // default password jika admin menambahkan pegawai secara manual
            'password' => Hash::make('password'),
        ]);

        Pegawai::create([
            'user_id'    => User::latest()->first()->id,
            'nip'        => trim($request->nip),
            'j_k'        => $request->j_k,
            'tgl_lahir'  => $request->tgl_lahir,
            'no_tlp'     => $request->no_tlp,
            'alamat'     => $request->alamat,
            'jabatan_id' => $request->jabatan_id,
            'cabang_id'  => $request->cabang_id,
        ]);
        return redirect()->route('pegawai')->with('pesan',"Penambahan Data {$request['nama']} berhasil" );
    }


    public function updatePegawai(Request $request, $id)
    {
        User::where('id', $request->id)
        ->update([
            'nama'       => $request->nama,
            'email'      => $request->email,
        ]);

        Pegawai::where('user_id',$request->id)
        ->update([
            'nip'        => $request->nip,
            'tgl_lahir'  => $request->tgl_lahir,
            'j_k'        => $request->j_k,
            'no_tlp'     => $request->no_tlp,
            'alamat'     => $request->alamat,
            'jabatan_id' => $request->jabatan_id,
            'cabang_id'  => $request->cabang_id,
        ]);


        session()->flash('pesan',"Perubahan Data {$request['nama']} berhasil");
        return redirect()->route('pegawai');

    }


    public function deletePegawai($id)
    {
        $user = User::where('id',$id)->first();
        $user->delete();
        return redirect()->route('admin')->with('pesan',"Data {$user['nama']} berhasil dihapus" );
    }
}