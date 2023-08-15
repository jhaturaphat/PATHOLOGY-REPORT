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
            $table->id()->comment('Surgical number หมายเลขการผ่าตัด เอามาจาก outlab');
            $table->string('lab_order_number')->nullable()->comment('lab_order_number จาก Hosxp')->index();
            $table->string('hn')->nullable()->comment('HN')->index();
            $table->string('fname')->nullable()->comment('ชื่อ');
            $table->string('lname')->nullable()->comment('นามสกุล');
            $table->integer('age')->nullable()->comment('อายุ');
            $table->string('gender')->nullable()->comment('เพศ');
            $table->dateTime('speci_collected_at')->nullable()->comment('วันที่เก็บสิ่งส่งตรวจ วันผ่าตัด');
            $table->dateTime('speci_received_at')->nullable()->comment('วันที่ได้รับสิ่งส่งตรวจ เอามาจาก outlab');
            $table->dateTime('date_of_report')->nullable()->comment('วันที่ออกรายงาน');
            $table->string('physician')->nullable()->comment('แพทย์ผู้สั่งตรวจ doctor_code');
            $table->text('clinical_history')->nullable()->comment('ประวัติทางคลินิก');
            $table->text('clinical_diagnosis')->nullable()->comment('การวินิจฉัยทางคลินิก');
            $table->text('phatology_diag')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา');
            $table->mediumText('phatology_diag2')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา');
            $table->string('gross_examination')->nullable()->comment('การตรวจสอบขั้นต้น');
            $table->string('microscopic_description')->nullable()->comment('คำอธิบายด้วยกล้องจุลทรรศน์');
            $table->string('pathologist')->nullable()->comment('ผู้ตรวจสอบ');
            // $table->enum('choices', array('image1', 'image2','image3', 'image4','image5'))->default('image1')->comment('ตัวเลือกสำหรับนำเข้า field lab_order_image default is image1');
            $table->binary('image1')->comment('รูปที่ 1');
            $table->binary('image2')->comment('รูปที่ 2');
            $table->binary('image3')->comment('รูปที่ 3');
            $table->binary('image4')->comment('รูปที่ 4');
            $table->binary('image5')->comment('รูปที่ 5');
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
