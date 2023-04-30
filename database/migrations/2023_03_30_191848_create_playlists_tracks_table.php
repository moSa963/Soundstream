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
        Schema::create('playlists_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId("track_id")->constrained()->cascadeOnDelete();
            $table->foreignId("playlist_id")->constrained()->cascadeOnDelete();
            $table->unique(["track_id", "playlist_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playlists_tracks');
    }
};
