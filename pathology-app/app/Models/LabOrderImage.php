<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabOrderImage extends Model
{
    use HasFactory;
    protected $connection = 'image_his';  // 'mysql_his' ตั้งค่าใน config/databases.php  สำหรับฐานข้อมูลโรงบาล
    protected $table = 'lab_order_image'; // ชื่อ table ที่อยู่บนฐานข้อมูลที่เราเชื่อมต่อ พิมพ์ใส่ให้ตรงกัน
    public $timestamps = false;  
    public $incrementing = false;

    protected $fillable = [
        'lab_order_number',
        'image1',
        'image1_note',
        'image2',
        'image2_note',
        'image3',
        'image3_note',
        'image4',
        'image4_note',
        'image5',
        'image5_note',
    ];

}
