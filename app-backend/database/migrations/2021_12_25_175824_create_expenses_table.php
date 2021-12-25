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
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('IDE');
            $table->string('name');
            $table->string('slug');
            $table->integer('value')->unsigned();
            $table->date('date');
            $table->string('receipt_path');
            $table->timestamps();
            $table->integer('IDU')->unsigned()->nullable();
            $table->foreign('IDU')->references('IDU')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->integer('IDC')->unsigned()->nullable();
            $table->foreign('IDC')->references('IDC')->on('categories')->onUpdate('CASCADE')->onDelete('CASCADE');      
        });

        /*
        // SQLite cannot both add the collumns and the FKs at the same time, therefore it must be broken into 2 Schema blocks
          Schema::table('expenses', function (Blueprint $table) {
              
        });*/
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
