<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanImage extends Model
{
    protected $guarded = ['id'];
    use HasFactory;
    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }
}
