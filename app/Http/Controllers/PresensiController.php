<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use App\Models\PresensiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    public function __invoke(Request $request)
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
        ];
        Presensi::create($data);
        $detail = new PresensiDetail;
        $detail->presensi_id = Presensi::latest()->first()->id;
        $detail->foto = $fileName;
        $detail->lokasi = 'Undefined Location';
        $detail->ket = 'Some Keterangan';
        $detail->save();
    }
}
