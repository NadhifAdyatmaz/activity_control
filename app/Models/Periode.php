<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periodes';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','semester','status'];

    public $timestamps = false;

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class,'id','periode_id');
    }
}
