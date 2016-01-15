<?php

namespace CodeProject\Http\Controllers;

use Illuminate\Http\Request;
use CodeProject\Client;
use CodeProject\Http\Requests;
use CodeProject\Http\Controllers\Controller;

class ClientController extends Controller
{
    public function index()
    {
    	 return (Client::all());
    }

    public function store(Request $request)
    {
    	return (Client::create($request->all()));
    }

    public function show($id)
    {
    	return (Client::find($id));
    }

    public function destroy($id)
    {
    	Client::find($id)->delete();
    }

    public function update(Request $request, $id)
    {
    	$client = Client::find($id);
    	$client->name = $request->name;
    	$client->responsible = $request->responsible;
    	$client->email = $request->email;
    	$client->phone = $request->phone;
    	$client->address = $request->address;
    	$client->obs = $request->obs;
    	$client->save();
    }

}

