<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *регион
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('info')->nullable();
            $table->string('main_card_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
        });

        DB::table('organizations')->insert(array(
            'title' => 'test org',
            'info' => 'something',
            'main_card_number' => '8600000000001111',
            'phone' => '88005553535',
            'address' => 'chill street 75',
        ));

        DB::table('users')->insert(
            array(
                'name' => 'staff org admin',
                'phone' => '998111111111',
                'password' => bcrypt('staff'),
                'is_staff' => true,
                'is_org_admin' => true,
                'organization_id' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'staff org',
                'phone' => '998222222222',
                'password' => bcrypt('staff'),
                'is_staff' => true,
                'organization_id' => 1
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
        Schema::dropIfExists('organizations');
    }
}
