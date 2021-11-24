<?php

namespace Modules\Policy\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $file
 */
class PolicyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'                    => 'required|min:8',
            'acknowledgement_required' => 'required|boolean',
            'file'                     => 'required|mimes:jpg,png,pdf|max:4096:'
        ];
    }
}
