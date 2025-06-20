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
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('location_id');
            $table->boolean('is_negotiable')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // REMOVE THESE LINES:
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('location_id')->references('id')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ads');
    }
};
