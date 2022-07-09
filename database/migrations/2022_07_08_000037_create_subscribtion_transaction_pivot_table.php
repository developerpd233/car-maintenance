<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribtionTransactionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('subscribtion_transaction', function (Blueprint $table) {
            $table->unsignedBigInteger('subscribtion_id');
            $table->foreign('subscribtion_id', 'subscribtion_id_fk_6950247')->references('id')->on('subscribtions')->onDelete('cascade');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id', 'transaction_id_fk_6950247')->references('id')->on('transactions')->onDelete('cascade');
        });
    }
}
