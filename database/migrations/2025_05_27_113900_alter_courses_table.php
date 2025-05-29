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
         Schema::table('courses', function (Blueprint $table) {
            
            $table->foreignId('trainer_id')->constrained()->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('courses', function (Blueprint $table) {
        $table->dropForeign(['trainer_id']);
        $table->dropColumn('trainer_id');
    });
}
};
