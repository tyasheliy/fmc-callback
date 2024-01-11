<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('nominal');
            $table->float('value');
            $table->uuid('update_id');
            $table->foreign('update_id')
                  ->references('id')
                  ->on('updates')
                  ->cascadeOnDelete();
            $table->string('currency_id');
            $table->foreign('currency_id')
                  ->references('id')
                  ->on('currencies')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
