<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Carbon\Carbon;

class PublishScheduledArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:publish-scheduled';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update artikel inactive menjadi active jika sudah lewat schedule_date';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        // Cari artikel yang inactive tapi sudah waktunya publish
        $articles = Article::where('status', 'inactive')
            ->whereNotNull('schedule_date')
            ->where('schedule_date', '<=', $now)
            ->get();

        foreach ($articles as $article) {
            $article->update([
                'status' => 'active'
            ]);
        }

        $this->info("{$articles->count()} artikel berhasil dipublish.");
    }
}
