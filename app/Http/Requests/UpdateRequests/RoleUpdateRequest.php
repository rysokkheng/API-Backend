<?php

namespace App\Http\Requests\UpdateRequests;

use App\Http\Requests\UpdateRequests\BaseUpdateRequest;
use App\User;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends BaseUpdateRequest
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
                Rule::unique('roles', 'name')->ignore($this->route('role')),
            ],
            'permissions' => 'present',
            'permissions.*' => 'required|numeric',
        ];
    }
}
