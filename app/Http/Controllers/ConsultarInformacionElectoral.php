<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
class ConsultarInformacionElectoral extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $client = new Client();

// Login page
        $crawler = $client->request('GET', 'https://wsp.registraduria.gov.co/censo/_censoResultado.php?nCedula=&nCedulaH=&x=91&y=14');

// Select Login form
        //$form = $crawler->selectButton('Consultar');
        //echo $form;
        //$crawler = $client->click($crawler->selectLink('consultar.PNG')->link());
// Submit form
        //$crawler = $client->submit($form, array(
          //  'nCedulaH' => '1022353924'
        //));
        $configurationRows = $crawler->filter('tr');
        $configurationRows->each(function($configurationRow, $index) {

            $directive = $configurationRow->filter('td')->eq(1)->text();

            echo $directive;
        });

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
}
