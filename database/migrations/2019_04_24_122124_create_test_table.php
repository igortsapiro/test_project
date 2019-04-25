<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('string_field');
            $table->boolean('boolean_field');
            $table->decimal('decimal_field', 13, 3);
            $table->timestamp('timestamp_field');
        });

        //create fake data for test
        factory(\App\Test::class, \App\Test::ALL_TEST_FIELDS)->create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test');
    }
}
