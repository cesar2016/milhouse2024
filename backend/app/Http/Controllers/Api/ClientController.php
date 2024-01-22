<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ClientsImport;
use App\Models\Client;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return $clients;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;
        $request->validate([

            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            // 'dni' => 'min:8|max:11|unique:clients',
            'address',
            'city',
            'phone' => 'string|unique:clients',
            //'email'=> 'email|unique:clients',
            'status' => 'required'
        ]);

        $client = Client::create($request->all());

        return $client;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return $client;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        //return $client;
        //dd($request);
        $request->validate([

            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            //'dni' => 'min:8|max:11|unique:clients,dni,'.$client->id,
            'address',
            'city',
            'phone' => 'string|unique:clients,phone,'.$client->id,
            //'email'=> 'email|unique:clients,email,'.$client->id,
            'status' => 'required',

        ]);

        $client->update($request->all());
        return $client;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return $client;
    }

    /// # MANEJOS del EXcel
    public function import_sheet_excel_clients(Request $request)
    {

        $file = $request->file('file');

        Excel::import(new ClientsImport, $file);

        return response()->json(['msg'=>'success', 'Listado de productos importados con exito!']);



    }

}
