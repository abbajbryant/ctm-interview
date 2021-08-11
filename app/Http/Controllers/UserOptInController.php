<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;


class UserOptInController extends Controller
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserOptInController constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse($this->user->get());
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        return new JsonResponse($user);
    }

    /**
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'email'         => 'required|email|unique:users',
            'opt_in'        => 'required|boolean',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
        ]);

        $user = $this->user->create($request->only([
            'first_name',
            'last_name',
            'opt_in',
            'email',
        ]));

        return new JsonResponse($user);
    }

    /**
     * @param User $user
     * @return JsonResponse
     */
    public function update(User $user, Request $request): JsonResponse
    {
        $this->validate($request, [
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'opt_in' => 'boolean',
            'first_name' => 'string',
            'last_name' => 'string',
       ]);

        $user->update($request->only([
            'first_name',
            'last_name',
            'opt_in',
            'email',
        ]));

        return new JsonResponse($user);
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();
        return new JsonResponse(["User deleted"], 410);
    }
}
