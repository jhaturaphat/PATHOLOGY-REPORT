<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $connection = 'mysql_his';  // 'mysql_his' ตั้งค่าใน config/databases.php  สำหรับฐานข้อมูลโรงบาล
    protected $table = 'opduser'; // ชื่อ table ที่อยู่บนฐานข้อมูลที่เราเชื่อมต่อ พิมพ์ใส่ให้ตรงกัน
    public $timestamps = false;  
    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     protected $visible = [
        'loginname',
        'name',
        'passweb'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [        
        'passweb',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [        
        'passweb' => 'hashed',
    ];
}
