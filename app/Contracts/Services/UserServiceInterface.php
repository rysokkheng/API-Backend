<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:46
 */

namespace App\Contracts\Services;

use App\Http\Requests\CreateRequests\UserCreateRequest;
use App\Http\Requests\UpdateRequests\UserUpdateRequest;

interface UserServiceInterface
{
    public function getUserByUsername($username);
    public function getById($id);
    public function getAll($columns);
    public function getByPaginate();
    public function insert(UserCreateRequest $userCreateRequest);
    public function update(UserUpdateRequest $userUpdateRequest, $id);
    public function delete($id);
}