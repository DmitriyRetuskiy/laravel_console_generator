<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_datasets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users');
            $table->text('contact_address')->nullable(true);
            $table->text('register_address')->nullable(true);
            $table->string('contact_phone',100)->nullable(true);
            $table->string('passport_serial',100)->nullable(true);
            $table->string('passport_number',100)->nullable(true);
            $table->text('passport_address_from')->nullable(true); // must be changed into passport_from_department
            $table->date('passport_from_date')->nullable(true);
            $table->string('passport_cod_department',30)->nullable(true);
            $table->date('passport_birthday')->nullable(true);
            $table->string('city_birthday',255)->nullable(true);
            $table->string('INN',100)->nullable(true);
            $table->string('SNILS',100)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_datasets');
    }
};
