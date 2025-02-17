<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameCategory extends Model
{
    use HasFactory;

    protected $table = 'gamecategories';

    protected $fillable = [
        'game_id',
        'category_id',
    ];
}
