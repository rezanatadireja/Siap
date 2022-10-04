<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Syarat;

class SyaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // KK
        $syarat1  = Syarat::create(['nama' => 'Fofo KK Asli laki-laki / surat pindah laki-laki jika berasal dari luar BDL']);
        $syarat2  = Syarat::create(['nama' => 'Foto KK asli perempuan / surat pindah perempuan jika berasal dari luar BDL']);
        $syarat3  = Syarat::create(['nama' => 'Foto Buku Nikah Asli yang bersangkutan']);
        $syarat4  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua laki-laki']);
        $syarat5  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
        // $syarat6  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
        // $syarat7  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
        // $syarat8  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
        // $syarat9  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
        // $syarat10  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
        // $syarat11  = Syarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan']);
    }
}
