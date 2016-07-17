<?php
namespace CodeProject\Validators;
use Prettus\Validator\LaravelValidator;

class ProjectMembersValidator extends LaravelValidator
{
    protected $rules  = [
        'project_id'  => 'required|integer',
        'member_id'   => 'required|integer'
    ];

}
?>