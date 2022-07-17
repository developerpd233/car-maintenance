<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        'active'    => 'Active',
        'in_active' => 'In Active',
    ];

    public const BOOKING_CAPABILITY_SELECT = [
        'both_online_and_walk_in' => 'Both online and walk-in',
        'online_only'             => 'Online only',
    ];

    public $table = 'branches';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'bays_jacks',
        'booking_capability',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
