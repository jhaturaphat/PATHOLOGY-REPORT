<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Contracts\Auth\Authenticatable;

class Opduser extends Authenticatable
{
    use HasFactory;
    protected $connection = 'mysql_his';  // 'mysql_his' ตั้งค่าใน config/databases.php  สำหรับฐานข้อมูลโรงบาล
    protected $table = 'opduser'; // ชื่อ table ที่อยู่บนฐานข้อมูลที่เราเชื่อมต่อ พิมพ์ใส่ให้ตรงกัน
    public $timestamps = false;  
    public $incrementing = false;
    protected $primaryKey = 'loginname';
    // public $username = 'loginname';
    public $password = 'passweb';

    

    // protected $email = 'loginname';
    // protected $password = 'passweb';

    protected $fillable = [
        'loginname',
        'passweb'
        // รายการฟิลด์อื่น ๆ ที่คุณใช้
    ];

     protected $visible = [
        'loginname',
        'name',
        'passweb'
    ];

    protected $casts = [        
        'password' => 'hashed',
        // 'passweb' => 'string',
    ];

    public function getAuthIdentifierName(){
        return $this->loginname;
    }

    public function getAuthPassword() { 
        dd($this->passweb);
        return $this->passweb; 
    } 
}
