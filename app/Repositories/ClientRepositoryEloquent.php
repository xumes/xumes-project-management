<?php
/**
 * Created by PhpStorm.
 * User: regin
 * Date: 17/01/2016
 * Time: 01:14
 */

namespace CodeProject\Repositories;

use \CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;
use CodeProject\Presenters\ClientPresenter;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    protected $fieldSearchable = [
        'name'
    ];
    public function Model(){
        return Client::class;
    }
    public function presenter()
    {
        return ClientPresenter::class;
    }
    public function boot()
    {
        $this->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
    }
}