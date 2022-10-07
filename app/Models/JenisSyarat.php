<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSyarat extends Model
{
    use HasFactory;

    protected $guarded = [];

    // protected $table = 'Jenis_Syarats';

    protected $fillable = ['jenis_pengaduan_id', 'nama'];

    public function jenisPengaduan()
    {
        return $this->belongsTo(JenisPengaduan::class);
    }
}
