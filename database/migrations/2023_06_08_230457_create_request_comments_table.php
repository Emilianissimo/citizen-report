<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_comments', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('request_id')->nullable();
            $table->foreign('request_id')->references('id')->on('social_requests');
            $table->timestamps();
        });

        DB::table('request_comments')->insert(
            array(
                'text' => 'много че можно написать',
                'user_id' => 1,
                'request_id' => 1,
            )
        );

        DB::table('request_comments')->insert(
            array(
                'text' => 'много че можно написать 2',
                'user_id' => 1,
                'request_id' => 1,
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
        Schema::dropIfExists('request_comments');
    }
}
