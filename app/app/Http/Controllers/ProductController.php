<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use App\Models\Category;
use GuzzleHttp\Client;
//use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

    }
    public function index(Request $request)
    {
        $token = $request->cookie('facturea_token');
        $response = $this->client->request('GET','products', [
        'headers' => [ 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token ],
        //'body' => json_encode($data),
        ]);

        $token = $request->cookie('facturea_token');
        $response_categories = $this->client->request('GET','categories', [
        'headers' => [ 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token ],
        //'body' => json_encode($data),
        ]);

        $token = $request->cookie('facturea_token');
        $response_brandProducts = $this->client->request('GET','brandProducts', [
        'headers' => [ 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token ],
        //'body' => json_encode($data),
        ]);


        $products = json_decode($response->getBody(), true);
        $categories = json_decode($response_categories->getBody(), true);
        $brandProducts = json_decode($response_brandProducts->getBody(), true);


        //$products = ['nombre' => 'cesar sanchez', 'edad'=> 40];
        return view('products')
        ->with('products',$products)
        ->with('categories',$categories)
        ->with('brandProducts',$brandProducts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function import_excel_products(Request $request)
    {


        $file = $request->file('file_products');



        $token = $request->cookie('facturea_token');
        $response_products_import = $this->client->request('POST','import_sheet_excel', [
        'headers' => [ 'Accept' => 'application/json', 'Authorization' => 'Bearer ' . $token ],

        'multipart' => [
                [
                    'name'     => 'FileContents',
                    'contents' => file_get_contents($file)
            ]
            ]

        ]);



        return json_decode($response_products_import->getBody(), true);
    }
}
