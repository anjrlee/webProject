<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticle()
    {
        $article = Article::all();
        return response()->json($article);
    }

    public function getArticle($id)
    {
        $article = Article::with('links')->find($id);

        if (!$article) {
            return response()->json(['message' => 'Article not found'], 404);
        }

        // If the article has no links, remove the 'links' key from the response
        if ($article->links->isEmpty()) {
            unset($article->links);
        }

        return response()->json($article);
    }
}
