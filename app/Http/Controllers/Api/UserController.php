<?php
namespace App\Http\Controllers\Api;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\CreateRequests\UserCreateRequest;
use App\Http\Requests\UpdateRequests\UserUpdateRequest;
use App\Transformers\UserTransformer;

/**
 * Created by PhpStorm.
 * User: uyutthy
 * Date: 1/15/2020
 * Time: 09:19
 */

class UserController extends BaseController
{
    private $userService;

    protected $transformer = UserTransformer::class;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $result = $this->userService->getByPaginate();
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function store(UserCreateRequest $userCreateRequest)
    {
        $result = $this->userService->insert($userCreateRequest);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function update(UserUpdateRequest $userUpdateRequest, $id)
    {
        $result = $this->userService->update($userUpdateRequest, $id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function show($id)
    {
        $result = $this->userService->getById($id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function edit($id)
    {
        $result = $this->userService->getById($id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

    public function destroy($id)
    {
        $result = $this->userService->delete($id);
        $result['data'] = $this->transform($result['data'])->getArray();
        return response()->json($result, $result['http_code']);
    }

}
