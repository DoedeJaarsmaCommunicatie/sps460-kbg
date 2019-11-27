<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->string('firstName');
                $table->string('lastName');
                $table->string('email');
                $table->string('houseNumber')->nullable();
                $table->string('postalCode')->nullable();
            $table->timestamps();
        });

        Schema::create('signups', static function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->unsignedBigInteger('user_id');
                $table->string('type')->default('advisory');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('signup');
    }
}
