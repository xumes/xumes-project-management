<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectMembers;
use CodeProject\Entities\User;
use CodeProject\Presenters\ProjectMemberPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class UserRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
    public function Model(){
        return User::class;
    }
}