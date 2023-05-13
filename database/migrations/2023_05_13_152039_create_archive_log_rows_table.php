<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('archive_log_rows', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateTime');
            $table->string('hostName');
            $table->string('module');
            $table->integer('procId');
            $table->string('queueId')->nullable();
            $table->string('errorLevel')->nullable();
            $table->text('rowText')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('archive_log_rows');
    }
};
