<?php

namespace App\Http\Requests\UpdateRequests;

use App\Http\Requests\UpdateRequests\BaseUpdateRequest;
use App\User;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends BaseUpdateRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'fullname' => 'required',
            'username' => [
                'required',
                Rule::unique('users')->where(User::RECORD_STATUS_FIELD, User::RECORD_STATUS_ACTIVE)->ignore($this->route('user'), 'id')
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->where(User::RECORD_STATUS_FIELD, User::RECORD_STATUS_ACTIVE)->ignore($this->route('user'), 'id')
            ],
            'password' => 'required|confirmed',
            'roles' => 'present',
            'roles.*' => 'required|numeric',
        ];
    }
}
