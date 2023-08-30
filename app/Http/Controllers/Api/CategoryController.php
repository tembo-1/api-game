<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\PatchRequest;
use App\Http\Requests\Api\Category\StoreRequest;
use App\Http\Resources\Api\Category\GetResource;
use App\Http\Resources\Api\Category\PostResource;
use App\Models\Category;
use App\Http\Resources\Api\Category\CategoryCollection;
use App\Services\Api\ActionDefaultPost;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{

    /**
     * @return JsonResponse
     */
    public function index():JsonResponse
    {
        return response()->json(['code' => 200, 'data' => CategoryCollection::make(Category::all())]);
    }

    /**
     * @param  StoreRequest  $request
     * @param  ActionDefaultPost  $service
     * @return JsonResponse
     */
    public function store(StoreRequest $request, ActionDefaultPost $service):JsonResponse
    {
        $data = $request->validated();

        $category = $service->store($data, new Category());

        if (isset($category)) {
            return response()->json(['code' => 200, 'data' => new PostResource($category)]);
        }

        return response()->json(['code' => 404, 'message' => 'Perhaps something is not right here']);
    }

    /**
     * @param  string  $id
     * @return JsonResponse
     */
    public function show(string $id):JsonResponse
    {
        $game = Category::find($id);

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => GetResource::make($game)]);
        }

        return response()->json(['code' => 404, 'message' => 'There is no category with this id']);
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

        $game = $service->update($data, Category::find($id));

        if (isset($game)) {
            return response()->json(['code' => 200, 'data' => $game]);
        }

        return response()->json(['code' => 404, 'message' => 'The category was not found']);
    }

    /**
     * @param  string  $id
     * @param  ActionDefaultPost  $service
     * @return JsonResponse
     */
    public function destroy(string $id, ActionDefaultPost $service):JsonResponse
    {
        $game = $service->destroy(Category::find($id));

        if ($game) {
            return response()->json(['code' => 200, 'message' => 'The category was successfully deleted']);
        }

        return response()->json(['code' => 404, 'message' => 'The category was not found']);
    }
}
