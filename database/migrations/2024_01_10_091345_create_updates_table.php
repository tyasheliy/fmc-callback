<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('updates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('created');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('updates');
    }
};
