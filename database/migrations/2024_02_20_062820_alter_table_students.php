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
        //
        Schema::table('students', function (Blueprint $table) {
            $table->unsignedBigInteger("class_id")->after("id");
            $table->foreign("class_id")->references("id")->on("classes")
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
            $table->unsignedBigInteger("user_id")->after("id");
            $table->foreign("user_id")->references("id")->on("users")
                    ->cascadeOnUpdate()
                    ->restrictOnDelete();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
