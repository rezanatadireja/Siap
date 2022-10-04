<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BidangPengaduan;
use App\Models\SubBidang;
use App\Models\JenisPengaduan;
use App\Models\JenisSyarat;

class JenisPelayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Bidang
        $bidang1 = BidangPengaduan::create(['name'=>'Pendaftaran Penduduk']);
        $bidang2 = BidangPengaduan::create(['name'=>'Pencatatan Sipil']);

        // Seed Sub Bidang
        $sub1 = SubBidang::create(['nama' => 'Kartu Keluarga']);
        $sub2 = SubBidang::create(['nama' => 'Kartu Identitas Anak']);
        $sub3 = SubBidang::create(['nama' => 'KTP-El']);
        $sub4 = SubBidang::create(['nama' => 'Penduduk Pindah/Datang']);
        $sub5 = SubBidang::create(['nama' => 'Akta Kelahiran']);
        $sub6 = SubBidang::create(['nama' => 'Akta Perkawinan']);
        $sub7 = SubBidang::create(['nama' => 'Akta Cerai']);
        $sub8 = SubBidang::create(['nama' => 'Akta Kematian']);

        // Seed Jenis Pelayanan
        $pelayanan1 = JenisPengaduan::create(['nama'=>'Penerbitan KK Baru (Karena Menikah)', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20]);

        $pelayanan2 = JenisPengaduan::create(['nama'=>'Penerbitan KK Karena Pemabambahan Anak Baru Lahir', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20]);

        $pelayanan3 = JenisPengaduan::create(['nama'=>'Penerbitan KK Karena Perbaikan Data', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20]);

        $pelayanan4 = JenisPengaduan::create(['nama'=>'Penerbitan KK Rusak/Hilang', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20]);
        
        $pelayanan5 = JenisPengaduan::create(['nama'=>'Kartu Identitas Anak  1 Hari - 5 Tahun', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub2->id , 'kuota' => 20]);

        $pelayanan6 = JenisPengaduan::create(['nama'=>'Kartu Identitas Anak > 5 Tahun - 17 Tahun', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub2->id , 'kuota' => 20]);

        $pelayanan7 = JenisPengaduan::create(['nama'=>'KTP-El Baru', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub3->id, 'kuota' => 20]);

        $pelayanan8 = JenisPengaduan::create(['nama'=>'KTP-El Perbaikan Data', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub3->id, 'kuota' => 20]);

        $pelayanan9 = JenisPengaduan::create(['nama'=>'KTP-El Rusak/Hilang', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub3->id, 'kuota' => 20]);
        
        $pelayanan10 = JenisPengaduan::create(['nama'=>'Penduduk Datang', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub4->id, 'kuota' => 20]);

        $pelayanan11 = JenisPengaduan::create(['nama'=>'Penduduk Pindah', 
        'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub4->id, 'kuota' => 20]);

        //Seed Syarat Pelayanan
        $syarat1 = JenisSyarat::create(['nama' => 'Kartu Keluarga Asli*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan2->id
                                        ]);

        $syarat1 = JenisSyarat::create(['nama' => 'Surat Keterangan Lahir dari Rumah Sakit/Klinik/Dokter/Bidan*) (Format portrait)', 
                                        'jenis_pengaduan_id' => $pelayanan2->id
                                        ]);

        $syarat1 = JenisSyarat::create(['nama' => 'Buku Nikah Orang tua*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan2->id
                                        ]);

        $syarat1 = JenisSyarat::create(['nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)', 
                                        'jenis_pengaduan_id' => $pelayanan2->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Fofo KK Asli laki-laki/surat pindah laki-laki jika berasal dari luar MJL*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Foto KK asli perempuan/surat pindah perempuan jika berasal dari luar MJL*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Foto Buku Nikah Asli yang bersangkutan*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Foto Buku Nikah Asli orang tua laki-laki*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Foto KTP Asli Laki-laki & perempuan*) (Format portrait)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Foto Diri Berdua yang menikah*) (Format landsape)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Keterangan domisili jika pindah alamat (Format portrait)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat2 = JenisSyarat::create(['nama' => 'Surat lain (jika diminta) (Format portrait)', 
                                        'jenis_pengaduan_id' => $pelayanan1->id
                                        ]);

        $syarat3 = JenisSyarat::create(['nama' => 'Kartu Keluarga Asli*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);

        $syarat3 = JenisSyarat::create(['nama' => 'KTP-el yang bersangkutan/orangtua*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);

        $syarat3 = JenisSyarat::create(['nama' => 'Buku Nikah Orang tua/yang bersangkutan*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);

        $syarat3 = JenisSyarat::create(['nama' => 'Surat Keterangan/Penetapan Pengadilan*) (Format portrait)', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);

        $syarat3 = JenisSyarat::create(['nama' => 'Surat Lain (jika diminta)', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);

        $syarat3 = JenisSyarat::create(['nama' => 'Dokumen Pendukung', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);
                                        
        $syarat3 = JenisSyarat::create(['nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)', 
                                        'jenis_pengaduan_id' => $pelayanan3->id
                                        ]);

        $syarat4 = JenisSyarat::create(['nama' => 'Surat Keterangan Kehilangan dari Kepolisian (jika hilang)*Format portrait', 
                                        'jenis_pengaduan_id' => $pelayanan4->id
                                        ]);
        $syarat4 = JenisSyarat::create(['nama' => 'KTP-el *) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan4->id
                                        ]);
        $syarat4 = JenisSyarat::create(['nama' => 'Fotocopy KK yang hilang (jika ada)/Photo KK yang rusak (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan4->id
                                        ]);
        $syarat4 = JenisSyarat::create(['nama' => 'Buku Nikah*) (Format landscape)', 
                                        'jenis_pengaduan_id' => $pelayanan4->id
                                        ]);
        $syarat4 = JenisSyarat::create(['nama' => 'Surat Lain (jika diminta)', 
                                        'jenis_pengaduan_id' => $pelayanan4->id
                                        ]);
        $syarat4 = JenisSyarat::create(['nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)', 
                                        'jenis_pengaduan_id' => $pelayanan4->id
                                        ]);
    }
}
