<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['artikel', 'csr'])->default('artikel')->after('id');
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->string('image_path')->nullable();
            $table->string('author')->nullable();
            $table->timestamp('schedule_date')->nullable();
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
