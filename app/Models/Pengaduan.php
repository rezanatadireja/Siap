<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\{User,Penduduk,PengaduanSyarat,JenisPengaduan};

class Pengaduan extends Model
{
    use HasFactory;
    use Notifiable;

    // protected $guard = 'Pengaduan';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penduduk()
    {
        return $this->hasManyThrough(Penduduk::class, User::class);
    }

    public function jenisPengaduan()
    {
        return $this->belongsTo(JenisPengaduan::class);
    }
    
    public function subBidang()
    {
        return $this->belongsTo(SubBidang::class);
    }

    public function syarat()
    {
        return $this->belongsTo(Syarat::class);
    }
}
