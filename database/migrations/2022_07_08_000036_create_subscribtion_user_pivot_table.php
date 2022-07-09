<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribtionUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('subscribtion_user', function (Blueprint $table) {
            $table->unsignedBigInteger('subscribtion_id');
            $table->foreign('subscribtion_id', 'subscribtion_id_fk_6950246')->references('id')->on('subscribtions')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_6950246')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
