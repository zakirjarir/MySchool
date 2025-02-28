<?php

namespace App\Models\Academic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $table = 'day';
    protected $fillable = [
        'name'
    ];

    public function classRoutines()
    {
        return $this->hasMany(ClassRoutines::class, 'day', 'name');
    }
}
