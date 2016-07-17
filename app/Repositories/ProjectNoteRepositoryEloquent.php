<?php

namespace CodeProject\Repositories;

use CodeProject\Entities\ProjectNote;
use CodeProject\Presenters\ProjectNotePresenter;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectNoteRepositoryEloquent extends BaseRepository implements ProjectNoteRepository
{
    public function Model(){
        return ProjectNote::class;
    }
    public function presenter()
    {
        return ProjectNotePresenter::class;
    }
}
