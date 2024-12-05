<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BlogPost;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->json('images')->nullable()->after('featured_image');
        });

        // Convert existing featured_image to images array
        foreach (BlogPost::whereNotNull('featured_image')->get() as $post) {
            $post->images = [$post->featured_image];
            $post->save();
        }

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('featured_image');
        });
    }

    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            $table->string('featured_image')->nullable()->after('body');
        });

        // Convert first image back to featured_image
        foreach (BlogPost::whereNotNull('images')->get() as $post) {
            $images = $post->images;
            if (!empty($images)) {
                $post->featured_image = $images[0];
                $post->save();
            }
        }

        Schema::table('blog_posts', function (Blueprint $table) {
            $table->dropColumn('images');
        });
    }
};
