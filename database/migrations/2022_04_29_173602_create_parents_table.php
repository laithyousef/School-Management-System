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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //Fatherinformation
            $table->string('Father_Name');
            $table->string('Father_National_ID');
            $table->string('Father_Passport_ID');
            $table->string('Father_Phone');
            $table->string('Father_Job');

            $table->foreign('Father_Nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->bigInteger('Father_Nationality_id')->unsigned();

            $table->foreign('Father_Blood_Type_id')->references('id')->on('blood_types')->onDelete('cascade');
            $table->bigInteger('Father_Blood_Type_id')->unsigned();

            $table->foreign('Father_Religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->bigInteger('Father_Religion_id')->unsigned();

            $table->string('Father_Address');

            //Mother information
            $table->string('Mother_Name');
            $table->string('Mother_National_ID');
            $table->string('Mother_Passport_ID');
            $table->string('Mother_Phone');
            $table->string('Mother_Job');

            $table->foreign('Mother_Nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $table->bigInteger('Mother_Nationality_id')->unsigned();

            $table->foreign('Mother_Blood_Type_id')->references('id')->on('blood_types')->onDelete('cascade');
            $table->bigInteger('Mother_Blood_Type_id')->unsigned();

            $table->foreign('Mother_Religion_id')->references('id')->on('religions')->onDelete('cascade');
            $table->bigInteger('Mother_Religion_id')->unsigned();
            
            $table->string('Mother_Address');
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
        Schema::dropIfExists('parents');
    }
};
