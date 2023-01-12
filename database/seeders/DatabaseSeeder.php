<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        DB::table('cabangs')->insert(
            [
                'id' => 1,
                'cabang' => 'Pontianak'
            ]
        );
        DB::table('cabangs')->insert(
            [
                'id' => 2,
                'cabang' => 'Kubu Raya'
            ],
        );
        DB::table('jabatans')->insert(
            [
                'id' => 1,
                'jabatan' => 'CEO'
            ]
        );
        DB::table('jabatans')->insert(
            [
                'id' => 2,
                'jabatan' => 'Teknisi'
            ],
        );
        DB::table('users')->insert(
            [
                'nama' => 'Example Name',
                'role' => 'Admin',
                'email' => 'example@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
        DB::table('users')->insert(
            [
                'nama' => 'Nama Pegawai',
                'role' => 'Pegawai',
                'email' => 'pegawai@gmail.com',
                'password' => Hash::make('password'),
            ]
        );
        DB::table('pegawais')->insert(
            [
                'user_id' => 1,
                'nip' => '123456789012345678',
                'j_k' => 2,
                'no_tlp' => '081521544674',
                'jabatan_id' => 1,
                'cabang_id' => 1,
            ]
        );
        DB::table('pegawais')->insert(
            [
                'user_id' => 2,
                'nip' => '123456789012345679',
                'j_k' => 2,
                'no_tlp' => '081521544674',
                'jabatan_id' => 2,
                'cabang_id' => 2,
            ]
        );
=======
        $this->call([
            CabangSeeder::class,
            JabatanSeeder::class,
            UserSeeder::class,
            PegawaiSeeder::class,
        ]); 
        
        
        
        
>>>>>>> 611f5f488d963fb5dcc08d01d39fc3327fd42924
        // \App\Models\User::factory(10)->create();
    }
}
