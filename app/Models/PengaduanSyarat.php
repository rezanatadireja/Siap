<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pengaduan;

class PengaduanSyarat extends Model
{
    use HasFactory;

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
