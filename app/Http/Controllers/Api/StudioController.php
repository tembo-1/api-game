<?php

namespace app\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Studio\PatchRequest;
use App\Http\Requests\Api\Studio\StoreRequest;
use App\Http\Resources\Api\Studio\GetResource;
use App\Http\Resources\Api\Studio\PostResource;
use App\Http\Resources\Api\Studio\StudioCollection;
use App\Models\Studio;
use App\Services\Api\ActionDefaultPost;
use Illuminate\Http\JsonResponse;

class StudioController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        return response()->json(['code' => 200, 'data' => StudioCollection::make(Studio::all())]);
    }

    /**
     * @param  StoreRequest  $request
     * @param  ActionDefaultPost  $service
     * @return JsonResponse
     */
    public function store(StoreRequest $request, ActionDefaultPost $service):JsonResponse
    {
        $data = $request->validated();

        $studio = $service->store($data, new Studio());

        if (isset($studio)) {
            return response()->json(['code' => 200, 'data' => new PostResource($studio)]);
        }

        return response()->json(['code' => 404, 'message' => 'Perhaps something is not right here']);
    }

    /**
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id):JsonResponse
    {
        $game = Studio::find($id);

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => GetResource::make($game)]);
        }

        return response()->json(['code' => 404, 'message' => 'There is no studio with this id']);
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

        $game = $service->update($data, Studio::find($id));

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => $game]);
        }

        return response()->json(['code' => 404, 'message' => 'The studio was not found']);
    }

    /**
     * @param  string  $id
     * @param  ActionDefaultPost  $service
     * @return JsonResponse
     */
    public function destroy(string $id, ActionDefaultPost $service):JsonResponse
    {
        $game = $service->destroy(Studio::find($id));

        if ($game) {
            return response()->json(['code' => 200, 'message' => 'The studio was successfully deleted']);
        }

        return response()->json(['code' => 404, 'message' => 'The studio was not found']);
    }
}
