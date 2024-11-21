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
            $table->unsignedBigInteger('role_id')->default(2);
            $table->string('name')->nullable();
            $table->string('uid')->uniqid();
            $table->unsignedTinyInteger('donner_type')->default(1);
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('bank_info')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verify_code')->nullable();
            $table->string('password');
            $table->string('nid')->nullable();
            $table->text('problem_description')->nullable();
            $table->string('reference')->nullable();
            $table->string('organization')->nullable();
            $table->string('party_designation')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->nullable();
            $table->json('image')->nullable();
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
