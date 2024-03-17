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
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id");
            $table->foreign("user_id")->references("id")->on("users")
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->string("name",100);
            $table->string("email",100);
            $table->string("phone",100);
            $table->string("occupation",100);
            $table->string("gender",100);
            $table->string("nid_no",100)->unique();
            $table->string("address",100);
            $table->string("status",50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents');
    }
};
