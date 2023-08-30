<?php

namespace Database\Factories;

use App\Enums\TypeManyToMany;
use App\Models\Category;
use App\Models\Game;
use App\Traits\SeederManyToMany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=GameCategory>
 */
class GameCategoryFactory extends Factory
{
    use SeederManyToMany;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return $this->fill(new Game(), new Category(), $this->count--, TypeManyToMany::FIRST_FILL);
    }
}
