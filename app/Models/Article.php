<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';
    protected $fillable=[
        'title',
        'cover',
        'author',
        'type',
        'date',
        'MW',
        'content',
        'email',
    ];

    public function links()
    {
        return $this->hasMany(ArticleLink::class);
    }
}
