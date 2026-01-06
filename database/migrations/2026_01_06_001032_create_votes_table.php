<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_votes_table.php
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();

            // Standard foreign keys (looks for 'id' on users and posts tables)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');

            $table->enum('type', ['upvote', 'downvote']);
            $table->timestamps();

            // Unique constraint: One vote per user per post
            $table->unique(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
