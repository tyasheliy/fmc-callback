<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('num_code', 3)->unique();
            $table->string('char_code', 3)->unique();
            $table->string('name')->unique();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
