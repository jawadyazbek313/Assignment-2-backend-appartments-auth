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
        Schema::create('appartments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->char('country',60);
            $table->char('city',60);
            $table->char('name',60);
            $table->float('price_per_night');
            $table->float('stars');
            $table->foreignId('owner',60)->refers('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        function (Blueprint $table) {
            $table->dropForeign('appartments_user_id_foreign');
            $table->dropIndex('appartments_user_id_index');
            $table->dropColumn('owner');
        };
   
        Schema::dropIfExists('appartments');
    }
};
