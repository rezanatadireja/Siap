<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBidang extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = ['nama', 'id'];

    public function jenisPengaduan()
    {
        return $this->hasOne(JenisPengaduan::class);
    }
}
