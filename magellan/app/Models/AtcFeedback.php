<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtcFeedback extends Model
{
    use HasFactory;
    
    protected $table = 'atc_feedback';
    
    protected $fillable = [
        'feedback_type',
        'country',
        'airports',
        'comments',
        'device_id',
        'app_version'
    ];
}
