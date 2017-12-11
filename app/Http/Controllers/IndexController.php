<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestModel;
use App\ProductModel;

class IndexController extends Controller
{
    private $indexPage = '';
    private $data = [];
    private $message = [];

    public function __construct()
    {
        
        $this->message = config('message.message'); 
    }


    /**
     * 登录页面
     * @param  JarvisMan $javisman 接口
     * @param  Request $request 请求参数
     * @return view
     */
    public function index(Request $request ,TestModel $testM, ProductModel $productM)
    {
        $total = [];
        $data = [];
        $user = $request->session()->get('user');
        if (!empty($user)) {
            return redirect($to = $this->indexPage, $status = 302, $headers = [], $secure = config('app.secure'));
        }

        $bncodes = $productM::getProductsbyGroup(['bncode'],[],'bncode');
        $total['bncodes'] = $bncodes->count();
        $total['tests']  = $testM::count('id');

        //echo phpinfo();exit;
        return view('index.index',compact('data','total'));
    }

    
    public function fileUpload(Request $request){
        $filename = '';
        $file     = $request->file('fileData');
        // 文件是否上传成功
        if ($file->isValid()) { 
            $ension=$file->getMimeType(); 
            $fileextension = explode('/', $ension); 
            $filename = uniqid().'.'.$fileextension[1];
            $realpath = $file->getRealPath();
            $file->storeAs(date('Y'),$filename);
        }
        if ($request->hasFile('fileData')) {
            $return = ['respCode'=>'000','file_token' =>'storage/'.date('Y').'/'.$filename];
        }else{
            $return = ['respCode'=>'600','file_token' =>'storage/'.date('Y').'/'.$filename];
        }
        return $this->returnData($return);
    }

    // /**
    //  * 登录ajax
    //  * @param  JarvisMan $javisman 接口
    //  * @param  Request $request 请求参数
    //  * @return json
    //  */
    // public function login(Request $request,User $user)
    // {
         
    //         $userinfo = User::getLastUserbyEmail($requests['username'], ['id','verify_status', 'mobile', 'token']);
            
    //         $user_array = ['username' => $requests['username'], 
    //                         ];
    //         $request->session()->put('user', $user_array);
    //         $request->session()->put('config', Config::getSession());
    //         $data['returnUrl'] = $this->indexPage;
        
    //     return $this->returnData($data);
    // }


    // public function register()
    // {
    //     return view('index.register');
    // }

    // /**
    //  * 发送邮件
    //  * @param  Request $request 请求参数
    //  * @param  User $user 用户信息model
    //  * @param  Config $config 配置model
    //  * @param  MailController $mail 发邮件
    //  * @return json
    //  */
    // public function checkEmail(Request $request, User $user, Config $config, MailController $mail)
    // {
    //     $input = $request->only(['email']);
    //     // 判断email是否为空
    //     if (empty($input['email'])) {
    //         return $this->returnData(['respCode' => '454', 'respDesc' => $this->message['emailRegistNotEmpay']]);
    //     }

    //     $users = $user->getLastUserbyEmail($input['email']);
    //     //判断是否已经认证
    //     //$users = $user->getVerifyUserbyEmail($input['email']);
    //     if (isset($users['verify_status']) && $users['verify_status']) {
    //         return $this->returnData(['respCode' => '461', 'respDesc' => $this->message['emailExisted']]);
    //     }

    //     //判断操作是否过频
    //     //$users = $user->getLastUserbyEmail($input['email']);
    //     if (isset($users['send_time']) && ($users['send_time'] + config('app.sendMailGapTime')) > time()) {  //频繁操作限制 默认1分钟
    //         return $this->returnData(['respCode' => '251']);
    //     }

    //     //入库
    //     $userNew = $user->updateOrCreate(['email' => $input['email']]);//记录用户信息

    //     //发送邮件 
    //     $token = $config->getToken();//注册token
    //     $url = url('/index/register-confirm?email=' . $input['email'] . '&token=' . $token, [], config('app.secure'));
    //     $param = ['title' => $this->message['emailRegistTitle'], 'url' => $url];
    //     $flag = $mail->send($input['email'], $this->message['emailRegistTitle'], 'emails.confirm', $param);

    //     if ($flag) {
    //         //邮件发送成功
    //         $data = [
    //             'send_time'=>time(),
    //             'token' => $token,
    //             'token_exptime' => time() + config('app.registerTokenExptime'),
    //         ];
    //         $user->where(['id' => $userNew->id])->update($data);//更新用户信息- 邮件发送时间
    //         return $this->returnData(['respCode' => '000', 'respDesc' => $this->message['emailSendSuccess']]);
    //     } else {
    //         //邮件发送失败
    //         // Log::info($this->randNum . "send mail fail: " . $input['email']);
    //         return $this->returnData(['respCode' => '551', 'respDesc' => $this->message['emailSendFail']]);
    //     }

    //     return $this->returnData(['respCode' => '000', 'respDesc' => $this->message['emailSendSuccess']]);

    // }
    

    // /**
    //  * 退出登录
    //  * @param  Request $request 请求参数
    //  * @return view index
    //  * 注：仅清理自己系统的session,否则可能对系统上其他系统造成影响
    //  */
    // public function logout(Request $request)
    // {
    //     if($request->session()->has('user')){
    //         $request->session()->forget('user');
    //     };
    //     if($request->session()->has('config')){
    //         $request->session()->forget('config');
    //     };
    //     //$request->session()->flush();
    //     return redirect($to='/index', $status = 302, $headers = [], $secure = config('app.secure'));
    // }


}
