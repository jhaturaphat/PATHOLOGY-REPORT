<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * php artisan migrate
     * php artisan migrate:refresh  กรณีอัพเดท
     */
    public function up(): void
    {
        Schema::create('pathology_reports', function (Blueprint $table) {
            $table->string('id')->primary()->comment('Surgical number หมายเลขการผ่าตัด เอามาจาก outlab');
            $table->string('lab_order_number')->nullable()->comment('lab_order_number จาก Hosxp')->index();
            $table->string('hn')->nullable()->comment('HN')->index();
            $table->string('fname')->nullable()->comment('ชื่อ');
            $table->string('lname')->nullable()->comment('นามสกุล');
            $table->string('age')->nullable()->comment('อายุ');
            $table->string('gender')->nullable()->comment('เพศ');
            $table->dateTime('speci_collected_at')->nullable()->comment('วันที่เก็บสิ่งส่งตรวจ วันผ่าตัด');
            $table->dateTime('speci_received_at')->nullable()->comment('วันที่ได้รับสิ่งส่งตรวจ เอามาจาก outlab');
            $table->dateTime('date_of_report')->nullable()->comment('วันที่ออกรายงาน');
            $table->string('physician')->nullable()->comment('แพทย์ผู้สั่งตรวจ doctor_code');
            $table->text('clinical_history')->nullable()->comment('ประวัติทางคลินิก');
            $table->text('clinical_diagnosis')->nullable()->comment('การวินิจฉัยทางคลินิก');
            
            $table->mediumText('phatology_diag_1')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_1');
            $table->mediumText('phatology_diag_2')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_2');
            $table->mediumText('phatology_diag_3')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_3');
            $table->mediumText('phatology_diag_4')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_4');
            $table->mediumText('phatology_diag_5')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_5');
            
            $table->string('gross_examination')->nullable()->comment('ผลการตรวจสอบขั้นต้น');
            $table->string('gross_examiner')->nullable()->comment('ผู้ตรวจสอบขั้นต้น');
            $table->string('gross_date')->nullable()->comment('ลงวันที่ตรวจสอบขั้นต้น');
            $table->string('microscopic_description')->nullable()->comment('คำอธิบายด้วยกล้องจุลทรรศน์');
            $table->string('pathologist')->nullable()->comment('ผู้ตรวจสอบ');
            
            $table->binary('image1')->nullable()->comment('รูปที่ 1');
            $table->binary('image2')->nullable()->comment('รูปที่ 2');
            $table->binary('image3')->nullable()->comment('รูปที่ 3');
            $table->binary('image4')->nullable()->comment('รูปที่ 4');
            $table->binary('image5')->nullable()->comment('รูปที่ 5');
            $table->timestamps();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathology_reports');
    }
};
