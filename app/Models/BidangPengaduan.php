<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidangPengaduan extends Model
{
    use HasFactory;

    // protected $table = 'Bidang_Pengaduans';

    protected $fillable = ['name', 'id'];

    protected $guarded = [];

    public function jenisPengaduan()
    {
        return $this->hasMany(JenisPengaduan::class);
    }

    public function subBidang()
    {
        return $this->belongsTo(SubBidang::class);
    }
}
