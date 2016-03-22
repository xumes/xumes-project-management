<?php
/**
 * Created by PhpStorm.
 * User: regin
 * Date: 18/01/2016
 * Time: 18:18
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{
 protected $rules = [
    'owner_id'    => 'required|integer',
    'client_id'   => 'required|integer',
    'name'        => 'required|max:255',
    'progress'    => 'required|between:0,100',
    'status'      => 'required|in:0,1,2',
     'due_date'   => 'required|date'
    ];
}