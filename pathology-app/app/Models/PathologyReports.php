<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PathologyReports extends Model
{
    use HasFactory;

    protected $connection =  'mysql';
    protected $table = 'pathology_reports';

    protected $fillable = [
        'id',
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
        'clinical_history',
        'clinical_diagnosis',
        'phatology_diag',
        'gross_examination',
        'gross_examiner',
        'gross_date',
        'microscopic_description',
        'pathologist',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5'        
    ];


    protected function phatology_diag(): Attribute{
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }


}
