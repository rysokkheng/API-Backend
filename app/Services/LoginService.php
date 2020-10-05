<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 14:44
 */

namespace App\Services;


use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\LoginServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Helpers\PBKDF2;
use App\User;
use App\Validators\UserValidator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginService extends BaseService implements LoginServiceInterface
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login($username, $password){
        $user = $this->userService->getUserByUsername($username);
        if ($user && $user->id) {
            if(Str::contains($user->password, '==:') && Str::endsWith($user->password, '==')) {
                if (PBKDF2::validatePassword($password, $user->password)) {
                    if(Auth::loginUsingId($user->id)){
                        $user = Auth::user();
                        $token =  $user->createToken($user->username.'/'.$user->password)->accessToken;
                        return $this->getSuccessResponseArray(__('login_success'), $token);
                    }
                }
            }else{
                if(
                    Auth::attempt(
                        [
                            'username' => $username,
                            'password' => $password,
                            User::RECORD_STATUS_FIELD => User::RECORD_STATUS_ACTIVE
                        ]
                    )
                )
                {
                    $user = Auth::user();
                    $token =  $user->createToken($user->username.'/'.$user->password)->accessToken;
                    return $this->getSuccessResponseArray(__('login_success'), $token);
                }
            }
        }
        return $this->getErrorResponseArray(Response::HTTP_UNAUTHORIZED, __('login_fail'));
    }

}