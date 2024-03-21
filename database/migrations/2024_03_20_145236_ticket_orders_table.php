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
        Schema::create('ticket_orders', function(Blueprint $table){
            $table->id();
            $table->string('pay_info',800);
            $table->string('pay_info_path',800);
            $table->string('buyer_name',255);
            $table->string('buyer_lastname',255);
            $table->string('buyer_dni',255);
            $table->integer('ticket_ammount');
            $table->foreignId('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket_orders');
    }
};
