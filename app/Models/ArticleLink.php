<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'link',
    ];

    // Define the inverse relationship with Article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
