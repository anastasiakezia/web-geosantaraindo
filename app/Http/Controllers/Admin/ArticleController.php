<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ArticleController extends Controller
{
    public function index()
    {
        return view('admin.articles.index');
    }

    public function create()
    {
        $services = Service::orderBy('name')->get();
        return view('admin.articles.create', compact('services'));
    }

    public function store(Request $request)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'type' => 'required|in:article,csr',
            'service_id' => function ($attribute, $value, $fail) use ($type) {
                if ($type === 'article' && empty($value)) {
                    $fail('Service wajib diisi jika tipe artikel.');
                }
            },
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:225',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['type'] = $type;

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function getData(Request $request)
    {
        $query = Article::with('service')->select('articles.*')->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('service', function ($row) {
                return $row->service ? e($row->service->name) : '-';
            })
            ->addColumn('type', function ($row) {
                if ($row->type === 'csr') {
                    return '<span class="badge bg-success text-white">CSR</span>';
                } else {
                    return '<span class="badge bg-primary text-white">ARTICLE</span>';
                }
            })
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('d M Y');
            })
            ->addColumn('actions', function ($row) {
                $editUrl = route('admin.articles.edit', $row->slug);
                $deleteUrl = route('admin.articles.destroy', $row->slug);

                return '
                    <button class="btn btn-info btn-sm text-white btn-preview" data-slug="' . $row->slug . '">
                        <i class="bi bi-eye"></i>
                    </button>
                    <a href="' . $editUrl . '" class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" class="d-inline delete-article-form">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="button" class="btn btn-danger btn-sm btn-delete">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                ';
            })
            ->rawColumns(['type', 'actions']) // ✅ hanya kolom yang perlu HTML
            ->make(true);
    }

    public function edit(Article $article)
    {
        $services = Service::orderBy('name')->get();
        return view('admin.articles.edit', compact('article', 'services'));
    }

    public function update(Request $request, Article $article)
    {
        $type = $request->input('type');

        $validated = $request->validate([
            'type' => 'required|in:article,csr',
            'service_id' => function ($attribute, $value, $fail) use ($type) {
                if ($type === 'article' && empty($value)) {
                    $fail('Service wajib diisi jika tipe artikel.');
                }
            },
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image_path' => 'nullable|string|max:255',
            'author' => 'nullable|string|max:225',
            'published_at' => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['type'] = $type;

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('articles', 'public');
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diupdate!');
    }

    public function destroy(Article $article)
    {
        if ($article->image_path) {
            Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus!');
    }

    public function show(Article $article)
    {
        $article->load('service');
        return view('admin.articles.show', compact('article'));
    }

    public function preview(Article $article)
    {
        return response()->json([
            'title' => $article->title,
            'content' => $article->content,
            'type' => $article->type,
            'service' => $article->service?->name,
            'author' => $article->author,
            'created_at' => $article->created_at->format('d M Y'),
            'image' => $article->image_path ? asset('storage/' . $article->image_path) : null,
        ]);
    }
}
