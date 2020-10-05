<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Services\LoginService;

/**
 * Created by PhpStorm.
 * User: uyutthy
 * Date: 1/15/2020
 * Time: 09:19
 */

class LoginController extends BaseController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        $username = request('username');
        $password = request('password');
        $result = $this->loginService->login($username, $password);
        return response()->json($result, $result['http_code']);
    }

}