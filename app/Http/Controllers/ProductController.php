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
    public function default(ProductModel $productM){
        $bncodes = $productM::getProductsbyGroup(['bncode'],[],'bncode');
        $cases = $productM::getProductsbyGroup(['cas'],[],'cas');
        $names = $productM::getProductsbyGroup(['product_cname'],[],'product_cname');
        
        return view('product.index',compact('bncodes','cases','names'));
    }

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
        
        if(isset($tmp['bncode']) && !empty($tmp['bncode'])) $param[] =  ['bncode', 'like', '%'.$tmp['bncode'].'%'];
        if(isset($tmp['cas']) && !empty($tmp['cas'])) $param[] =  ['cas', 'like', '%'.$tmp['cas'].'%'];
        if(isset($tmp['product_cname']) && !empty($tmp['product_cname'])) $param[] =  ['product_cname', 'like', '%'.$tmp['product_cname'].'%'];
         
        $dataObj = $productM::getProducts(['id','cfnum','bncode','cas','product_ename','product_cname'],$param);
        $total = $dataObj->count();
        $result = [
            'respCode' =>'000',
            'total'=> $total,
            'data'=>($total>0)?$dataObj->toArray():[],
            'param' => $param,
            "thead"=>[
                "cfnum"=>"CF编号",
                "bncode"=>"批号",
                "cas"=>"C.A.S",
                "product_cname"=>"中文名称",
                "product_ename"=>"英文名称",
                "op"=>"操作",
              ],
            "class"=>[
                "cfnum"=>"",
                "bncode"=>"",
                "cas"=>"",
                "product_cname"=>"",
                "product_ename"=>"",
                "op"=>"op",
            ]
        ];
        return $this->returnData($result);
        
        
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
