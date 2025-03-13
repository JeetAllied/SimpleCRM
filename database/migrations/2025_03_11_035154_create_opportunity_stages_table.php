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
        Schema::create('opportunity_stages', function (Blueprint $table) {
            $table->id();
            $table->string('opportunity_stage_name');
            $table->timestamps();
            $table->tinyInteger('status')->comment('0 = inactive, 1 = active')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunity_stages');
    }
};
