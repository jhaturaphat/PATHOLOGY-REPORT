<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->id();
            $table->string('outid',50)->nullable(false)->comment('Surgical number หมายเลขการผ่าตัด เอามาจาก outlab');
            $table->string('lab_order_number',50)->nullable(false)->comment('lab_order_number จาก Hosxp');
            $table->string('hn',9)->nullable(false)->comment('HN');
            $table->string('fname')->nullable(false)->comment('ชื่อ');
            $table->string('lname')->nullable(false)->comment('นามสกุล');
            $table->string('age')->nullable(false)->comment('อายุ');
            $table->string('gender')->nullable(false)->comment('เพศ');
            $table->dateTime('speci_collected_at')->nullable(false)->comment('วันที่เก็บสิ่งส่งตรวจ วันผ่าตัด');
            $table->dateTime('speci_received_at')->nullable(false)->comment('วันที่ได้รับสิ่งส่งตรวจ เอามาจาก outlab');
            $table->dateTime('date_of_report')->nullable(false)->comment('วันที่ออกรายงาน');
            $table->string('physician')->nullable()->comment('แพทย์ผู้สั่งตรวจ doctor_code');
            $table->enum('type', ['CYTOLOGICAL','SURGICAL'])->comment("CYTOLOGICAL=>เซลล์วิทยา, SURGICAL=> เกี่ยวกับการผ่าตัด");

            // $table->text('clinical_history')->nullable()->comment('ประวัติทางคลินิก');
            // $table->text('clinical_diagnosis')->nullable()->comment('การวินิจฉัยทางคลินิก');
            
            $table->longText('txt_image_1')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_1');
            $table->longText('txt_image_2')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_2');
            $table->longText('txt_image_3')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_3');
            $table->longText('txt_image_4')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_4');
            $table->longText('txt_image_5')->nullable()->comment('การวินิจฉัยทางพยาธิวิทยา_5');
            
            // $table->longText('gross_examination')->nullable()->comment('ผลการตรวจสอบขั้นต้น');
            // $table->string('gross_examiner')->nullable()->comment('ผู้ตรวจสอบขั้นต้น');
            // $table->string('gross_date')->nullable()->comment('ลงวันที่ตรวจสอบขั้นต้น');
            // $table->longText('microscopic_description')->nullable()->comment('คำอธิบายด้วยกล้องจุลทรรศน์');
            $table->string('pathologist')->nullable()->comment('ผู้ตรวจสอบ');
            
            $table->binary('image1')->nullable(false)->comment('รูปที่ 1');
            $table->binary('image2')->nullable()->comment('รูปที่ 2');
            $table->binary('image3')->nullable()->comment('รูปที่ 3');
            $table->binary('image4')->nullable()->comment('รูปที่ 4');
            $table->binary('image5')->nullable()->comment('รูปที่ 5');
            $table->dateTime('set_release_date')->comment('กำหนดช่วงเวลาปล่อย');
            $table->enum('release', ['P','A','W'])->default("A")->comment("P=ยืนยันผลแล้ว, A=ยืนยันผลอัตโนมัติ, W=ยืนยันผลเอง");
            $table->integer('user_id')->nullable(false)->comment('ผู้บันทึก');            
            $table->timestamps();

            $table->unique(['outid']);
            $table->index(['lab_order_number', 'hn']);
           
        });
            DB::connection('mysql')->statement("ALTER TABLE pathology_reports MODIFY COLUMN image1 MEDIUMBLOB");
            DB::connection('mysql')->statement("ALTER TABLE pathology_reports MODIFY COLUMN image2 MEDIUMBLOB");
            DB::connection('mysql')->statement("ALTER TABLE pathology_reports MODIFY COLUMN image3 MEDIUMBLOB");
            DB::connection('mysql')->statement("ALTER TABLE pathology_reports MODIFY COLUMN image4 MEDIUMBLOB");
            DB::connection('mysql')->statement("ALTER TABLE pathology_reports MODIFY COLUMN image5 MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pathology_reports');
    }
};
