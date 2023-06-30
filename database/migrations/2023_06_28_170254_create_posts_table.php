<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('text');
            $table->integer('user_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->timestamps();
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
        });

        DB::table('posts')->insert(array(
            'title' => 'Test Post',
            'slug' => 'test-post',
            'text' => 'test data',
            'user_id' => 2,
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
        Schema::dropIfExists('posts');
    }
}
