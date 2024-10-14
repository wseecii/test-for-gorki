<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserLoginRequest;
use App\Http\Requests\Users\UserRegisterRequest;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
    )
    {
        parent::__construct();
    }

    /**
     * @param UserRegisterRequest $request
     * @return ResponseFactory|Application|Response
     */
    public function register(UserRegisterRequest $request): ResponseFactory|Application|Response
    {
        $model = $this->userRepository->new(
            $request->get('login'),
            $request->get('password'),
            $request->get('firstName'),
            $request->get('surname'),
            $request->get('lastName'),
        );

        return $this->ok(['userId' => $model->id]);
    }

    /**
     * @param UserLoginRequest $request
     * @return ResponseFactory|Application|Response
     */
    public function login(UserLoginRequest $request): ResponseFactory|Application|Response
    {
        $attempt = Auth::attempt([
            'login' => $request->get('login'),
            'password' => $request->get('password'),
        ], true);

        if (!$attempt) {
            return $this->fail(['message' => __('messages.users.login_fail')], 401);
        }

        $user = Auth::user();

        if ($user === null) {
            return $this->fail(['message' => __('messages.users.login_fail')], 401);
        }

        $accessToken = $user->createToken('Main')->accessToken;

        return $this->ok([
            'message' => __('messages.users.login_ok'),
            'accessToken' => $accessToken,
        ]);
    }
}
