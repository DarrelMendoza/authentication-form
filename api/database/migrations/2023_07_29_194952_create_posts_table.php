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
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); // Unique identifier for the post
            $table->string('title'); // The title of the post
            $table->text('message'); // The content of the post
            $table->string('type'); // Category of the post, can be either news, update or task
            $table->string('author_name'); // The name of the post's author
            $table->timestamps(); // Timestamps for when the post was created and last updated
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
