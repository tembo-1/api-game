<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Game\PatchRequest;
use App\Http\Requests\Api\Game\StoreRequest;
use App\Http\Resources\Api\Game\GameCollection;
use App\Http\Resources\Api\Game\GetResource;
use App\Http\Resources\Api\Game\PostResource;
use App\Models\Category;
use App\Models\Game;
use App\Services\Api\ActionDefaultPost;
use Illuminate\Http\JsonResponse;
use App\Services\Api\Game\GameService;

class GameController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        return response()->json(['code' => 200, 'data' => GameCollection::make(Game::all())]);
    }

    /**
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id):JsonResponse
    {
        $game = Game::find($id);

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => GetResource::make($game)]);
        }

        return response()->json(['code' => 404, 'message' => 'There is no game with this id']);
    }

    /**
     * @param  StoreRequest  $request
     * @param  ActionDefaultPost  $service
     * @return JsonResponse
     */
    public function store(StoreRequest $request, ActionDefaultPost $service)
    {
        $data = $request->validated();

        $game = $service->store($data, new Game());

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => new PostResource($game)]);
        }

        return response()->json(['code' => 404, 'message' => 'Perhaps there is no studio with such an id']);
    }

    /**
     * @param  string  $id
     * @param  GameService  $gameService
     * @return JsonResponse
     */
    public function destroy(string $id, GameService $gameService):JsonResponse
    {
        $game = $gameService->destroy(Game::find($id));

        if ($game) {
            return response()->json(['code' => 200, 'message' => 'The game was successfully deleted']);
        }

        return response()->json(['code' => 404, 'message' => 'The game was not found']);
    }

    /**
     * @param  PatchRequest  $request
     * @param  string  $id
     * @param  ActionDefaultPost  $service
     * @return JsonResponse
     */
    public function update(PatchRequest $request, string $id, ActionDefaultPost $service):JsonResponse
    {
        $data = $request->validated();

        $game = $service->update($data, Game::find($id));

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => $game]);
        }

        return response()->json(['code' => 404, 'message' => 'The game was not found']);
    }

    /**
     * @param  string  $value
     * @param  GameService  $gameService
     * @return JsonResponse
     */
    public function getByCategoryId(string $value, GameService $gameService)
    {
        $games = $gameService->getByCategory(Category::find($value));

        if (isset($games)) {
            return response()->json(['code' => 200, 'data' => $games]);
        }

        return response()->json(['code' => 404, 'message' => 'There is no category with this id']);
    }

    /**
     * @param  string  $value
     * @param  GameService  $gameService
     * @return JsonResponse
     */
    public function getByCategoryName(string $value, GameService $gameService):JsonResponse
    {
        $games = $gameService->getByCategory(Category::where('name', 'LIKE', "{$value}%")->first());

        if (isset($games)) {
            return response()->json(['code' => 200, 'data' => $games]);
        }

        return response()->json(['code' => 404, 'message' => 'There is no category with this name']);
    }
}
