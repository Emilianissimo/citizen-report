<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_requests', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('text');
            $table->text('coordinates')->default('Tashkent');
            $table->text('address');
            $table->integer('urgency')->default(0); # 0 - low, 1 - normal, 2 - high, 3 - urgent
            $table->text('report_from_manager')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('request_statuses');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on('users');
            $table->unsignedBigInteger('manager_id')->nullable();
            $table->foreign('manager_id')->references('id')->on('users');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')->references('id')->on('regions');
            $table->timestamps();
        });

        DB::table('social_requests')->insert(
            array(
                'title' => 'Вымогают деньги 1',
                'slug' => 'money_1',
                'text' => 'много че можно написать',
                'coordinates' => '34.2971631,69.2815243',
                'address' => 'fake',
                'urgency' => 0,
                'status_id' => 1,
                'author_id' => 1,
                'region_id' => 1,
                'created_at' => '2023-12-12T12:12:12'
            )
        );

        DB::table('social_requests')->insert(
            array(
                'title' => 'Вымогают деньги 2',
                'slug' => 'money_2',
                'text' => 'много че можно написать',
                'coordinates' => '35.2971631,69.2815243',
                'address' => 'fake',
                'urgency' => 1,
                'status_id' => 1,
                'author_id' => 1,
                'region_id' => 1,
                'created_at' => '2023-12-12T12:12:12'
            )
        );

        DB::table('social_requests')->insert(
            array(
                'title' => 'Вымогают деньги 3',
                'slug' => 'money_3',
                'text' => 'много че можно написать',
                'coordinates' => '36.2971631,69.2815243',
                'address' => 'fake',
                'urgency' => 2,
                'status_id' => 1,
                'author_id' => 1,
                'region_id' => 2,
                'created_at' => '2023-12-12T12:12:12'
            )
        );

        DB::table('social_requests')->insert(
            array(
                'title' => 'Вымогают деньги 4',
                'slug' => 'money_4',
                'text' => 'много че можно написать',
                'coordinates' => '33.2971631,69.2815243',
                'address' => 'fake',
                'urgency' => 3,
                'status_id' => 4,
                'author_id' => 1,
                'region_id' => 3,
                'created_at' => '2023-12-12T12:12:12'
            )
        );

        DB::table('social_requests')->insert(
            array(
                'title' => 'Все плохо',
                'slug' => 'money_4',
                'text' => 'много че можно написать',
                'coordinates' => '33.2971631,69.2815243',
                'address' => 'fake',
                'urgency' => 3,
                'status_id' => 2,
                'author_id' => 1,
                'region_id' => 3,
                'created_at' => '2023-12-12T12:12:12'
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
        Schema::dropIfExists('social_requests');
    }
}
