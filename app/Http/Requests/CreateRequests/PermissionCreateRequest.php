<?php

namespace App\Http\Requests\CreateRequests;

use App\User;
use Illuminate\Validation\Rule;

class PermissionCreateRequest extends BaseCreateRequest
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
                Rule::unique('permissions', 'name')
            ],
        ];
    }
}
