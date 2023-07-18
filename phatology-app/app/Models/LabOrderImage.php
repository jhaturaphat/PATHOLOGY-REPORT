<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabOrderImage extends Model
{
    use HasFactory;
    protected $connection = 'mysql_his';
    protected $table = 'lab_order_image';

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

    protected $hidden = [
        'hos_guid',
    ];

}
