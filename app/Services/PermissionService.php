<?php
/**
 * Created by PhpStorm.
 * User: RySokkheng
 * Date: 1/10/2020
 * Time: 09:19
 */

namespace App\Services;

use App\Contracts\Repositories\PermissionRepositoryInterface;
use App\Contracts\Services\PermissionServiceInterface;
use App\Enums\DateFormatEnum;
use App\Http\Requests\CreateRequests\PermissionCreateRequest;
use App\Http\Requests\UpdateRequests\PermissionUpdateRequest;
use App\Models\BaseModel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PermissionService extends SimpleService implements PermissionServiceInterface
{
    private $permissionRepository;
    public $hasRecordStatus = false;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function insert(PermissionCreateRequest $permissionCreateRequest)
    {

        $date = Carbon::now()->toDateTime()->format(DateFormatEnum::YmdHis);
        $requests = collect($permissionCreateRequest)->merge([
            $this->repository()->model()::CREATED_AT_FIELD => $date,
            $this->repository()->model()::UPDATED_AT_FIELD => $date,
            $this->repository()->model()::CREATED_BY_FIELD => Auth::id(),
            $this->repository()->model()::UPDATED_BY_FIELD => Auth::id()
        ]);
        return $this->insertData($requests);
    }

    public function update(PermissionUpdateRequest $permissionUpdateRequest, $id)
    {
        $date = Carbon::now()->toDateTime()->format(DateFormatEnum::YmdHis);
        $requests = collect($permissionUpdateRequest)->merge([
            $this->repository()->model()::UPDATED_AT_FIELD => $date,
            $this->repository()->model()::UPDATED_BY_FIELD => Auth::id()
        ]);
        return $this->updateData($requests, $id);
    }

    public function repository()
    {
        return $this->permissionRepository;
    }

    public function delete($id)
    {
        return $this->destroyData($id);
    }
}
