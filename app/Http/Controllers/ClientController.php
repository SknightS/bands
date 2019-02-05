<?php

namespace App\Http\Controllers;
use App\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Session;
use Hash;
use Auth;

class ClientController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){


        return view('client.show');
    }
    public function insert(Request $r){

        $client = new Client();
        $client->clientName = $r->clientName;
        $client->address = $r->address;
        $client->email = $r->email;
        $client->phone = $r->phone;
        $client->company = $r->company;
        $client->save();
        Session::flash('message', 'Client Insert Successfully!');
        return back();
    }
    public function edit(Request $r){
        $client = Client::select('client.*')
            ->where('clientId', $r->id)
            ->first();
        return view('client.edit', compact('client'));
    }

    public function update(Request $r , $id){
        $client = Client::findOrFail($id);
        $client->clientName = $r->clientName;
        $client->address = $r->address;
        $client->email = $r->email;
        $client->phone = $r->phone;
        $client->company = $r->company;
        $client->save();
        Session::flash('message', 'Client Updated Successfully!');
        return back();
    }

    public function getData(Request $r){
        $client = Client::select('client.*');

        $datatables = Datatables::of($client);
        return $datatables->make(true);
    }
}
