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
                'title_ru' => 'Коррупция',
                'title_uz' => 'Korupsiya',
                'slug_ru' => 'korruptsiya',
                'slug_uz' => 'korupsiya',
            )
        );

        DB::table('categories')->insert(
            array(
                'title_ru' => 'Градоустройство',
                'title_uz' => 'Shahar ishlari',
                'slug_ru' => 'gradoustroystvo',
                'slug_uz' => 'shahar-ishlari',
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
