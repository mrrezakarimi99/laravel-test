<?php

namespace Modules\Policy\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Modules\Policy\Http\Resources\V1\PolicyResource;
use Modules\Policy\Models\Policy;

class PolicyController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return PolicyResource::collection(Policy::available()->paginate());
    }

    public function delete()
    {
        $columns['is_trashed'] = true;
    }
}
