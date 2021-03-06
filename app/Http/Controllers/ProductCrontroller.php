<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Session;
use Hash;
use Auth;

class ProductCrontroller extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){


        return view('product.show');
    }
    public function insert(Request $r){

        $product = new Product();
        $product->productName = $r->productName;
        $product->ratePerUnit = $r->ratePerUnit;
        $product->status = $r->status;
        $product->save();
        Session::flash('message', 'Product Insert Successfully!');
        return back();
    }
    public function edit(Request $r){
        $product = Product::select('*')
            ->where('productId', $r->id)
            ->first();
        return view('product.edit', compact('product'));
    }

    public function update(Request $r , $id){
        $product = Product::findOrFail($id);
        $product->productName = $r->productName;
        $product->ratePerUnit = $r->ratePerUnit;
        $product->status = $r->status;
        $product->save();
        Session::flash('message', 'Product Updated Successfully!');
        return back();
    }

    public function getData(Request $r){
        $product = Product::select('*');

        $datatables = Datatables::of($product);
        return $datatables->make(true);
    }
}
