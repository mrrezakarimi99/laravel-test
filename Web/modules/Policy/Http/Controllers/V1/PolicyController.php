<?php

namespace Modules\Policy\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Policy\Http\Requests\V1\PolicyRequest;
use Modules\Policy\Http\Resources\V1\PolicyResource;
use Modules\Policy\Models\Policy;

class PolicyController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $policy = Policy::query();
        if ($search = $request->get('q')){
            $policy->where('title' , 'LIKE' , "%$search%");
        }
        return PolicyResource::collection($policy->paginate());
    }

    /**
     * @param PolicyRequest $request
     * @return PolicyResource
     */
    public function store(PolicyRequest $request): PolicyResource
    {
        $validate = $request->validated();
        $validate['date_uploaded'] = now()->toDateTimeString();
        $validate['file_type'] = $request->file->extension();
        $policy = Policy::create($validate);
        $policy->saveFile($request->file('file'), 'file', 'policy/' . $request->get('title') . '/');
        return new PolicyResource($policy);
    }

    /**
     * @param Policy $policy
     * @return JsonResponse
     */
    public function trash(Policy $policy): JsonResponse
    {
        $policy->moveToTrash();
        return response()->json([
            'message' => 'policy move to trash'
        ]);
    }

    /**
     * @param Policy $policy
     * @return JsonResponse
     */
    public function delete(Policy $policy): JsonResponse
    {
        $policy->delete();
        return response()->json([
            'message' => 'policy was deleted'
        ]);
    }
}
