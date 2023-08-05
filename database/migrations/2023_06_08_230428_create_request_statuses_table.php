<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru');
            $table->string('title_uz');
            $table->string('slug')->unique();
            $table->string('color');
            $table->timestamps();
        });

        DB::table('request_statuses')->insert(
            array(
                'title_ru' => 'Новое',
                'title_uz' => 'Yangi',
                'slug' => 'new',
                'color' => 'blue'
            )
        );

        DB::table('request_statuses')->insert(
            array(
                'title_ru' => 'В процессе',
                'title_uz' => 'Jarayonda',
                'slug' => 'processing',
                'color' => 'yellow'
            )
        );

        DB::table('request_statuses')->insert(
            array(
                'title_ru' => 'Решено',
                'title_uz' => 'Qaror qilgan',
                'slug' => 'solved',
                'color' => 'green'
            )
        );

        DB::table('request_statuses')->insert(
            array(
                'title_ru' => 'Не решено',
                'title_uz' => 'Qaror qilmagan',
                'slug' => 'not_solved',
                'color' => 'red'
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
        Schema::dropIfExists('request_statuses');
    }
}
