<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSplitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('splits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id');
            $table->unsignedBigInteger('from_member_id')->default(0);
            $table->unsignedBigInteger('to_member_id')->default(0);
            $table->float('amount',10,2)->default(0);
            $table->foreign('from_member_id')->references('id')->on('members');
            $table->foreign('to_member_id')->references('id')->on('members');
            $table->foreign('expense_id')->references('id')->on('expenses');
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
        Schema::dropIfExists('splits');
    }
}
