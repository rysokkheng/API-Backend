<?php
namespace App\Http\Controllers\Api;
use App\Contracts\Services\PermissionServiceInterface;
use App\Http\Requests\CreateRequests\PermissionCreateRequest;
use App\Http\Requests\UpdateRequests\PermissionUpdateRequest;
use App\Transformers\PermissionTransformer;
use App\Transformers\UserTransformer;

/**
 * Created by PhpStorm.
 * User: RySokkheng
 * Date: 1/10/2020
 * Time: 09:19
 */

class PermissionController extends BaseController
{
    private $permissionService;

    protected $transformer = PermissionTransformer::class;

    public function __construct(PermissionServiceInterface $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        $result = $this->permissionService->getByPaginate();
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function store(PermissionCreateRequest $permissionCreateRequest)
    {
        $result = $this->permissionService->insert($permissionCreateRequest);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function update(PermissionUpdateRequest $permissionUpdateRequest, $id)
    {
        $result = $this->permissionService->update($permissionUpdateRequest, $id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function show($id)
    {
        $result = $this->permissionService->getById($id);
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
