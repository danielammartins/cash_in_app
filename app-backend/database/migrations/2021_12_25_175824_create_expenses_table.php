<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //FIXME can't change name of ID parameter without crashing
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->integer('value')->unsigned();
            $table->date('date');
            $table->string('receipt_path')->nullable();
            $table->integer('IDU')->unsigned()->nullable();
            $table->integer('IDC')->unsigned()->nullable();
        });

        // SQLite cannot both add the columns and the FKs at the same time, therefore it must be broken into 2 Schema blocks
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreign('IDU')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('IDC')->references('id')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->primary('id');      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenses');
    }
}
