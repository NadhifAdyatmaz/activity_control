<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;
    protected $table = 'information';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','sekolah','email','pertemuan','phone','logo'];

    public $timestamps = false;
}
