<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\Backend\Access\User\UserCreated;
use App\Events\Backend\Access\User\UserUpdated;
use App\Http\Resources\UserResource;
use App\Models\Access\User\User;
use App\Repositories\Backend\Access\User\UserRepository;
use Illuminate\Http\Request;
use Validator;

class DeletedUsersController extends APIController
{
    protected $repository;
    /**
     * __construct.
     *
     * @param $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     *  Return the  deleted users.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('paginate') ? $request->get('paginate') : 25;

        return UserResource::collection(
            $this->repository->getForDataTable(0, true)->paginate($limit)
        );
    }
   
}
