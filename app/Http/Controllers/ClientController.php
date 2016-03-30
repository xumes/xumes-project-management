<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Services\ClientService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * ClientController constructor.
     * @param ClientRepository $repository
     * @param ClientService $service
     */
    public function __construct(ClientRepository $repository, ClientService $service)
    {
        $this->repository=$repository;
        $this->service = $service;
    }

    public function index()
    {
    	 return $this->repository->all();
    }

    public function store(Request $request)
    {
    	return $this->service->create($request->all());

    }

    public function show($id)
    {

        try {
            $client = $this->repository->find($id);
            return ['success'=>true, $client];
        } catch (QueryException $e) {
            return ['error'=>true, 'To be defined.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Client not found.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Client not found.'];
        }
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {

        try {
            $this->repository->delete($id);
            return ['success'=>true, 'Client deleted successfully!'];
        } catch (QueryException $e) {
            return ['error'=>true, 'Client could not be deleted. There are projects related to him.'];
        } catch (ModelNotFoundException $e) {
            return ['error'=>true, 'Client not fount.'];
        } catch (\Exception $e) {
            return ['error'=>true, 'Sorry, there is an error when try to delete this client.'];
        }
    }

    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(), $id);
    }

}