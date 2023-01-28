<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Presensi;
use App\Models\PresensiDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function masuk(Request $request)
    {
        $img = $request->image;
        $folderPath = "public/presensi/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        $data = [
            'user_id' => Auth::user()->id,
            'status' => 1,
            'tgl_presensi' => date('Y-m-d'),
            'jam_masuk' => date('h:i:s'),
            'foto_masuk' => $fileName,
            'lokasi_masuk' => 'Undefined Location',
        ];
        Presensi::create($data);
        Pegawai::where('user_id', Auth::user()->id)->update(['last_presensi' => Carbon::now()->toDateString()]);
        return redirect(route('pegawai.presensi'));
    }
    public function pulang(Request $request, Presensi $presensi)
    {
        $img = $request->image;
        $folderPath = "public/presensi/";

        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';

        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);


        Presensi::where('id', $presensi->id)->update([
            'jam_pulang' => date('h:i:s'),
            'foto_pulang' => $fileName,
            'lokasi_pulang' => 'Undefined Location',
        ]);
        Pegawai::where('user_id', Auth::user()->id)->update(['last_presensi' => Carbon::now()->toDateString()]);
        return redirect(route('pegawai.presensi'));
    }
}
