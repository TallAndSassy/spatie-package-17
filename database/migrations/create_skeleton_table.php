<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkeletonTable extends Migration
{
    public function up()
    {
        Schema::create('skeleton', function (Blueprint $table) {
            $table->bigIncrements('id');

            // add fields
            $table->string('name')->comment("Name of Guy");//

            $table->timestamps();
        });
    }
}
