<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->string('description', 500)->nullable();
            $table->index('name');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->string('description', 1000)->change();
            $table->index('title');
            $table->index('featured');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->index('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropColumn('description');
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->text('description')->change();
            $table->dropIndex(['title']);
            $table->dropIndex(['featured']);
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropIndex(['name']);
        });
    }
};
