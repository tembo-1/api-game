<?php

namespace App\Services\Api\Game;

use App\Services\Api\ActionDefaultPost;
use Illuminate\Database\Eloquent\Model;

class GameService extends ActionDefaultPost
{
    /**
     * @param  Model|null  $category
     * @return mixed|null
     */
    public function getByCategory(Model $category = null):mixed
    {
        if (isset($category)) {
            return $category->games;
        }

        return null;
    }
}
