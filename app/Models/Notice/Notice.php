<?php

namespace App\Models\Notice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;
    protected $table = 'notices';
    protected $fillable = [
        'title',
        'description',
        'date',
        'author',
        'status',
        'category',
        'expiry_date',
        'file',
    ];

}
