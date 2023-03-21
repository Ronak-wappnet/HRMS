<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leaves';
    protected $primarykey = 'id';
    protected $fillable= [
        'subject',
        'description',
        'start_day',
        'start_day_leave_type',
        'end_date',
        'end_day_leave_type',
        'reason',
        'Reliver_work',
    ];

}
