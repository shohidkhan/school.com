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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string("first_name",100);
            $table->string("last_name",100);
            $table->string("admission_form_no",100);
            $table->string("registration_no",100)->unique();
            $table->string("year",100);
            $table->string("birth_place",100);
            $table->string("parmanent_address",100)->nullable();
            $table->string("present_address",100)->nullable();

            $table->string("nationality",100);
            
            $table->string("marital_status",100)->nullable();
            $table->string("nid_no",100);

            
            $table->string("roll",100);
            $table->string("gender",100);
            $table->string("date_of_birth",100);
            $table->string("admission_date",100);
            $table->string("profile_pic",100)->nullable();
            $table->string("religion",100);
            $table->string("weight",100)->nullable();
            $table->string("hight",100)->nullable();
            $table->enum("blood_group",["A+","A-","B+","B-","AB+","AB-","O+","O-"])->nullable();
            $table->string("father_name",100);
            $table->string("father_phone",100)->nullable();
            $table->string("father_occupation",100)->nullable();
            $table->string("father_nid",100)->nullable();

            $table->string("mother_name",100);
            $table->string("mother_phone",100)->nullable();
            $table->string("mother_occupation",100)->nullable();
            $table->string("mother_nid",100)->nullable();

            $table->string("guardian_name",100);
            $table->string("guardian_phone",100);
            $table->string("guardian_occupation",100)->nullable();
            $table->string("emergency_person_name",100);
            $table->string("emergency_person_relation",100);
            $table->string("emergency_contact",100);
            $table->string("status",100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
