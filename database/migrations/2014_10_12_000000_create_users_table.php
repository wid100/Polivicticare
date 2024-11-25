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
            $table->unsignedBigInteger('division_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('thana_id')->nullable();
            $table->unsignedBigInteger('union_id')->nullable();
            $table->unsignedBigInteger('pourashava_id')->nullable();
            $table->unsignedBigInteger('ward_id')->nullable();
            $table->string('house')->nullable();

            $table->string('name')->nullable();
            $table->string('uid')->uniqid();
            $table->unsignedTinyInteger('donner_type')->default(1);
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('category_id')->nullable();
            $table->string('bank_info')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verify_code')->nullable();
            $table->string('password');
            $table->string('nid')->nullable();
            $table->text('problem_description')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('reference_phone')->nullable();
            $table->string('reference_email')->nullable();
            $table->string('reference_organization_id')->nullable();
            $table->string('reference_district')->nullable();
            $table->string('reference_location')->nullable();
            $table->string('organization_id')->nullable();
            $table->string('party_designation')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
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
