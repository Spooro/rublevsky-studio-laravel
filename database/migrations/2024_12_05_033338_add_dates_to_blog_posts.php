<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('featured_image');
            $table->timestamp('last_edited_at')->nullable()->after('published_at');
        });

        // Set published_at to created_at for existing posts
        DB::table('blog_posts')->whereNull('published_at')->update([
            'published_at' => DB::raw('created_at')
        ]);
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn(['published_at', 'last_edited_at']);
        });
    }
};
