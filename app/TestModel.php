<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Test;

class TestModel extends Model
{
    //
    protected $table = 'tests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bncode','appearance','product_id','purity','condition','spectrogram','test_time'
    ];
    
    public $timestamps = true;

    static function getTests($feilds=['id'],$where=[]){
        return  self::where($where)
                ->orderBy('updated_at', 'desc')
                ->get($feilds);
    }
}
