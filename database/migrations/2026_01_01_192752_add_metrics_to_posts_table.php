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
        Schema::table('posts', function (Blueprint $table) {
            // We place these after the 'body' column for cleaner database organization
            $table->unsignedInteger('views')->default(0)->after('body');
            $table->unsignedInteger('upvotes')->default(0)->after('views');
            $table->unsignedInteger('downvotes')->default(0)->after('upvotes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['views', 'upvotes', 'downvotes']);
        });
    }
};