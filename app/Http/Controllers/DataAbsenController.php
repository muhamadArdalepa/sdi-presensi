<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Presensi;
use App\Models\PresensiDetail;


class DataAbsenController extends Controller
{
    public function absenManual(Request $user){
        $user = User::where('role', 'Pegawai')->paginate(5);
        $presensi = Presensi::all();
        $presensiDetail = PresensiDetail::all();
        return view('admin.absen.absensiManual')->with([
            'title' => 'Data User',
            'pegawai' => $user,
            'presensi' => $presensi,
            'presensiDetail' => $presensiDetail,
        ]);
    }

    // public function izin(){
    //     return view ('admin.absen.alpaIzin')->with([
    //         'title' => 'Absensi alfa/izin'
    //     ]);
    // }
    
    // public function dataabsensi(){
    //     return view ('admin.rekap.DataAbsensi')->with([
    //         'title' => 'Data Absensi'
    //     ]);
    // }
    
    // public function datatelat(){
    //     return view ('admin.rekap.DataTelat')->with([
    //         'title' => 'Data Pegawai Telat'
    //     ]);
    // }
    // public function dataalpaizin(){
    //     return view ('admin.rekap.DataAlpaIzin')->with([
    //         'title' => 'Data Pegawai Alpa/Izin'
    //     ]);
    // }
    
}
