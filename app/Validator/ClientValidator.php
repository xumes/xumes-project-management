<?php

namespace App\Validator;

use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{

    protected $rules = [
        'name' => 'required|max:255',
        'responsible' => 'required|max:255',
        'phone' => 'required',
        'address' => 'required'
    ];


}