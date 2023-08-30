<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\GameCategory\PatchRequest;
use App\Http\Requests\Api\GameCategory\StoreRequest;
use App\Http\Resources\Api\GameCategory\GameCategoryCollection;
use App\Http\Resources\Api\GameCategory\PostResource;
use App\Models\GameCategory;
use App\Services\Api\Game\GameService;
use Illuminate\Http\JsonResponse;

class GameCategoryController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        return response()->json(['code' => 200, 'data' => GameCategoryCollection::make(GameCategory::all())]);
    }

    /**
     * @param  StoreRequest  $request
     * @param  GameService  $service
     * @return JsonResponse
     */
    public function store(StoreRequest $request, GameService $service):JsonResponse
    {
        $data = $request->validated();

        $categoryGame = $service->store($data, new GameCategory());

        if (isset($categoryGame)) {
            return response()->json(['code' => 200, 'data' => new PostResource($categoryGame)]);
        }

        return response()->json(['code' => 404, 'message' => 'Perhaps there are no such IDs or a pair of values is duplicated']);
    }

    /**
     * @param  PatchRequest  $request
     * @param  string  $id
     * @param  GameService  $service
     * @return JsonResponse
     */
    public function update(PatchRequest $request, string $id, GameService $service):JsonResponse
    {
        $data = $request->validated();

        $gameCategory = $service->update($data, GameCategory::find($id));

        if (isset($gameCategory)) {
            return response()->json(['code' => 200, 'data' => $gameCategory]);
        }

        return response()->json(['code' => 404, 'message' => 'Such a bundle was not found']);
    }
}
