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
            $table->string('picture')->nullable();
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('organization_id')->references('id')->on('organizations');
        });

        DB::table('organizations')->insert(array(
            'title' => 'test org'
        ));

        DB::table('users')->insert(
            array(
                'name' => 'staff org admin',
                'phone' => 'staff_admin',
                'password' => bcrypt('staff'),
                'is_staff' => true,
                'is_org_admin' => true,
                'organization_id' => 1
            )
        );

        DB::table('users')->insert(
            array(
                'name' => 'staff org',
                'phone' => 'staff',
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
