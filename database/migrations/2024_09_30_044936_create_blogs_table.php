<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_published')->default(false);
            $table->foreignId('parent_id')->nullable()->constrained('blogs')
                ->onUpdate('cascade')->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->restrictOnDelete();
            $table->foreignId('category_id')
                ->constrained('blog_categories')
                ->onUpdate('cascade')
                ->restrictOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('sub_title')->nullable();
            $table->longText('summary')->nullable();
            $table->longText('description')->nullable();
            $table->json('files_field')->nullable();
            $table->json('others_field')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->boolean('is_commentable')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
