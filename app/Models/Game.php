<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'studio_id',
    ];

    /**
     * @var string[]
     */
    protected $hidden = ['pivot'];

    public function gameCategories()
    {
        return $this->hasMany(GameCategory::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'gamecategories');
    }
    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }
}
