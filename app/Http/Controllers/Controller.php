<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    protected ?User $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    /**
     * @param array|AnonymousResourceCollection|JsonResource $data
     * @param int $httpCode
     * @param array $headers
     * @return ResponseFactory|Application|Response
     */
    final public function ok(array|AnonymousResourceCollection|JsonResource $data = [], int $httpCode = 200, array $headers = []): ResponseFactory|Application|Response
    {
        return $this->response(['status' => 'ok', 'response' => $data], $httpCode, $headers);
    }

    /**
     * @param array|AnonymousResourceCollection|JsonResource $data
     * @param int $httpCode
     * @param array $headers
     * @return ResponseFactory|Application|Response
     */
    final public function response(array|AnonymousResourceCollection|JsonResource $data = [], int $httpCode = 200, array $headers = []): ResponseFactory|Application|Response
    {
        return response($data, $httpCode, $headers);
    }

    /**
     * @param array|AnonymousResourceCollection|JsonResource $data
     * @param int $httpCode
     * @param array $headers
     * @return ResponseFactory|Application|Response
     */
    final public function fail(array|AnonymousResourceCollection|JsonResource $data = [], int $httpCode = 400, array $headers = []): ResponseFactory|Application|Response
    {
        return $this->response(['status' => 'fail', 'response' => $data], $httpCode, $headers);
    }
}
