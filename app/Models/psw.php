<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class psw extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'psw';
    protected $fillable = ['user_id', 'password'];
}
