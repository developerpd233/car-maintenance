<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const LAST_APPOINTMENT_SELECT = [
        '1_months' => '1 months',
        '3_months' => '3 months',
        '6_months' => '6 months',
        '1_year'   => '1 year',
    ];

    public $table = 'services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'description',
        'last_appointment',
        'model_year',
        'mileage',
        'working_time',
        'price',
        'brand_meta',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
