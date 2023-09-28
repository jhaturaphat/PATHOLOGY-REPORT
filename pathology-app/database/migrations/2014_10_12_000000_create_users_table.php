<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            $table->boolean('is_admin')->default('0')->nullable(false);
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $sql = "INSERT INTO users (`name`, `email`, `is_admin`, `password`) VALUES ('Administrator','admin@mail.com',1,'".Hash::make('123456')."')";
        DB::connection('mysql')->statement($sql);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
