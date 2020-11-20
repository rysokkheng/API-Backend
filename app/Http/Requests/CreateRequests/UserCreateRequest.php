<?php

namespace App\Http\Requests\CreateRequests;

use App\User;
use Illuminate\Validation\Rule;

class UserCreateRequest extends BaseCreateRequest
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
            'username' => 'required',
            'email' =>   'email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required_with:password',
            'roles' => 'required',

        ];
    }
}
