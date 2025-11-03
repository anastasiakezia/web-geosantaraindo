<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Article;
use Carbon\Carbon;

class PublishScheduledArticlesTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_publishes_inactive_articles_when_schedule_date_has_passed()
    {
        $article = Article::factory()->create([
            'status' => 'inactive',
            'schedule_date' => Carbon::now()->subHour(),
        ]);

        $this->artisan('articles:publish-scheduled')
            ->expectsOutput('1 artikel berhasil dipublish.')
            ->assertExitCode(0);

        $this->assertEquals('active', $article->fresh()->status);
    }

    public function test_it_does_not_publish_inactive_articles_if_schedule_date_not_reached()
    {
        $article = Article::factory()->create([
            'status' => 'inactive',
            'schedule_date' => Carbon::now()->addHour(),
        ]);

        $this->artisan('articles:publish-scheduled')
            ->expectsOutput('0 artikel berhasil dipublish.')
            ->assertExitCode(0);

        $this->assertEquals('inactive', $article->fresh()->status);
    }

    public function test_it_does_nothing_for_draft_or_active_articles()
    {
        Article::factory()->create(['status' => 'draft']);
        Article::factory()->create(['status' => 'active']);

        $this->artisan('articles:publish-scheduled')
            ->expectsOutput('0 artikel berhasil dipublish.')
            ->assertExitCode(0);

        $this->assertDatabaseCount('articles', 2);
    }
}
