<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['user_id']);
            $table->dropForeign(['location_id']);
        });
    }
};
