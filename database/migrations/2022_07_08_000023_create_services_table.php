<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->longText('address');
            $table->string('type')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
