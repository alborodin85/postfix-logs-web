<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archive_list', function (Blueprint $table) {
            $table->id();
            $table->string('lastArchiveFileName');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archive_list');
    }
};
