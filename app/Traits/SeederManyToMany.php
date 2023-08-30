<?php

namespace App\Traits;

use App\Enums\TypeManyToMany;
use Illuminate\Database\Eloquent\Model;

trait SeederManyToMany
{
    /**
     * Returns an array based
     * on the selected fill type
     *
     * @param  Model  $firstModel
     * @param  Model  $secondModel
     * @param  int  $counter
     * @param  TypeManyToMany  $type
     * @return array
     */

    /**
     * @var string
     */
    private string $firstFK;

    /**
     * @var string
     */
    private string $secondFK;

    /**
     * @var int
     */
    private int $secondModelId;

    public function fill(Model $firstModel, Model $secondModel, int $counter, TypeManyToMany $type):array
    {
        $this->firstFK = $firstModel->getForeignKey();
        $this->secondFK = $secondModel->getForeignKey();
        $this->secondModelId = $secondModel->inRandomOrder()->first()->id;

        if ($type === TypeManyToMany::FIRST_FILL) {
            return [
                $this->firstFK          =>      $firstModel->find($counter)->id,
                $this->secondFK         =>      $this->secondModelId,
            ];
        }

        return [
            $this->firstFK              =>      $firstModel->inRandomOrder()->first()->id,
            $this->secondFK             =>      $this->secondModelId,
        ];

    }


}
