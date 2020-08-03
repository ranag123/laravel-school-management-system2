<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class_id')->nullable();
            $table->string('student_id')->nullable();
//            $table->string('title')->nullable();
            $table->integer('user_id')->nullable();
//            $table->text('description')->nullable();
            $table->string('date')->nullable();
            $table->string('payment')->nullable();
//            $table->string('status')->nullable();
            $table->string('method')->nullable();
            $table->string('amount')->nullable();
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
        Schema::dropIfExists('vouchers');
    }
}
