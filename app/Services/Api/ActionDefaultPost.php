<?php

namespace App\Services\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class ActionDefaultPost
{
    /**
     * @param  array  $data
     * @param  Model  $model
     * @return Model|null
     */
    public function store(array $data, Model $model):?Model
    {
        try {
            $model = $model->create($data);
        } catch (QueryException $exception) {
            return null;
        }

        return $model;
    }

    /**
     * @param  array  $data
     * @param  Model|null  $model
     * @return Model|null
     */
    public function update(array $data, Model $model = null):?Model
    {
        if (isset($model)) {
            $model->update($data);
        }

        return $model;
    }

    /**
     * @param  Model|null  $game
     * @return Model|null
     */
    public function destroy(Model $game = null):?Model
    {
        if (isset($game)) {
            $game->delete();
        }

        return $game;
    }
}
