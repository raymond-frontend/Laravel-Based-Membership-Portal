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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->string('slug');
            $table->string('reference_id', 6);
            $table->integer('membership_id')->index()->unsigned()->nullable()->default(1);
            $table->integer('role_id')->index()->unsigned()->nullable()->default(1);
            $table->integer('membergroup_id')->index()->unsigned()->nullable()->default(1);
            $table->string('language')->nullable();
            $table->longText('bio')->nullable();
            $table->longText('academics')->nullable();
            $table->longText('professional')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('style')->nullable();
            $table->longText('inspiration')->nullable();
            $table->string('password');
            $table->rememberToken();
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
