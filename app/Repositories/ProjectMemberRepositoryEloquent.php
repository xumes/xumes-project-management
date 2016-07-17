<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectMembers;
use CodeProject\Presenters\ProjectMemberPresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectMemberRepositoryEloquent extends BaseRepository implements ProjectMemberRepository
{
    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
    public function Model(){
        return ProjectMembers::class;
    }
    public function presenter(){
        return ProjectMemberPresenter::class;
    }
}