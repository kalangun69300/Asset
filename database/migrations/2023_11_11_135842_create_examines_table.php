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
        Schema::create('examines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained(); // เชื่อมกับตาราง assets
            $table->boolean('asset_pass')->nullable();
            $table->string('asset_problem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examines');
    }
};
