<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru');
            $table->string('title_uz');
            $table->string('slug_ru')->unique();
            $table->string('slug_uz')->unique();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('regions');
            $table->timestamps();
        });

        DB::table('regions')->insert(
            array(
                'title_ru' => 'Ташкент',
                'title_uz' => 'Toshkent',
                'slug_ru' => 'tashkent',
                'slug_uz' => 'toshkent',
            )
        );

        DB::table('regions')->insert(
            array(
                'title_ru' => 'Бухара',
                'title_uz' => 'Buxoro',
                'slug_ru' => 'bukhara',
                'slug_uz' => 'buxoro',
            )
        );

        DB::table('regions')->insert(
            array(
                'title_ru' => 'Хива',
                'title_uz' => 'Xiva',
                'slug_ru' => 'khiva',
                'slug_uz' => 'xiva',
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
        Schema::dropIfExists('regions');
    }
}
