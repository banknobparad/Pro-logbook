<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentLog extends Model
{
    use HasFactory;

    protected $table = 'student_log'; // Explicitly set the table name

    protected $guarded = [];
}
