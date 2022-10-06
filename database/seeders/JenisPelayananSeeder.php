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
        $bidang1 = BidangPengaduan::create(['name' => 'Pendaftaran Penduduk']);
        $bidang2 = BidangPengaduan::create(['name' => 'Pencatatan Sipil']);

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
        $pelayanan1 = JenisPengaduan::create([
            'nama' => 'Penerbitan KK Baru (Karena Menikah)',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20
        ]);

        $pelayanan2 = JenisPengaduan::create([
            'nama' => 'Penerbitan KK Karena Pemabambahan Anak Baru Lahir',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20
        ]);

        $pelayanan3 = JenisPengaduan::create([
            'nama' => 'Penerbitan KK Karena Perbaikan Data',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20
        ]);

        $pelayanan4 = JenisPengaduan::create([
            'nama' => 'Penerbitan KK Rusak/Hilang',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub1->id, 'kuota' => 20
        ]);

        $pelayanan5 = JenisPengaduan::create([
            'nama' => 'Kartu Identitas Anak  1 Hari - 5 Tahun',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub2->id, 'kuota' => 20
        ]);

        $pelayanan6 = JenisPengaduan::create([
            'nama' => 'Kartu Identitas Anak > 5 Tahun - 17 Tahun',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub2->id, 'kuota' => 20
        ]);

        $pelayanan7 = JenisPengaduan::create([
            'nama' => 'KTP-El Baru',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub3->id, 'kuota' => 20
        ]);

        $pelayanan8 = JenisPengaduan::create([
            'nama' => 'KTP-El Perbaikan Data',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub3->id, 'kuota' => 20
        ]);

        $pelayanan9 = JenisPengaduan::create([
            'nama' => 'KTP-El Rusak/Hilang',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub3->id, 'kuota' => 20
        ]);

        $pelayanan10 = JenisPengaduan::create([
            'nama' => 'Penduduk Datang',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub4->id, 'kuota' => 20
        ]);

        $pelayanan11 = JenisPengaduan::create([
            'nama' => 'Penduduk Pindah',
            'bidang_pengaduan_id' => $bidang1->id, 'sub_bidang_id' => $sub4->id, 'kuota' => 20
        ]);

        //Seed Syarat Pelayanan
        $syarat1 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan2->id
        ]);

        $syarat1 = JenisSyarat::create([
            'nama' => 'Surat Keterangan Lahir dari Rumah Sakit/Klinik/Dokter/Bidan*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan2->id
        ]);

        $syarat1 = JenisSyarat::create([
            'nama' => 'Buku Nikah Orang tua*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan2->id
        ]);

        $syarat1 = JenisSyarat::create([
            'nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan2->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Fofo KK Asli laki-laki/surat pindah laki-laki jika berasal dari luar MJL*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Foto KK asli perempuan/surat pindah perempuan jika berasal dari luar MJL*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Foto Buku Nikah Asli yang bersangkutan*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Foto Buku Nikah Asli orang tua laki-laki*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Foto Buku Nikah Asli orang tua pihak perempuan*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Foto KTP Asli Laki-laki & perempuan*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Foto Diri Berdua yang menikah*) (Format landsape)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Keterangan domisili jika pindah alamat (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat2 = JenisSyarat::create([
            'nama' => 'Surat lain (jika diminta) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan1->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'KTP-el yang bersangkutan/orangtua*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'Buku Nikah Orang tua/yang bersangkutan*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'Surat Keterangan/Penetapan Pengadilan*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'Surat Lain (jika diminta)',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'Dokumen Pendukung',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat3 = JenisSyarat::create([
            'nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan3->id
        ]);

        $syarat4 = JenisSyarat::create([
            'nama' => 'Surat Keterangan Kehilangan dari Kepolisian (jika hilang)*Format portrait',
            'jenis_pengaduan_id' => $pelayanan4->id
        ]);
        $syarat4 = JenisSyarat::create([
            'nama' => 'KTP-el *) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan4->id
        ]);
        $syarat4 = JenisSyarat::create([
            'nama' => 'Fotocopy KK yang hilang (jika ada)/Photo KK yang rusak (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan4->id
        ]);
        $syarat4 = JenisSyarat::create([
            'nama' => 'Buku Nikah*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan4->id
        ]);
        $syarat4 = JenisSyarat::create([
            'nama' => 'Surat Lain (jika diminta)',
            'jenis_pengaduan_id' => $pelayanan4->id
        ]);
        $syarat4 = JenisSyarat::create([
            'nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan4->id
        ]);

        //syarat KIA 5-7
        $syarat5 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape',
            'jenis_pengaduan_id' => $pelayanan5->id
        ]);
        $syarat5 = JenisSyarat::create([
            'nama' => 'Akta Kelahiran*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan5->id
        ]);
        $syarat5 = JenisSyarat::create([
            'nama' => 'KTP-el Orang Tua*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan5->id
        ]);
        $syarat5 = JenisSyarat::create([
            'nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan5->id
        ]);

        //KIA 7 - 17
        $syarat6 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan6->id
        ]);
        $syarat6 = JenisSyarat::create([
            'nama' => 'Akta Kelahiran*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan6->id
        ]);
        $syarat6 = JenisSyarat::create([
            'nama' => 'KTP-el Orang Tua*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan6->id
        ]);
        $syarat6 = JenisSyarat::create([
            'nama' => 'Pas Photo Berwarna Anak*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan6->id
        ]);
        $syarat6 = JenisSyarat::create([
            'nama' => 'Photo Diri (orang yg ada dalam KK) memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan6->id
        ]);

        //penduduk pindah
        $syarat7 = JenisSyarat::create([
            'nama' => 'Formulir Permohonan F.1-23*)',
            'jenis_pengaduan_id' => $pelayanan10->id
        ]);
        $syarat7 = JenisSyarat::create([
            'nama' => 'Fotocopy Buku Nikah/Akta Cerai (jika berstatus kawin/cerai)',
            'jenis_pengaduan_id' => $pelayanan10->id
        ]);
        $syarat7 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli yang ditumpangi*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan10->id
        ]);
        $syarat7 = JenisSyarat::create([
            'nama' => 'Surat Keterangan Pindah dari Daerah Asal*)',
            'jenis_pengaduan_id' => $pelayanan10->id
        ]);
        $syarat7 = JenisSyarat::create([
            'nama' => 'Photo Diri memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan10->id
        ]);

        //penduduk datang
        $syarat8 = JenisSyarat::create([
            'nama' => 'Formulir Permohonan F.1-23*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan11->id
        ]);
        $syarat8 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli yang pindah*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan11->id
        ]);
        $syarat8 = JenisSyarat::create([
            'nama' => 'KTP-el yang pindah*)',
            'jenis_pengaduan_id' => $pelayanan11->id
        ]);
        $syarat8 = JenisSyarat::create([
            'nama' => 'Photo Diri memegang dokumen*) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan11->id
        ]);

        //ktp el-baru
        $syarat9 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan7->id
        ]);
        $syarat9 = JenisSyarat::create([
            'nama' => 'Tanda Bukti Perekaman*)',
            'jenis_pengaduan_id' => $pelayanan7->id
        ]);
        $syarat9 = JenisSyarat::create([
            'nama' => 'Photo Diri memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan7->id
        ]);

        //ktp el perbaikan data
        $syarat10 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan8->id
        ]);
        $syarat10 = JenisSyarat::create([
            'nama' => 'KTP-el Asli*)',
            'jenis_pengaduan_id' => $pelayanan8->id
        ]);
        $syarat10 = JenisSyarat::create([
            'nama' => 'Photo Diri memegang dokumen*)',
            'jenis_pengaduan_id' => $pelayanan8->id
        ]);

        //ktp el rusak/hilang
        $syarat10 = JenisSyarat::create([
            'nama' => 'Kartu Keluarga Asli*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan9->id
        ]);
        $syarat10 = JenisSyarat::create([
            'nama' => 'KTP-el Asli/Foto copy jika hilang*) (Format landscape)',
            'jenis_pengaduan_id' => $pelayanan9->id
        ]);
        $syarat10 = JenisSyarat::create([
            'nama' => 'Surat Keterangan Hilang dari Kepolisian (jika hilang) (Format portrait)',
            'jenis_pengaduan_id' => $pelayanan9->id
        ]);
        $syarat10 = JenisSyarat::create([
            'nama' => 'Photo Diri memegang dokumen *)',
            'jenis_pengaduan_id' => $pelayanan9->id
        ]);
    }
}
