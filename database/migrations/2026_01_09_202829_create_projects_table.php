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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['web', 'mobile', 'desktop']);
            $table->string('year', 4);
            $table->string('color')->default('blue');
            
            // Champs pour projets Web
            $table->string('company')->nullable();
            $table->string('logo_url')->nullable();
            $table->string('site_url')->nullable();
            
            // Champs pour projets Mobile
            $table->string('ios_url')->nullable();
            $table->string('android_url')->nullable();
            
            // Champs pour projets Desktop (images stockées en JSON)
            $table->json('screenshots')->nullable();
            
            // Image principale pour tous les types
            $table->string('main_image')->nullable();
            
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
