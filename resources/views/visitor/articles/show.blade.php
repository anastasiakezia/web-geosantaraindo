@extends('layouts.visitor')

@php
    $from = $from ?? (isset($isCsr) && $isCsr ? 'csr' : 'articles');
@endphp

@section('content')
    <style>
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
            color: #1e293b;
        }

        /* ====== KONTEN ARTIKEL UTAMA  ====== */
        .article-full {
            background: #fff;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
        }

        .article-full h1 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: .25rem;
            line-height: 1.3;
        }

        .article-meta {
            font-size: 0.9rem;
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .service-label-main {
            background: linear-gradient(135deg, #0d6efd, #4e9cff);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 20px;
            padding: 4px 12px;
            display: inline-block;
            margin-bottom: 1rem;
        }

        .article-thumbnail {
            width: 100%;
            max-height: 480px;
            overflow: hidden;
            border-radius: 16px;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .article-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        .article-thumbnail img:hover {
            transform: scale(1.05);
        }

        .content img {
            max-width: 100% !important;
            height: auto !important;
            display: inline-block;
            margin: 1rem auto;
            border-radius: 8px;
        }

        .content img[style*="float:left"],
        .content img[style*="float: left"] {
            margin: 0.5rem 1rem 1rem 0;
        }

        .content img[style*="float:right"],
        .content img[style*="float: right"] {
            margin: 0.5rem 0 1rem 1rem;
        }

        .content p {
            font-size: 1.05rem;
            line-height: 1.75;
            text-align: justify;
            margin-bottom: 1rem;
            color: #374151;
        }

        :root {
            --primary-color: #0d6efd;
            --dark-color: #1e293b;
            --secondary-text: #64748b;
            --card-bg: #ffffff;
            --border-color: #eef2f7;
        }

        .sidebar {
            background: var(--card-bg);
            border-radius: 16px;
            padding: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
            padding-bottom: 0.75rem;
            border-bottom: 2px solid var(--primary-color);
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .sidebar-item.recent-posts .post-item {
            display: flex;
            align-items: flex-start;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-item.recent-posts .post-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .sidebar-item.recent-posts img {
            width: 80px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .sidebar-item.recent-posts h4 {
            margin-bottom: 0.25rem;
        }

        .sidebar-item.recent-posts h4 a {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--dark-color);
            text-decoration: none;
            line-height: 1.4;
        }

        .sidebar-item.recent-posts h4 a:hover {
            color: var(--primary-color);
        }

        .sidebar-item.recent-posts time {
            font-size: 0.8rem;
            color: var(--secondary-text);
        }

        .service-label {
            background: linear-gradient(135deg, var(--primary-color), #4e9cff);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 50px;
            padding: 4px 10px;
            display: inline-block;
            margin-top: 6px;
        }

        @media (max-width: 2560px) {

            /* Target gambar yang diberi style width: 25% oleh teks editor */
            .content img[style*="width: 25%"] {
                width: 40% !important;
                max-width: 450px !important;
                margin: 1.5rem auto !important;
                display: block !important;
                height: auto !important;
            }
        }

        @media (max-width: 1024px) {

            /* Target gambar yang diberi style width: 25% oleh teks editor */
            .content img[style*="width: 25%"] {
                width: 60% !important;
                max-width: 450px !important;
                margin: 1.5rem auto !important;
                display: block !important;
                height: auto !important;
            }
        }

        @media (max-width: 900px) {

            /* Target gambar yang diberi style width: 25% oleh teks editor */
            .content img[style*="width: 25%"] {
                width: 50% !important;
                max-width: 450px !important;
                margin: 1.5rem auto !important;
                display: block !important;
                height: auto !important;
            }
        }

        @media (max-width: 767px) {

            /* Target gambar yang diberi style width: 25% oleh teks editor */
            .content img[style*="width: 25%"] {
                width: 100% !important;
                max-width: 450px !important;
                margin: 1.5rem auto !important;
                display: block !important;
                height: auto !important;
            }
        }
    </style>

    <main id="main" class="container py-5">
        <div class="row">
            {{-- Artikel Utama  --}}
            <div class="col-lg-8">
                <div class="article-full">
                    @if ($article->thumbnail)
                        <div class="article-thumbnail">
                            <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}">
                        </div>
                    @endif

                    <h1>{{ $article->title }}</h1>
                    <div class="article-meta">
                        ✍️ {{ $article->author ?? 'Admin' }} |
                        📅 {{ $article->created_at->format('d M Y') }}
                    </div>

                    @if (!empty($article->service?->name))
                        <span class="service-label-main">
                            <i class="bi bi-gear-fill"></i> {{ $article->service->name }}
                        </span>
                    @endif

                    <div class="content">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                <div class="sidebar">
                    <h3 class="sidebar-title">Popular Posts</h3>
                    <div class="sidebar-item recent-posts">
                        @forelse ($popularPosts ?? [] as $post)
                            <div class="post-item">
                                <a href="{{ route('visitor.articles.show', ['slug' => $post->slug, 'from' => $from]) }}">
                                    <img src="{{ $post->getFirstImage() ?? asset('visitor/img/default.jpg') }}"
                                        alt="{{ $post->title }}">
                                </a>
                                <div>
                                    <h4> <a
                                            href="{{ route('visitor.articles.show', ['slug' => $post->slug, 'from' => $from]) }}">
                                            {{ Str::limit($post->title, 50) }}
                                        </a>
                                    </h4>

                                    @if (!empty($post->service?->name))
                                        <span class="service-label">{{ $post->service->name }}</span>
                                    @endif

                                    <time datetime="{{ $post->created_at }}" style="display: block; margin-top: 6px;">
                                        {{ $post->created_at->format('d M Y') }}
                                    </time>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No popular posts available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
