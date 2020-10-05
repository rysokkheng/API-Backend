<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:46
 */

namespace App\Contracts\Services;


use App\Http\Requests\CreateRequests\PermissionCreateRequest;
use App\Http\Requests\UpdateRequests\PermissionUpdateRequest;

interface PermissionServiceInterface
{

    public function getById($id);
    public function getAll($columns);
    public function getByPaginate();
    public function insert(PermissionCreateRequest $permissionCreateRequest);
    public function update(PermissionUpdateRequest $roleUpdateRequest, $id);
    public function delete($id);
}