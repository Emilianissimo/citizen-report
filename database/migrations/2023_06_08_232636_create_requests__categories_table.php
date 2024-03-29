<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests__categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('request_id')->nullable();
            $table->foreign('request_id')->references('id')->on('social_requests');
            $table->timestamps();
        });

        DB::table('requests__categories')->insert(
            array(
                'category_id' => 1,
                'request_id' => 1,
            )
        );
        DB::table('requests__categories')->insert(
            array(
                'category_id' => 1,
                'request_id' => 2,
            )
        );
        DB::table('requests__categories')->insert(
            array(
                'category_id' => 1,
                'request_id' => 3,
            )
        );
        DB::table('requests__categories')->insert(
            array(
                'category_id' => 1,
                'request_id' => 4,
            )
        );
        DB::table('requests__categories')->insert(
            array(
                'category_id' => 2,
                'request_id' => 2,
            )
        );
        DB::table('requests__categories')->insert(
            array(
                'category_id' => 2,
                'request_id' => 5,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests__categories');
    }
}
