<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surgical extends Model
{
    use HasFactory;
    
    protected $connection =  'mysql';
    protected $table = 'pathology_reports';
    // public $incrementing = false;  //ถ้าใช้ primary key เป็น String ให้เพิ่มบันทัดนี้ด้วย

    protected $fillable = [
        'id',
        'outid',
        'lab_order_number',
        'hn',
        'fname',
        'lname',
        'age',
        'gender',
        'speci_collected_at',
        'speci_received_at',
        'date_of_report',
        'physician',
        'type',        
        'txt_image_1',
        'txt_image_2',
        'txt_image_3',
        'txt_image_4',
        'txt_image_5',
        'pathologist',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
        'release'      
    ];

    protected $hidden = [
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
    ];

    // ค่าตัวแปรเริ่มต้นกำหนดใน ฐานข้อมูล
    protected $sttribute = [
        'type' => 'SURGICAL'
    ];

    // protected function phatology_diag(): Attribute{
    //     return Attribute::make(
    //         get: fn ($value) => json_decode($value, true),
    //         set: fn ($value) => json_encode($value),
    //     );
    // }
}
