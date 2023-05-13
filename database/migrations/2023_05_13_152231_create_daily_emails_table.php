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
        Schema::create('daily_emails', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateTime');
            $table->string('queueId');
            $table->string('from');
            $table->string('to');
            $table->text('subject');
            $table->text('statusText');
            $table->integer('statusCode');
            $table->string('statusName');
            $table->string('nonDeliveryNotificationId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_emails');
    }
};
