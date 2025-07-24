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
            $table->string('title'); // META-TEKNO
            $table->text('description')->nullable(); // Learning space for future education
            $table->string('image')->nullable(); // Path to image
            $table->string('model_path')->nullable(); // Path to 3D model (e.g., assets/3d/teknokrat.glb)
            $table->string('spatial_link')->nullable(); // Spatial.io link
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
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
