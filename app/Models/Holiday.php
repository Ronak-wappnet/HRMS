<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Holiday extends Model
{
    use HasFactory;
    use SoftDeletes , Notifiable;
    protected $table = "holiday";
    protected $pirmaryKey = "id";
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'optional'
    ];
}
