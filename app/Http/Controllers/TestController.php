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
    public function default(ProductModel $productM){
        $bncodes = $productM::getProductsbyGroup(['bncode'],[],'bncode');
        $cases = $productM::getProductsbyGroup(['cas'],[],'cas');
        $names = $productM::getProductsbyGroup(['product_cname'],[],'product_cname');
        
        return view('test.index',compact('bncodes','cases','names'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,TestModel $testM,ProductModel $productM)
    {
        //
        $tmp = $request->all();
        $param = [
            ['test_time', '>', $tmp['startDate'].' 00:00:00'],
            ['test_time', '<=', $tmp['endDate'].' 00:00:00'],
        ];

        

        if(!empty($tmp['cfnum'])) $param[] = ['cfnum', '=', $tmp['cfnum']];
              ;
        if(!empty($tmp['cas'])) $param[] = ['cas', '=', $tmp['cas']];
              ;
        if(!empty($tmp['product_cname'])) $param[] = ['product_cname', 'like', '%'.$tmp['product_cname'].'%'];
              ;     
        
        if(!empty($tmp['bncode'])) $param[] =  ['tests.bncode', 'like', '%'.$tmp['bncode'].'%'];
        
        $dataObj = $testM::getTests(['tests.id as id','tests.bncode as bncode','cas','cfnum','nmr','hplc','water','weather','appearance','purity','condition','spectrogram','test_time'],$param);
        //var_dump($dataObj->toArray());
        $total = $dataObj->count();
        $result = [
            'respCode' =>'000',
            'total'=> $total,
            'data'=>($total>0)?$dataObj->toArray():[],
            'param' => $param,
            "thead"=>[
                "test_time"=>"测试时间",
                "bncode"=>"批次",
                "cfnum"=>"CF编号",
                "cas"=>"C.A.S",
                "product_cname"=>"中文名称",
                // "product_ename"=>"英文名称",
                "spectrogram"=>"谱图",
                "op"=>"操作",
              ],
            "class"=>[
                "test_time"=>"",
                "bncode"=>"",
                "cfnum"=>"",
                "cas"=>"",
                "product_cname"=>"",
                // "product_ename"=>"",
                "spectrogram"=>"img",
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
    public function create(ProductModel $productM)
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
