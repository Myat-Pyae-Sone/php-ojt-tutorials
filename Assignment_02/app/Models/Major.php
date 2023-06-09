<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];
    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
