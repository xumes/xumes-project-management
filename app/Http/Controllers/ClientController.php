<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;
use CodeProject\Http\Requests;

class ClientController extends Controller
{
    /**
     * @var ClientRepository
     */
    private $repository;
    /**
     * @var ClientService
     */
    private $service;
    public function __construct(ClientRepository $repository, ClientService $service){
        $this->repository = $repository;
        $this->service = $service;
    }
    public function index(Request $request)
    {
        $limit = $request->get('limit', 15);
        return $this->repository->paginate($limit);
    }
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }
    public function show($id)
    {
        return $this->repository->find($id);
    }
    public function edit($id)
    {
        return $this->repository->find($id);
    }
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }
    public function destroy($id)
    {
        try{
            $this->repository->delete($id);
        }catch (Exception $e){
            return ['error' => 'Existe um projeto(s) vinculado a este cliente'];
        }
    }
}