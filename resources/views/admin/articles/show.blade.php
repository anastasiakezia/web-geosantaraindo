@extends('layouts.admin')


@section('title', 'Article Detail')

@push('styles')
    <style>
        .card-header {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 1rem;
        }

        .card-header h4 {
            margin: 0;
            padding-left: 1.5rem;
            word-break: break-word;
        }

        .btn-back {
            margin-left: auto;
        }

        .badge {
            font-size: 0.85rem;
            padding: 0.3em 0.6em;
            border-radius: 0.5rem;
        }

        .card-body>.mb-3,
        .card-body>.row,
        .article-content {
            padding-left: 1.5rem;
        }

        .card-body .row>div {
            padding-left: 0.75rem;
        }

        .article-content img {
            max-width: 100%;
            border-radius: 8px;
            margin: 1rem 0;
        }

        .article-content p {
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .article-content h1,
        .article-content h2,
        .article-content h3,
        .article-content h4 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .article-content ul,
        .article-content ol {
            margin: 1rem 0 1rem 1.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="card shadow-sm rounded-3 border-0">
        <!-- Header -->
        <div class="card-header bg-white">
            <h4 class="fw-bold text-primary mb-0">{{ $article->title }}</h4>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-secondary shadow-sm btn-back">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>

        <!-- Body -->
        <div class="card-body">
            <!-- Type -->
            <div class="mb-3">
                @php
                    $typeColors = [
                        'article' => 'primary',
                        'csr' => 'success',
                        'news' => 'info',
                    ];
                @endphp
                <span class="badge bg-{{ $typeColors[$article->type] ?? 'secondary' }}">
                    {{ ucfirst($article->type) }}
                </span>
            </div>

            <!-- Thumbnail -->
            @if ($article->image)
                <div class="mb-4 text-center">
                    <img src="{{ asset('storage/' . $article->image) }}" class="img-fluid rounded shadow-sm"
                        alt="{{ $article->title }}">
                </div>
            @endif

            <!-- Info Grid -->
            <div class="row mb-4">
                <div class="col-md-6 mb-2">
                    <small class="text-muted d-block">Service</small>
                    <span class="fw-semibold">{{ $article->service->name ?? '-' }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted d-block">Author</small>
                    <span class="fw-semibold">{{ $article->author ?? 'Admin' }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted d-block">Created At</small>
                    <span class="fw-semibold">{{ $article->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="col-md-6 mb-2">
                    <small class="text-muted d-block">Updated At</small>
                    <span class="fw-semibold">{{ $article->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>

            <!-- Content -->
            <div class="article-content">
                {!! $article->content !!}
            </div>
        </div>

        <!-- Footer -->
        <div class="card-footer bg-white d-flex justify-content-end gap-2">
            <a href="{{ route('admin.articles.edit', $article) }}" class="btn btn-warning btn-sm">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                onsubmit="return confirm('Delete this article?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endsection
