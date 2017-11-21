<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function returnData($data)
    {
        $respDesc = config('message.code');

        if (isset($respDesc[$data['respCode']])) {
           if(!isset($data['respDesc'])) $data['respDesc'] = $respDesc[$data['respCode']];
        } else {
            if(!isset($data['respDesc'])) $data['respDesc'] = $respDesc['999'];
        }

        return $data;
    }
}
