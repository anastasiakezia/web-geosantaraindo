<?php

namespace App\Http\Controllers\Visitor;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Service;

class VisitorArticleController extends Controller
{
    public function index()
    {

        // Semua artikel
        $articles = Article::where('type', 'article')->latest()->paginate(10);

        // Popular posts (5 artikel terbaru)
        // Popular posts: filter HANYA untuk artikel
        $popularPosts = Article::where('type', 'article')
            ->latest()
            ->take(5)
            ->get();

        // Ambil kategori dari tabel services
        $categories = Service::all();

        $isCsr = false;

        return view('visitor.articles.index', compact('articles', 'popularPosts', 'categories', 'isCsr'));
    }

    public function csr()
    {
        $articles = Article::where('type', 'csr')->latest()->paginate(10);
        // Popular posts: filter HANYA untuk CSR
        $popularPosts = Article::where('type', 'csr')
            ->latest()
            ->take(5)
            ->get();

        $categories = collect();

        $isCsr = true;

        return view('visitor.articles.index', compact('articles', 'popularPosts', 'categories', 'isCsr'));
    }

    public function show(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Baca dari query string atau fallback ke type artikel
        $from = $request->query('from', $article->type);
        $isCsr = $from === 'csr';

        // Popular posts sesuai jenis
        $popularPosts = Article::where('type', $isCsr ? 'csr' : 'article')
            ->where('id', '!=', $article->id)
            ->take(5)
            ->get();

        return view('visitor.articles.show', compact('article', 'popularPosts', 'isCsr', 'from'));
    }
}
