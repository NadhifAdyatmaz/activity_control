<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jampel extends Model
{
    use HasFactory;
    protected $table = 'jampels';
    protected $primaryKey = 'id';
    protected $fillable = ['id','jam_ke','pukul'];
    public $timestamps = false;
    
    public function jadwals()
    {
        return $this->hasMany(Jadwal::class,'id','jampel_id');
    }
}
