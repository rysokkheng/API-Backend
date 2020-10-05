<?php

namespace App\Http\Requests\UpdateRequests;

use App\Http\Requests\UpdateRequests\BaseUpdateRequest;
use App\User;
use Illuminate\Validation\Rule;

class PermissionUpdateRequest extends BaseUpdateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('permissions', 'name')->ignore($this->route('permission')),
            ],
        ];
    }
}
