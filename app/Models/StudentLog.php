<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLog extends Model
{
    use HasFactory;

    protected $table = 'student_log'; // Explicitly set the table name

    protected $guarded = [];

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'log_date',
        'log_header',
        'log_detail',
        'created_date',
        'student_id',
        'log',
    ];

    protected $casts = [
        'log' => 'array', // Automatically cast JSON to array
    ];
}
