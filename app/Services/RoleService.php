<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:44
 */

namespace App\Services;

use App\Contracts\Repositories\RoleRepositoryInterface;
use App\Contracts\Services\RoleServiceInterface;
use App\Enums\DateFormatEnum;
use App\Http\Requests\CreateRequests\RoleCreateRequest;
use App\Http\Requests\UpdateRequests\RoleUpdateRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleService extends SimpleService implements RoleServiceInterface
{
    private $roleRepository;
    public $hasRecordStatus = false;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function insert(RoleCreateRequest $roleCreateRequest)
    {
        DB::beginTransaction();
        try{
            $date = Carbon::now()->toDateTime()->format(DateFormatEnum::YmdHis);
            $requests = collect($roleCreateRequest)->merge([
                $this->repository()->model()::CREATED_AT_FIELD => $date,
                $this->repository()->model()::UPDATED_AT_FIELD => $date,
                $this->repository()->model()::CREATED_BY_FIELD => Auth::id(),
                $this->repository()->model()::UPDATED_BY_FIELD => Auth::id()
            ]);

            $role = $this->repository()->create($requests->all());
            $role->attachPermissions($roleCreateRequest->get('permissions'));

            DB::commit();
            return $this->getSuccessResponseArray(__('global.save_success'), $role);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    public function update(RoleUpdateRequest $roleUpdateRequest, $id)
    {
        DB::beginTransaction();
        try{
            $date = Carbon::now()->toDateTime()->format(DateFormatEnum::YmdHis);
            $requests = collect($roleUpdateRequest)->merge([
                $this->repository()->model()::UPDATED_AT_FIELD => $date,
                $this->repository()->model()::UPDATED_BY_FIELD => Auth::id()
            ]);

            $role = $this->repository()->update($request->all(), $id);
            $role->perms()->sync($request->get('permissions'));

            return $this->getSuccessResponseArray(__('global.update_success'), $role);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    public function repository()
    {
        return $this->roleRepository;
    }

    public function delete($id)
    {
        return $this->destroyData($id);
    }
}
