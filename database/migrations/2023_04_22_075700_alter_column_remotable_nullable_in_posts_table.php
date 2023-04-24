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
        if (Schema::hasColumn('posts', 'remotable')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('remotable')->nullable()->change();
            });
        }
        if (Schema::hasColumn('posts', 'company_id')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->unsignedBigInteger('company_id')->nullable()->change();
            });
        }
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('is_parttime')->default(0)->change();
            $table->integer('remotable')->change();
        });
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('is_parttime', 'can_parttime');
        });
        if (Schema::hasColumn('posts', 'city')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('city')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
