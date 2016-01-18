<?php
/**
 * Created by PhpStorm.
 * User: regin
 * Date: 18/01/2016
 * Time: 18:18
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ClientValidator extends LaravelValidator
{
 protected $rules = [
    'name'          => 'required|max:255',
    'responsible'   => 'required|max:255',
    'email'         => 'required|email',
    'phone'         => 'required',
    'address'       => 'required'
    ];
}