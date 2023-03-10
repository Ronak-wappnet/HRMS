<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;
    protected $table = "holiday";
    protected $pirmaryKey = "id";
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'optional'
    ];
}
