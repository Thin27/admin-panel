<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\UpdatingFactory;

class Factory extends Model
{
    use HasFactory;

    protected $fillable = [
        'factory_name',
        'location',
        'email',
        'website'
    ];
}
