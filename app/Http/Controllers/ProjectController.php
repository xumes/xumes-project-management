<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;


class ProjectController extends Controller
{
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * ProjectController constructor.
     * @param ProjectRepository $repository
     */
    public function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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
