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
            $table->uuid('eid')->unique();
            $table->index('eid');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->uuid('eid')->unique();
            $table->index('eid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['eid']);
            $table->dropColumn('eid');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropIndex(['eid']);
            $table->dropColumn('eid');
        });
    }
};
