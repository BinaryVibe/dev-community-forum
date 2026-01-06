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
        Schema::table('users', function (Blueprint $table) {
            // We add the fields in reverse order of how we want them displayed
            // if we are using 'after' on the same column, or we chain them.
            
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->string('username')->unique()->after('last_name');
            
            // Optional: If you want to remove the default 'name' column 
            // since you are now using first/last names:
            // $table->dropColumn('name'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'username']);
            
            // If you dropped 'name' in the up() method, add it back here:
            // $table->string('name');
        });
    }
};