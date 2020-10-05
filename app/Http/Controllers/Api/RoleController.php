<?php
namespace App\Http\Controllers\Api;
use App\Contracts\Services\PermissionServiceInterface;
use App\Contracts\Services\RoleServiceInterface;
use App\Http\Requests\CreateRequests\PermissionCreateRequest;
use App\Http\Requests\CreateRequests\RoleCreateRequest;
use App\Http\Requests\UpdateRequests\PermissionUpdateRequest;
use App\Http\Requests\UpdateRequests\RoleUpdateRequest;
use App\Transformers\RoleTransformer;
use App\Transformers\UserTransformer;

/**
 * Created by PhpStorm.
 * User: uyutthy
 * Date: 1/15/2020
 * Time: 09:19
 */

class RoleController extends BaseController
{
    private $roleService;

    protected $transformer = RoleTransformer::class;

    public function __construct(RoleServiceInterface $roleService)
    {
        $this->roleService = $roleService;
    }

    public function index()
    {
        $result = $this->roleService->getByPaginate();
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function store(RoleCreateRequest $roleCreateRequest)
    {
        $result = $this->roleService->insert($roleCreateRequest);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function update(RoleUpdateRequest $roleUpdateRequest, $id)
    {
        $result = $this->roleService->update($roleUpdateRequest, $id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function show($id)
    {
        $result = $this->roleService->getById($id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function edit($id)
    {
        $result = $this->permissionService->getById($id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function destroy($id)
    {
        $result = $this->permissionService->delete($id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

}