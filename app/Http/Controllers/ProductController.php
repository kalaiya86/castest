<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductModel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,ProductModel $productM)
    {
        //
        $param = [];
        $tmp = $request->all();

        $data = $productM::getProducts(['id','bncode','cfnum','cas','product_ename','product_cname']);
        if(isset($tmp['startDate']) && !empty($tmp['startDate'])) $param[] = ['test_time', '>', $tmp['startDate']];
        if(isset($tmp['endDate']) && !empty($tmp['endDate']))   $param[] =  ['test_time', '<=', $tmp['endDate']];
        
        if(isset($tmp['bncode']) && !empty($tmp['bncode'])) $param[] =  ['bncode', 'like', '%'.$tmp['bncode'].'%'];
         
        $products = $productM::getProducts(['id','bncode','cas','product_ename','product_cname'],$param);
        
        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,ProductModel $productM)
    {
        //
        $input = $request->all();
        
        if($productM::create($input))
            return $this->returnData(['respCode'=>'000']);
        else
            return $this->returnData(['respCode'=>'457']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ProductModel $productM,$id)
    {
        //
        $info = $productM->find($id);
        return view('product.view',compact('info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductModel $productM,$id)
    {
        //
        $info = $productM->find($id);
        return view('product.create',compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductModel $productM, $id)
    {
        //
        $input = $request->all();
        $model = $productM->find($id);
        $model->fill($input);
        if($model->save())
            return $this->returnData(['respCode'=>'000']);
        else
            return $this->returnData(['respCode'=>'457']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductModel $productM, $id)
    {
        //
        if($productM->destroy($id))
            return $this->returnData(['respCode'=>'000']);
        else
            return $this->returnData(['respCode'=>'457']);
    }
}
