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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->string("name",100);
            $table->string("email",100);
            $table->string("phone",100);
            $table->string("date_of_birth",100);
            $table->string("joining_date",100);
            $table->string("gender",100);
            $table->string("religion",100);
            $table->string("blood_group",100)->nullable();
            $table->string("nationality",100);
            $table->string("parmanent_address",100);
            $table->string("present_address",100);
            $table->string("marital_status",100);
            $table->string("nid_no",100);
            $table->string("qualification",100);
            $table->string("experience",100)->nullable();
            $table->string("designation",100);
            $table->string("ssc_marks",100)->nullable();
            $table->string("ssc_board",100)->nullable();
            $table->string("hsc_marks",100)->nullable();
            $table->string("hsc_board",100)->nullable();
            $table->string("ssc_passing_year",100)->nullable();
            $table->string("hsc_passing_year",100)->nullable();
            $table->string("ssc_institute",100)->nullable();
            $table->string("hsc_institute",100)->nullable();
            $table->string("honours_marks",100)->nullable();
            $table->string("honours_institute",100)->nullable();
            $table->string("honours_passing_year",100)->nullable();
            $table->string("masters_marks",100)->nullable();
            $table->string("masters_institute",100)->nullable();
            $table->string("masters_passing_year",100)->nullable();
            $table->string("profile_pic",100)->nullable();
            $table->string("status",50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
