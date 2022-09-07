<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            

            // transaction status
            $table->enum('status', [
                "delivered",
                "In Transit",
                "verified",
                "unverified"
            ] )->default("unverified");

            // sender fields to fill
            $table->enum('service_type', [
                "door to door",
                "office collection",
                "rush",
                "city delivery",
                "city pickup"

            ]);

            $table->integer("customer_id");

            $table->string("receiver_name");

            $table->string("receiver_phone");

            $table->enum("whatsapp_status", [
                "online",
                "offline"
            ])->default("offline");

            $table->enum("fragile", [
                "yes",
                "no"
            ])->default("no");

            $table->enum("electronics", [
                "yes",
                "no"
            ])->default("no");

            $table->text("location");

            $table->string("district");

            // office us
            $table->string("waybill_number")->nullable();
            $table->integer("amount")->nullable();
            $table->string("payment_term");


            $table->timestamps();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}