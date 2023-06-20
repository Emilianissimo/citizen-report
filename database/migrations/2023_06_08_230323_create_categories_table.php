<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title_ru');
            $table->string('title_uz');
            $table->string('slug_ru')->unique();
            $table->string('slug_uz')->unique();
            $table->timestamps();
        });

        DB::table('categories')->insert(
            array(
                'title_ru' => 'Жестокое обращение',
                'title_uz' => 'Shafqatsiz Muomala',
                'slug_ru' => 'jestokoe-obrashenie',
                'slug_uz' => 'shafqatsiz-muomala',
            )
        );

        DB::table('categories')->insert(
            array(
                'title_ru' => 'Бродячие животные',
                'title_uz' => 'Adashgan hayvonlar',
                'slug_ru' => 'brodyachie-jivotnie',
                'slug_uz' => 'adashgan-hayvonlar',
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
        Schema::dropIfExists('categories');
    }
}
