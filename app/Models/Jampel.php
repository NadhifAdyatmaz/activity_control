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
}
