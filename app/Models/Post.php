<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable=[
        'type',
        'title',
        'recorder',
        'date',
        'proveFile',
        'awardSpeech',
        'cover',
        'recordScore'
    ];
}
