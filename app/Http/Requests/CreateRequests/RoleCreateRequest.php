<?php

namespace App\Http\Requests\CreateRequests;

use App\Models\BaseModel;
use App\User;
use Illuminate\Validation\Rule;

class RoleCreateRequest extends BaseCreateRequest
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
                Rule::unique('roles', 'name')
            ],
            'permissions' => 'present|array|min:1',
            'permissions.*' => 'required|numeric',

        ];
    }
}
