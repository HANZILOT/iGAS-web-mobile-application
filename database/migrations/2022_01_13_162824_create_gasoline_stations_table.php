<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gasoline_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact')->nullable();
            $table->string('email')->nullable();
            $table->string('address');
            $table->foreignId('municipality_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('latitude');
            $table->string('longitude');
            $table->time('time_started_at')->nullable();
            $table->time('time_ended_at')->nullable();
            $table->boolean('is_always_open')->default(false);
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
        Schema::dropIfExists('gasoline_stations');
    }
};