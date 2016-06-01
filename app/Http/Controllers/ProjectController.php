<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectService;
use CodeProject\Http\Requests;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectTaskRepository
     */
    private $taskRepository;
    /**
     * @var ProjectService
     */
    private $service;
    /**
     * ProjectController constructor.
     * @param ProjectRepository $repository
     * @param ProjectService $service
     * @param ProjectTaskRepository $taskRepository
     */
<<<<<<< HEAD
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
=======
    public function __construct(ProjectRepository $repository, ProjectService $service, ProjectTaskRepository $taskRepository)
        {
        $this->repository=$repository;
>>>>>>> backend
        $this->service = $service;
        $this->taskRepository = $taskRepository;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->repository->findWhere(['owner_id' => \Authorizer::getResourceOwnerId()]);
    }

    /**
     * @param $id
     * @return Response
     */
    public function show($id)
    {

        if ($this->checkProjectPermissions($id) == false) {
            return ['error' => 'Access Forbidden'];
        }


        try {
            $project = $this->repository->find($id);
            return ['success' => true, $project];
        } catch (QueryException $e) {
            return ['error' => true, 'To be defined.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Project not found.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Project not found.'];
        }
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request, $id)
    {
        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access Forbidden'];
        }

        $this->service->update($request->all(), $id);
        return $this->repository->find($id);
    }

    public function destroy($id)
    {

        if ($this->checkProjectOwner($id) == false) {
            return ['error' => 'Access Forbidden'];
        }

<<<<<<< HEAD
        try {
            $this->repository->delete($id);
            return ['success' => true, 'Project deleted successfully!'];
        } catch (QueryException $e) {
            return ['error' => true, 'Project could not be deleted. There are projects related to him.'];
        } catch (ModelNotFoundException $e) {
            return ['error' => true, 'Project not fount.'];
        } catch (\Exception $e) {
            return ['error' => true, 'Sorry, there is an error when try to delete this project.'];
        }
=======

        $this->repository->delete($id);

    }

    public function members($id)
    {

            if(!$this->checkProjectOwner($id)){
                return ['error'=> 'Access Forbidden'];
            }
            $members = $this->repository->find($id)->members()->get();
            if (count($members)) {
                return $members;
            }
        return ['error'=> 'This Project has no member'];

    }
    public function addMember($project_id, $user_id)
    {

            if(!$this->checkProjectOwner($project_id)){
                return $this->erroMsgm("O usuário não tem acesso a esse projeto");
            }
            return $this->service->addMember($project_id, $user_id);

    }
    public function removeMember($project_id, $user_id)
    {

            if(!$this->checkProjectOwner($project_id)){
                return $this->erroMsgm("O usuário não tem acesso a esse projeto");
            }
            return $this->service->removeMember($project_id, $user_id);

    }
    public function tasks($id)
    {

            if(!$this->checkProjectOwner($id)){
                return $this->erroMsgm("O usuário não tem acesso a esse projeto");
            }
            $tasks = $this->taskRepository->find(['project_id' => $id]);
            if (count($tasks)) {
                return $tasks;
            }
            return $this->erroMsgm('Esse projeto ainda não tem tarefas.');

    }
    public function addTask(Request $request)
    {

            return $this->taskRepository->create($request->all());

    }
    public function removeTask($project_id, $task_id)
    {

            if(!$this->checkProjectOwner($project_id)){
                return $this->erroMsgm("O usuário não tem acesso a esse projeto");
            }
            $this->taskRepository->find($task_id)->delete();
            return ['success'=>true, 'message'=>'Tarefa deletada com sucesso!'];

>>>>>>> backend
    }

    /**
     * @param $projectId
     * @return array
     */
    private function checkProjectOwner($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->isOwner($projectId, $userId);

    }

    private function checkProjectMember($projectId)
    {
        $userId = \Authorizer::getResourceOwnerId();

        return $this->repository->hasMember($projectId, $userId);
    }

    private function checkProjectPermissions($projectId)
    {
        if ($this->checkProjectOwner($projectId) || $this->checkProjectMember($projectId)) {
            return true;
        }

        return false;
    }


}
