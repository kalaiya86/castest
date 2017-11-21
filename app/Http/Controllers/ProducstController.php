<?php

namespace App\Http\Controllers;

use App\Contracts\SmsContract;
use Illuminate\Http\Request;
// use App\Models\User;

class ProductsController extends Controller
{
    private $indexPage = '';
    private $data = [];
    private $message = [];

    public function __construct()
    {
        $this->indexPage = url('user/home', [], config('app.secure'));
        $this->message = config('message.message'); 
    }

    /**
     * 登录页面
     * @param  JarvisMan $javisman 接口
     * @param  Request $request 请求参数
     * @return view
     */
    public function index(Request $request)
    {
        $data = [];
        return view('product.home',compact('data'));
    }

    


}
