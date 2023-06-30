<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumptions', function (Blueprint $table) {
            $table->id();
            $table->string('picture')->nullable();
            $table->text('text')->nullable();
            $table->decimal('amount', 65, 2);
            $table->integer('user_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->timestamps();
        });

        DB::table('consumptions')->insert(array(
            'text' => 'тест траты',
            'amount' => '5000.00',
            'user_id' => 3,
            'organization_id' => 1,
            'created_at' => '2023-12-12T12:12:12'
        ));

        DB::table('consumptions')->insert(array(
            'text' => 'тест траты',
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
        Schema::dropIfExists('consumptions');
    }
}
