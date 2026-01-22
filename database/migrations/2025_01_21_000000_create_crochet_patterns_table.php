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
        Schema::create('crochet_patterns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['blankets', 'amigurumi', 'bags', 'wearables', 'home-decor'])->index();
            $table->enum('difficulty', ['beginner', 'intermediate', 'advanced'])->default('beginner');
            $table->integer('estimated_hours')->nullable();
            $table->string('pdf_file')->nullable(); // Path to stored PDF file
            $table->string('image_path')->nullable(); // Path to stored image file
            $table->integer('makers_saved')->default(0);
            $table->foreignId('author_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crochet_patterns');
    }
};
