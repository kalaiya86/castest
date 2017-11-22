<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestModel;
use App\ProductModel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,TestModel $testM,ProductModel $productM)
    {
        //
        $tmp = $request->all(); 
        if(!empty($tmp['cas']) || !empty($tmp['product_name'])) {
            $param_product = [];
            if(!empty($tmp['cas'])) $param_product[] = ['cas', '=', $tmp['cas']];
              ;
            if(!empty($tmp['product_cname'])) $param_product[] = ['product_cname', '=', $tmp['cas']];
              ;
            $product_tmp = $productM::getProducts(['id','bncode','cas','product_ename','product_cname'],$param_product);
            if(!empty($product_tmp)) $tmps = array_column($product_tmp, column_key);
        }
        
        $param = [
            ['test_time', '>', $tmp['startDate']],
            ['test_time', '<=', $tmp['endDate']],
        ];
        if(!empty($tmp['bncode'])) $param[] =  ['bncode', 'like', '%'.$tmp['bncode'].'%'];
         //[$tmp['startDate'],$tmp['endDate']];
        $data = $testM::getTests(['id','bncode','product_id','appearance','purity','condition','spectrogram','test_time'],$param);
        $products = $productM::getProducts(['id','bncode','cas','product_ename','product_cname']);
        //$imgurl = Storage::url();
        
        return ['data'=>$data,'products'=>$products];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TestModel $testM,ProductModel $productM)
    {
        //
        $products = $productM::getProducts(['id','bncode','cas','product_ename','product_cname']);
        return view('test.create',compact('data','products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,TestModel $testM)
    {
        //
        $input = $request->all();
        
        if($testM::create($input))
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
    public function show(TestModel $testM,$id)
    {
        //
        $info = $testM->find($id);
        return $info;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TestModel $testM,ProductModel $productM, $id)
    {
        //
        $info = $testM->find($id);
        
        $products = $productM::getProducts(['id','bncode','cas','product_ename','product_cname']);
        return view('test.create',compact('info','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TestModel $testM, $id)
    {
        $input = $request->all();
        $model = $testM->find($id);
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
    public function destroy(TestModel $testM, $id)
    {
        //
          if($testM->destroy($id))
            return $this->returnData(['respCode'=>'000']);
        else
            return $this->returnData(['respCode'=>'457']);
         
    }
}
