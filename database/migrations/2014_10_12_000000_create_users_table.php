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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nick_name')->unique();            
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('active')->default(FALSE);
            $table->boolean('profile_flag')->default(FALSE);
            //$table->ipAddress('ip')->nullable();
            $table->bigInteger('group_id')->unsigned()->nullable();               // Внешний ключ для таблицы group_name
            $table->bigInteger('city_id')->unsigned()->nullable();                // Внешний ключ для таблицы city
            $table->bigInteger('role_id')->unsigned()->default(3);
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
