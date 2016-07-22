<?php namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'responsible',
        'email',
        'phone',
        'address',
        'obs'
    ];

    public $timestamps = true;

    public function project()
    {
        return $this->hasMany('App\Entities\Project', 'client_id', 'id');
    }

}
