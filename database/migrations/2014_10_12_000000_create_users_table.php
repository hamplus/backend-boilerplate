<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');

            $table->string('phone')->unique();$table->string('username')->nullable()->unique();
            $table->string('name')->nullable();
            $table->boolean('is_public')->default(true);
            $table->text('bio')->nullable();
            $table->string('bio_url')->nullable();
            $table->string('image')->nullable();
            // private fields
            $table->string('email')->nullable();
            $table->enum('gender', ['male', 'female','other'])->nullable();
            $table->string('education')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->string('skills')->nullable();
            $table->string('interests')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
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
