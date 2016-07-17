<?php
namespace CodeProject\Services;
use CodeProject\Repositories\ProjectMembersRepository;
use CodeProject\Validators\ProjectMembersValidator;
use Prettus\Validator\Exceptions\ValidatorException;
class ProjectMembersService
{
    protected $repository;
    protected $validator;

    public function __construct(ProjectMembersRepository $repository, ProjectMembersValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function create(array $dados)
    {
        try{
            $this->validator->with($dados)->passesOrFail();
            return $this->repository->create($dados);
        }catch( ValidatorException $e){
            return [
                'error'    => true,
                'message' => $e->getMessageBag()
            ];
        }
        
    }

    public function update(array $dados, $id)
    {
         try{
            return $this->repository->update($dados, $id);
        }catch( ValidatorException $e){
            return [
                'error'    => true,
                'message' => $e->getMessageBag()
            ];
        }

    }

    private function isMember($id)
    {
        $id_usu =  \Authorizer::getResourceOwnerId();
        return $this->repository->hasMember($id, $id_usu);
    }


}