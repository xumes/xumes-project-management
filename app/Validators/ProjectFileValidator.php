<?php
namespace CodeProject\Validators;
use Prettus\Validator\LaravelValidator;

class ProjectFileValidator extends LaravelValidator
{
    protected $rules  = [
        'project_id'    =>  'required',
        'name'          =>  'required',
        'description'   =>  'required',
        'file'          =>  'required|mimes:jpg,jpeg,png,gif,zip'
    ];
}
?>