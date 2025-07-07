<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk;

class Pengaduan extends Model
{
    use HasFactory;
    public $table = 'pengaduans';
    protected $guarded = [];
    public function pend()
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }
}
