<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();
            $table->string('from')->default('Anon');
            $table->text('text')->nullabe();
            $table->decimal('amount', 65, 2);
            $table->integer('user_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->timestamps();
        });

        DB::table('incomes')->insert(array(
            'text' => 'тест доход',
            'amount' => '5000.00',
            'user_id' => 3,
            'organization_id' => 1,
            'created_at' => '2023-12-12T12:12:12'
        ));

        DB::table('incomes')->insert(array(
            'text' => 'тест доход',
            'from' => 'Test donater',
            'amount' => '15000.00',
            'user_id' => 3,
            'organization_id' => 1,
            'created_at' => '2023-12-12T12:12:12'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
