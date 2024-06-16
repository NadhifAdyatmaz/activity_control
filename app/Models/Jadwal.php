<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $primarykey= 'id';
    protected $fillable= [
        'id', 'hari', 'periode_id', 'kelas_id', 'jampel_id', 'mapel_id', 'user_id'
    ];
    public $timestamps = false;


    public function periodes()
    {
        return $this->belongsTo(Periode::class,'periode_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
    public function jampels()
    {
        return $this->belongsTo(Jampel::class,'jampel_id');
    }
    public function mapels()
    {
        return $this->belongsTo(Mapel::class,'mapel_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
