<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    protected $table = 'mapels';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','status'];
    public $timestamps = false;

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class,'id','mapel_id');
    }
}
