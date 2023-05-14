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
        Schema::create('current_emails', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dateTime');
            $table->string('queueId');
            $table->string('from')->nullable();;
            $table->string('to')->nullable();;
            $table->text('subject')->nullable();;
            $table->text('statusText');
            $table->integer('statusCode');
            $table->string('statusName');
            $table->string('nonDeliveryNotificationId')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('current_emails');
    }
};
