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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('user_type')->default(2)->comment('1:admin, 2: school, 3:teacher');
            $table->string('last_name')->nullable();
            $table->string('id_number')->nullable();
            $table->integer('class_id')->nullable();
            $table->string('program')->nullable();
            $table->string('designation')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_pic')->nullable();  
            $table->tinyInteger('is_delete')->default(0)->comment('0:not deleted, 1: deleted');
            $table->tinyInteger('status')->default(0)->comment('0: active , 1: inactive');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
