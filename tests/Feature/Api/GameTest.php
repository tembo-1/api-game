<?php

namespace Tests\Feature\Api;

use App\Models\Game;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_game_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $data = [
            'name' => 'Name game`s',
        ];

        $response = $this->post('/api/games', $data);

        $response->assertOk();

        $this->assertDatabaseCount('games', 1);

        $game = Game::first();

        $this->assertEquals($data['name'], $game->name);

        $response->assertJson([
            'id' => $game->id,
            'name' => $game->name,
        ]);
    }
}
