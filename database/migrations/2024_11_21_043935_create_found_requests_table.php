<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoundRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('found_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('project_name')->nullable();
            $table->string('category')->nullable();
            $table->string('nid')->nullable();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->json('image')->nullable();
            $table->string('request_amount')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('found_requests');
    }
}
