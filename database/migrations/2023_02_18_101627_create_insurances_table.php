<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('slug')->nullable();
            $table->unsignedBigInteger('solution_id')->nullable();
            $table->text('image')->nullable();
            $table->string('icon')->nullable();
            $table->text('description')->nullable();
            $table->text('pre_content')->nullable();
            $table->text('content')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->unsignedBigInteger('updated_by_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            /* Índices de campos foráneos de otras tablas */
            $table->foreign('solution_id')->references('id')->on('solutions');
            $table->foreign('created_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurances');
    }
}
