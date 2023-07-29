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
    {   Schema::disableForeignKeyConstraints();
        Schema::create('films', function (Blueprint $table) {
            
            $table->id();
            $table->boolean('adult');
            $table->string("backdrop_path");
            $table->bigInteger("film_id")->index(); 
            $table->string("title");
            $table->string("original_language");
            $table->string("original_title");
            $table->text("overview");
            $table->string("poster_path");
            $table->string("media_type");
            $table->float("popularity");
            $table->boolean('video');
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->boolean('trending_today')->default(false);
            $table->boolean('trending_in_week')->default(false); 
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
        
    }
};
