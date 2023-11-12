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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_code');
            $table->string('asset_name');
            $table->integer('asset_amount');
            $table->string('asset_brand');
            $table->string('asset_type');
            $table->integer('asset_price');
            $table->string('asset_recieve');
            $table->string('asset_giver')->nullable();
            $table->date('recieve_date');
            $table->date('cancel_date')->nullable();
            $table->string('asset_status');
            $table->string('asset_image');
            $table->boolean('asset_pass')->default(false); // เก็บข้อมูลจาก checkbox
            $table->string('asset_problem')->nullable(); // เก็บข้อมูลจาก textbox
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
