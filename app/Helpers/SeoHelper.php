<?php

namespace App\Helpers;

class SeoHelper
{
    // ================================
    //  GENERATE SEO TITLE
    // ================================
    public static function seoTitle($title, $brand = 'Geo Santara', $limit = 60)
    {
        $title = trim($title);

        $stopWords = [
            'yang',
            'untuk',
            'dengan',
            'dan',
            'serta',
            'agar',
            'pada',
            'dalam',
            'atau',
            'para',
            'adalah',
            'dari',
            'di',
            'ke',
            'melalui',
            'guna',
            'oleh',
            'kami',
            'kita'
        ];

        $words = explode(' ', strtolower($title));
        $filtered = array_filter($words, fn($w) => !in_array($w, $stopWords) && strlen($w) > 2);

        $important = array_slice(array_values($filtered), 0, 6);
        $important = array_map('ucfirst', $important);

        $short = implode(' ', $important);
        if (strlen($short) < 5) $short = $title;

        if (strlen($short) > $limit) {
            $short = substr($short, 0, $limit);
            $lastSpace = strrpos($short, ' ');
            if ($lastSpace !== false) {
                $short = substr($short, 0, $lastSpace);
            }
        }

        return $short . " | " . $brand;
    }

    // ================================
    //  GENERATE META DESCRIPTION
    // ================================
    public static function metaDescription($content, $limit = 155)
    {
        $text = strip_tags($content);
        $text = preg_replace('/\s+/', ' ', $text);

        return strlen($text) > $limit
            ? substr($text, 0, $limit) . "..."
            : $text;
    }

    // ================================
    //  MAIN SEO META GENERATOR
    // ================================
    public static function meta($article)
    {
        $title = self::seoTitle($article->title);
        $description = self::metaDescription($article->content);
        $url = url()->current();

        $image = $article->thumbnail
            ? asset('storage/' . $article->thumbnail)
            : asset('visitor/img/default.jpg');

        $published = $article->created_at->toIso8601String();
        $updated   = $article->updated_at->toIso8601String();

        // JSON-LD (lebih aman pakai json_encode)
        $jsonLd = [
            "@context" => "https://schema.org",
            "@type" => "Article",
            "headline" => $article->title,
            "description" => $description,
            "image" => $image,
            "author" => [
                "@type" => "Person",
                "name" => $article->author ?? "Admin"
            ],
            "publisher" => [
                "@type" => "Organization",
                "name" => "Geo Santara",
                "logo" => [
                    "@type" => "ImageObject",
                    "url" => "YOUR_LOGO_URL"
                ]
            ],
            "datePublished" => $published,
            "dateModified" => $updated,
            "mainEntityOfPage" => $url
        ];

        $jsonLd = json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        // ======== RETURN FINAL HTML ========
        return "
<title>{$title}</title>
<meta name=\"description\" content=\"{$description}\">
<link rel=\"canonical\" href=\"{$url}\">

<meta property=\"og:title\" content=\"{$title}\">
<meta property=\"og:description\" content=\"{$description}\">
<meta property=\"og:type\" content=\"article\">
<meta property=\"og:url\" content=\"{$url}\">
<meta property=\"og:image\" content=\"{$image}\">
<meta property=\"og:site_name\" content=\"Geo Santara\">

<meta name=\"twitter:card\" content=\"summary_large_image\">
<meta name=\"twitter:title\" content=\"{$title}\">
<meta name=\"twitter:description\" content=\"{$description}\">
<meta name=\"twitter:image\" content=\"{$image}\">

<script type=\"application/ld+json\">
{$jsonLd}
</script>
";
    }
}
