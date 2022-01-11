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
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('state_id')->unsigned();
            $table->timestamps();
            $table->foreign('state_id')->references('id')->on('states');
        });

        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slogan');
            $table->string('logo');
            $table->longText('details');
            $table->string('register_no');
            $table->string('email');
            $table->string('mobile_no');
            $table->string('telephone_no')->nullable();
            $table->string('fex_no')->nullable();
            $table->longText('address');
            $table->string('pin_cord_no');
            $table->string('token')->unique()->nullable();
            $table->string('verification_code')->unique()->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hospital_id')->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile_no', 13);
            $table->longText('address');
            $table->unsignedBigInteger('city_id')->unsigned();
            $table->unsignedBigInteger('state_id')->unsigned();
            $table->string('pin_code', 10);
            $table->string('aadhaar_no', 13)->unique();
            $table->enum('gender', ['male', 'female', 'transgender', 'other']);
            $table->date('dob');
            $table->enum('status', ['inactive', 'active'])->default('active');
            $table->string('token')->unique()->nullable();
            $table->string('verification_code')->unique()->nullable();
            $table->string('avatar');
            $table->string('document_pic');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('hospital_id')->references('id')->on('hospitals');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('state_id')->references('id')->on('states');
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
