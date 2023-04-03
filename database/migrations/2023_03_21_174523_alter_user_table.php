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
            $table->string('hometown')->nullable();
            $table->text('introduction')->nullable();
            $table->string('photo_url')->nullable();
            $table->date('birthday')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('github')->nullable();
            $table->string('discord')->nullable();
            $table->string('youtube')->nullable();
            $table->string('team_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'password',
                'email',
                'hometown',
                'introduction',
                'photo_url',
                'birthday',
                'instagram',
                'facebook',
                'snapchat',
                'twitter',
                'tiktok',
                'linkedin',
                'github',
                'discord',
                'youtube',
                'team_name',
            ]);
        });
    }
};
