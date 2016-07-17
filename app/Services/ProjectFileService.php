<?php
namespace CodeProject\Services;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectFileRepository;
use CodeProject\Validators\ProjectFileValidator;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Contracts\Filesystem\Factory as Storage;
use Illuminate\Filesystem\Filesystem;

class ProjectFileService
{
    protected $repository;
    protected $projectRepository;
    protected $validator;
    protected $storage;
    protected $filesystem;

    public function __construct(ProjectFileRepository $repository, ProjectRepository $projectRepository,
                                ProjectFileValidator $validator, Storage $storage, Filesystem $filesystem)
    {
        $this->repository           = $repository;
        $this->validator            = $validator;
        $this->projectRepository    = $projectRepository;
        $this->storage              = $storage;
        $this->filesystem           = $filesystem;
    }

    public function create(array $data)
    {
       // dd($data);
        try{
            $this->validator->with($data)->passesOrFail();

            $project = $this->projectRepository->skipPresenter()->find($data['project_id']);
           // dd($project);
            $projectFile = $project->files()->create($data);
            $this->storage->put($projectFile->id.".".$data['extension'], $this->filesystem->get($data['file']));

            return $projectFile;
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


    public function destroy($id){

        $projectFile = $this->repository->skypPresenter()->find($id)->project_id;
        if($this->storage->exists($projectFile.id.'.'.$projectFile.extension)){
            $this->storage->delete($projectFile.id.'.'.$projectFile.extension);
            return $projectFile->delete();
        }else{
            return array('success' => false);
        }
    }

    public function getFilePath($id)
    {
        $projectFile = $this->repository->skipPresenter()->find($id);
        return $this->getBaseURL($projectFile);
    }

    public function getBaseURL($projectFile)
    {
        switch($this->storage->getDefaultDriver()){
            case 'local':
                    return $this->storage->getDrive();
        }

        return $this->storage->getDriver()->getAdapter()->getPathPrefix()
            .'/'.$projectFile->id.'.'.$projectFile->extension;
    }

    public function checkProjectOwner($projectFileId)
    {
        $id_usu     =  \Authorizer::getResourceOwnerId();
        $project_id =  $this->repository->skypPresenter()->find($projectFileId)->project_id;

        return $this->projectRepository->isOwner($project_id, $id_usu);
    }

    public function checkProjectMember($projectFileId)
    {
        $id_usu =  \Authorizer::getResourceOwnerId();
        $project_id =  $this->repository->skypPresenter()->find($projectFileId)->project_id;
        return $this->projectRepository->hasMember($project_id, $id_usu);
    }

    public function checkProjectPermissions($projectFileid)
    {
        if($this->checkProjectOwner($projectFileid) || $this->checkProjectMember($projectFileid)){
            return true;
        }

        return false;
    }

}