<?php
/**
 * Created by PhpStorm.
 * User: regin
 * Date: 17/01/2016
 * Time: 01:14
 */

namespace CodeProject\Repositories;

use CodeProject\Entities\Client;
use Prettus\Repository\Eloquent\BaseRepository;

class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    public function model()
    {
        return Client::class;
    }
}