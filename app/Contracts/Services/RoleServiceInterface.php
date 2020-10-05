<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:46
 */

namespace App\Contracts\Services;

use App\Http\Requests\CreateRequests\RoleCreateRequest;
use App\Http\Requests\UpdateRequests\RoleUpdateRequest;

interface RoleServiceInterface
{

    public function getById($id);
    public function getAll($columns);
    public function getByPaginate();
    public function insert(RoleCreateRequest $roleCreateRequest);
    public function update(RoleUpdateRequest $roleUpdateRequest, $id);
    public function delete($id);
}