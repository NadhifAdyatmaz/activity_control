<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    protected $table = 'jurnals';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'jadwal_id',
        'name',
        'tanggal_jurnal',
        'materi',
        'sakit',
        'izin',
        'alpha',
        'foto',
        'ttd',
        'catatan',
        'is_validation',
        'updated_at',
    ];
    public $timestamps = false;

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'jadwal_id');
    }



}
