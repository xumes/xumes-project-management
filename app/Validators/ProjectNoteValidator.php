<?php
/**
 * Created by PhpStorm.
 * User: regin
 * Date: 18/01/2016
 * Time: 18:18
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
 protected $rules = [
    'project_id'    => 'required|integer',
    'title'         => 'required|max:255',
    'note'          => 'required'

    ];
}