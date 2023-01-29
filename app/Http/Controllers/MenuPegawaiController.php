<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class MenuPegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = 'Profil';
        return view('pegawai.profil', compact('title'));
    }

    public function PUpdate(Request $request, $id)
    {
        User::where('id', Auth::user()->id)
            ->update([
                'nama' => $request->nama,
                'email' => $request->email,
            ]);

        Pegawai::where('user_id', Auth::user()->id)
            ->update([
                'nip' => $request->nip,
                'tgl_lahir' => $request->tgl_lahir,
                'j_k' => $request->j_k,
                'no_tlp' => $request->no_tlp,
                'alamat' => $request->alamat,
                'jabatan_id' => $request->jabatan_id,
                'cabang_id' => $request->cabang_id,
            ]);

        session()->flash('pesan', "Update Profil {$request->nama} berhasil");
        return redirect(route('profil.index'));
    }

    function crop(Request $request)
    {
        $path = 'users/images/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }
        $file = $request->file('file');
        $new_image_name = 'UIMG' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);
        if ($upload) {

            $PegawaiInfo = Pegawai::where('user_id', '=', Auth::user()->id)->first();
            $pegawaiphoto = $PegawaiInfo->foto;
            if ($pegawaiphoto != '') {
                unlink($path . $pegawaiphoto);
            }
            Pegawai::where('user_id', '=', Auth::user()->id)->update(['foto' => $new_image_name]);
            return response()->json(['status' => 1, 'msg' => 'Image has been cropped successfully.', 'name' => $new_image_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }

    function changePassword(Request $request)
    {
        //Validate form
        $validator = Validator::make($request->all(), [
            'oldpassword' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        return $fail(__('The current password is incorrect'));
                    }
                },
                'min:8',
                'max:30'
            ],
            'newpassword' => 'required|min:8|max:30',
            'cnewpassword' => 'required|same:newpassword'
        ], [
            'oldpassword.required' => 'Enter your current password',
            'oldpassword.min' => 'Old password must have atleast 8 characters',
            'oldpassword.max' => 'Old password must not be greater than 30 characters',
            'newpassword.required' => 'Enter new password',
            'newpassword.min' => 'New password must have atleast 8 characters',
            'newpassword.max' => 'New password must not be greater than 30 characters',
            'cnewpassword.required' => 'ReEnter your new password',
            'cnewpassword.same' => 'New password and Confirm new password must match'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $update = User::find(Auth::user()->id)->update(['password' => Hash::make($request->newpassword)]);

            if (!$update) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, Failed to update password in db']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your password has been changed successfully']);
            }
        }
    }

    public function presensi()
    {
        $title = 'Presensi';
        $today = Carbon::now()->toDateString();
        $presensi = Presensi::where('user_id', Auth::user()->id)->where('tgl_presensi', $today)->first();
        return view('pegawai.presensi', compact('title', 'presensi'));
    }

    public function task(Request $request)
    {
        $title = 'Task';
        return view('pegawai.task', compact('title'));
    }
}
