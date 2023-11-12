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
    {   if(!Schema::hasTable('borrow_requests'))
        {
            Schema::create('borrow_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('create_by');
            $table->date('borrow_date');
            $table->date('return_date');
            $table->unsignedBigInteger('asset');
            $table->foreign('asset')->references('id')->on('assets');
            $table->integer('quantity');
            $table->text('description')->nullable();
            $table->string('status')->default('รอการอนุมัติ');
            $table->timestamps();
            });
         }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow_requests', function (Blueprint $table) {
        });
    }
};
