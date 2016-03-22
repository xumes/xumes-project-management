<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;


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
        $this->repository=$repository;
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        return $this->repository->all();
    }

    public function show($id)
    {
        return $this->repository->find($id);
    }

    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    public function update(Request $request, $id)
    {
        $this->service->update($request->all(), $id);
        return $this->repository->find($id);
    }

    public function destroy($id)
    {
        return $this->repository->delete($id);
    }
}
