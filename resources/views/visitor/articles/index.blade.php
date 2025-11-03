@extends('layouts.visitor')

@section('title', isset($isCsr) && $isCsr ? 'CSR' : 'Project Kami')

@section('content')
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #475569;
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

        /* ====== HEADER BARU (TANPA BACKGROUND, MINIMALIS) ====== */
        .section-header-minimal {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
            padding: 1.5rem 0;
            margin-bottom: 2rem;
            border-bottom: 2px solid #eef2f7;
        }

        .section-header-minimal h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
            line-height: 1.2;
        }

        .section-header-minimal .breadcrumbs {
            display: flex;
            gap: 0.5rem;
            font-size: 0.9rem;
            align-items: center;
        }

        .section-header-minimal .breadcrumbs a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.3s;
        }

        .section-header-minimal .breadcrumbs a:hover {
            color: #0d6efd;
        }

        .section-header-minimal .breadcrumbs span {
            color: #1e293b;
        }

        .section-header-minimal .breadcrumbs .separator {
            color: #64748b;
        }

        /* ====== Card Artikel Utama ====== */
        .entry.card {
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #eef2f7;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 2.5rem;
            background: #ffffff;
            transition: all 0.35s ease;
            display: flex;
            flex-direction: column;
        }

        .entry.card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .entry-img {
            position: relative;
            overflow: hidden;
            width: 100%;
        }

        .entry-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .entry.card .card-body {
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            width: 100%;
            flex-grow: 1;
        }

        @media (min-width: 768px) {
            .entry.card {
                flex-direction: row;
                max-height: 280px;
            }

            .entry-img {
                flex: 0 0 40%;
            }

            .entry.card .card-body {
                flex: 1 1 60%;
            }
        }

        .entry.card:hover .entry-img img {
            transform: scale(1.05);
        }

        .badge-jenis-layanan {
            position: absolute;
            top: 16px;
            left: 16px;
            z-index: 2;
            background: linear-gradient(135deg, #0d6efd, #4e9cff);
            color: #fff;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 50px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .entry-title {
            margin-bottom: 0.25rem;
        }

        .entry-title a {
            font-size: 1.2rem;
            text-decoration: none;
            color: #1e293b;
            transition: color 0.3s;
            line-height: 1.25;
        }

        .entry-title a:hover {
            color: #0d6efd;
        }

        .entry-meta {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 0.75rem;
        }

        .entry-content {
            font-size: 0.95rem;
            color: #475569;
            line-height: 1.6;
        }

        .entry-content p {
            font-family: 'Inter', sans-serif !important;
        }

        .btn-read-more {
            margin-top: auto;
            padding: 6px 14px;
            font-size: 0.85rem;
            font-weight: 600;
            background: #0d6efd;
            color: #fff !important;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            align-self: flex-start;
        }

        .btn-read-more:hover {
            background: #0b5ed7;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        /* ====== DESAIN SIDEBAR  ====== */
        .sidebar {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid #eef2f7;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .sidebar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #0d6efd;
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .sidebar-item.recent-posts .post-item {
            display: flex;
            align-items: center;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid #eef2f7;
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
            color: #1e293b;
            text-decoration: none;
            line-height: 1.4;
        }

        .sidebar-item.recent-posts h4 a:hover {
            color: #0d6efd;
        }

        .sidebar-item.recent-posts time {
            font-size: 0.8rem;
            color: #64748b;
        }

        .service-label {
            background: linear-gradient(135deg, #0d6efd, #4e9cff);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 50px;
            padding: 4px 10px;
            display: inline-block;
            margin-top: 6px;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                position: static !important;
            }

            main.container>.row {
                margin-bottom: 50px;
            }
        }

        div.flex.justify-between.items-center {
            display: flex !important;
            flex-direction: column-reverse !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 20px !important;
            margin-top: 50px !important;
            margin-bottom: 150px !important;
            width: 100% !important;
            text-align: center !important;
        }

        .pagination {
            margin-top: 10px !important;
            margin-bottom: 30px !important;
        }

        .page-item {
            margin: 0 4px !important;
        }

        @media (min-width: 992px) {
            div.flex.justify-between.items-center {
                gap: 25px !important;
                margin-top: 60px !important;
                margin-bottom: 60px !important;
            }
        }
    </style>

    <main id="main" class="container">
        {{-- SECTION HEADER --}}
        <div class="section-header-minimal">
            <h1>{{ isset($isCsr) && $isCsr ? 'Corporate Social Responsibility' : 'Project Terbaru' }}</h1>
        </div>

        <div class="row">

            {{-- Artikel Utama --}}
            <div class="col-lg-8 col-md-12 entries">
                @forelse ($articles as $article)
                    <article class="entry card">
                        <div class="entry-img">
                            <a
                                href="{{ route('visitor.articles.show', ['slug' => $article->slug, 'from' => request()->routeIs('visitor.articles.csr') ? 'csr' : 'articles']) }}">
                                <img src="{{ $article->getFirstImage() ?: asset('visitor/assets/img/default.jpeg') }}"
                                    alt="{{ $article->title }}">
                            </a>
                            @if (!empty($article->service?->name))
                                <span class="badge-jenis-layanan">
                                    <i class="bi bi-gear-fill"></i><span>{{ $article->service->name }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="entry-meta mb-2">
                                <span><i class="bi bi-person"></i> {{ $article->author ?? 'Admin' }}</span> |
                                <span><i class="bi bi-clock"></i> {{ $article->created_at->format('d M Y') }}</span>
                            </div>

                            <h2 class="entry-title">
                                <a
                                    href="{{ route('visitor.articles.show', ['slug' => $article->slug, 'from' => request()->routeIs('visitor.articles.csr') ? 'csr' : 'articles']) }}">
                                    {{ Str::limit(html_entity_decode(strip_tags($article->title)), 50) }}
                                </a>
                            </h2>

                            <div class="entry-content">
                                <p>
                                    @php
                                        $content = $article->description ?? $article->content;
                                        $contentWithSpaces = str_replace(['</p>', '<br>', '<br/>'], ' ', $content);
                                    @endphp
                                    {{ Str::limit(html_entity_decode(strip_tags($contentWithSpaces)), 100) }}
                                </p>
                            </div>

                            <a href="{{ route('visitor.articles.show', ['slug' => $article->slug, 'from' => request()->routeIs('visitor.articles.csr') ? 'csr' : 'articles']) }}"
                                class="btn-read-more">
                                Read More <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="alert alert-warning text-center">
                        Saat ini belum ada postingan di kategori ini.
                    </div>
                @endforelse

                <div class="pagination-wrapper">
                    {{ $articles->links() }}
                </div>
            </div>

            {{-- SIDEBAR --}}
            @php
                $from = isset($isCsr) && $isCsr ? 'csr' : 'articles';
            @endphp

            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
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
                                    <h4>
                                        <a
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
