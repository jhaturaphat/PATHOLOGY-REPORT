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
        Schema::create('phatology_reports', function (Blueprint $table) {
            $table->id()->comment('Surgical number หมายเลขการผ่าตัด');
            $table->string('lab_order_number')->nullable()->comment('lab_order_number จาก Hosxp')->index();
            $table->string('hn')->nullable()->comment('HN')->index();
            $table->string('name')->nullable()->comment('ชื่อ');
            $table->string('lastname')->nullable()->comment('นามสกุล');
            $table->integer('age')->nullable()->comment('อายุ');
            $table->string('gender')->nullable()->comment('เพศ');
            $table->dateTime('collected_at')->nullable()->comment('วันที่เก็บสิ่งส่งตรวจ');
            $table->dateTime('received_at')->nullable()->comment('วันที่ได้รับสิ่งส่งตรวจ');
            $table->string('physician')->nullable()->comment('แพทย์ผู้สั่งตรวจ');
            $table->string('clinical_history')->nullable()->comment('ประวัติทางคลินิก');
            $table->string('clinical_diagnosis')->nullable()->comment('การวินิจฉัยทางคลินิก');
            $table->string('phatology_diag')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา');
            $table->string('gross_examination')->nullable()->comment('การตรวจสอบขั้นต้น');
            $table->string('gross_examiner')->nullable()->comment('ผู้ตรวจสอบขั้นต้น');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phatology_reports');
    }
};
