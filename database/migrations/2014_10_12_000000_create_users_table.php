<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('picture')->nullable();
            
            $table->string('password')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_staff')->default(false);
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->boolean('is_org_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'admin',
                'phone' => '998000000000',
                'password' => bcrypt('admin'),
                'is_admin' => true
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
        Schema::dropIfExists('users');
    }
}
