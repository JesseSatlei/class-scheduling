<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $table = 'lesson';
    protected $primaryKey = 'id';
    protected $fillable = ['date', 'matter', 'students', 'teacher_id'];
}
