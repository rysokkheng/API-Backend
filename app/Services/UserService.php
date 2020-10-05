<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:44
 */

namespace App\Services;


use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Criteria\RecordStatusCriteria;
use App\Enums\DateFormatEnum;
use App\Http\Requests\CreateRequests\UserCreateRequest;
use App\Http\Requests\UpdateRequests\UserUpdateRequest;
use App\Models\Role;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends SimpleService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository   = $userRepository;
    }

    public function getUserByUsername($username)
    {
        $user = $this->repository()->findWhere([
            'username' => $username,
            $this->repository()->model()::RECORD_STATUS_FIELD => $this->repository()->model()::RECORD_STATUS_ACTIVE
         ])->first();
        return $user;
    }

    public function getByPaginate()
    {
        $recordStatusCriteria = new RecordStatusCriteria();
        $result = $this->repository()
            ->pushCriteria($recordStatusCriteria)
            ->paginate();

        return $this->getSuccessResponseArray(__('success'), $result);
    }

    public function getAll($columns = ['*'])
    {
        $result = $this->repository()->findWhere([$this->repository()->model()::RECORD_STATUS_FIELD => $this->repository()->model()::RECORD_STATUS_ACTIVE], $columns);
        return $this->getSuccessResponseArray(__('success'), $result);
    }

    public function insert(UserCreateRequest $request)
    {
        DB::beginTransaction();
        try
        {
            $date = date(DateFormatEnum::YmdHis);
            $request->merge([
                'password'      => Hash::make($request->get('password')),
                $this->repository()->model()::CREATED_AT_FIELD   => $date,
                $this->repository()->model()::CREATED_BY_FIELD   => Auth::id(),
                $this->repository()->model()::UPDATED_AT_FIELD  => $date,
                $this->repository()->model()::UPDATED_BY_FIELD  =>Auth::id(),
                $this->repository()->model()::RECORD_STATUS_FIELD=>$this->repository()->model()::RECORD_STATUS_ACTIVE
            ]);

            $user = $this->repository()->create($request->toArray());
            $user->attachRoles($request->get('roles'));

            DB::commit();
            return $this->getSuccessResponseArray(__('global.save_success'), $user);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    public function update(UserUpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try
        {
            if (!empty($request->get('password'))) {
                $request->merge(['password' => Hash::make($request->get('password'))]);
            } else {
                $request = collect($request->except('password'));
            }
            $date = date(DateFormatEnum::YmdHis);
            $request->merge([
                $this->repository()->model()::UPDATED_AT_FIELD => $date,
                $this->repository()->model()::UPDATED_BY_FIELD => Auth::id(),
            ]);

            $user = $this->repository()->update($request->toArray(), $id);
            $user->roles()->sync($request->get('roles'));

            DB::commit();
            return $this->getSuccessResponseArray(__('global.update_success'), $user);
        }catch(\Exception $e){
            DB::rollBack();
            return $this->getErrorResponseArray(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    public function repository()
    {
        return $this->userRepository;
    }

    public function delete($id)
    {
        return $this->deleteData($id);
    }
}