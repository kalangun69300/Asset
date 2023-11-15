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
        Schema::create('asset_examines', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id');
            $table->string('user_id');
            $table->string('asset_pass')->nullable();
            $table->string('examine_status')->default('N');
            $table->text('asset_problem')->nullable();
            $table->string('draft')->default('N');
            $table->timestamps();
            $table->string('deleted_at')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_examines');
    }
};
