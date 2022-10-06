<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengaduan;

class Penduduk extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['nama', 'nik', 'no_kk', 'no_hp', 'district_id', 'village_id', 'user_id'];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class);
    }

    public function jenisPengaduan()
    {
        return $this->belongsTo(JenisPengaduan::class);
    }

    public function provinsi()
    {
        return $this->belongsTo('App\Models\Province');
    }

    public function kabupaten()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function kecamatan()
    {
        // return $this->belongsTo(Regency::class);
        return $this->belongsTo(District::class);
    }

    public function desa()
    {
        return $this->belongsTo('App\Models\Village');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
