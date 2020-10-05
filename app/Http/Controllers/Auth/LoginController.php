<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\Services\UserServiceInterface;
use App\Helpers\PBKDF2;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    private $userService;

    /**
     * Create a new controller instance.
     *
     * @param UserServiceInterface $userService
     */
    public function __construct(UserServiceInterface $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    /**
     * Use Username as username
     * By Defail lavel will use Email
     * @return string
     */
    public function username()
    {

        return 'username';
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->to(route('login'))
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => __('auth.failed')
            ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $username   = $request->get('username');
        $password   = $request->get('password');
        $user = $this->userService->getUserByUsername($username);
        if ($user) {
            if(Str::contains($user->password, '==:') && Str::endsWith($user->password, '==')) {
                if (PBKDF2::validatePassword($password, $user->password)) {
                    $this->guard()->login($user, $request->has('remember'));
                    return true;
                }
            }else{
                $arrActiveStatus = [
                    User::RECORD_STATUS_FIELD => User::RECORD_STATUS_ACTIVE
                ];
                $requestData = $this->credentials($request) + $arrActiveStatus;
                return $this->guard()->attempt(
                    $requestData, $request->filled('remember')
                );
            }
        }
        return false;
    }



}
