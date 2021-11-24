<?php

namespace Modules\Policy\Http\Resources\V1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $acknowledgement_required
 * @property mixed $file
 * @property mixed $file_type
 * @property mixed $is_trashed
 * @property mixed $date_uploaded
 */
class PolicyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'                       => $this->id,
            'title'                    => $this->title,
            'acknowledgement_required' => $this->acknowledgement_required,
            'file'                     => Storage::disk('public')->url($this->file),
            'file_type'                => $this->file_type,
            'is_trashed'               => $this->is_trashed,
            'date_uploaded'            => $this->date_uploaded,
        ];
    }
}
