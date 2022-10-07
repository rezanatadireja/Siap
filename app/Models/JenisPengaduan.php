<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPengaduan extends Model
{
    use HasFactory;

    // protected $table = 'Jenis_Pengaduans';

    protected $guarded = [];

    protected $fillable = ['bidang_pengaduan_id', 'sub_bidang_id', 'nama', 'kuota', 'id'];

    public function bidangPengaduan()
    {
        return $this->belongsTo(BidangPengaduan::class);
    }

    public function subBidang()
    {
        return $this->belongsTo(SubBidang::class);
    }

    public function jenisSyarat()
    {
        return $this->hasMany(JenisSyarat::class);
    }

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
        // return $this->belongsToMany(Pengaduan::class);
    }
}
