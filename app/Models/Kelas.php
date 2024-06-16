<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','jumlah_siswa','status'];
    public $timestamps = false;

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class,'id','kelas_id');
    }
}
