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
            $table->id(); // This is a single auto-incrementing primary key
            $table->bigInteger('user_id')->unsigned(); // This is a foreign key, not a primary key
            $table->enum('transactions_type', ['DIPOSIT', 'WITHDRAWAL'])->notNull();
            $table->double('amount', 10, 3)->notNull();
            $table->decimal('fee', 10, 3)->nullable();
            $table->timestamps();
            
            // Define a foreign key constraint
            $table->foreign('user_id')->references('id')->on('users');
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
