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
        'bncode','nmr','hplc','water','weather','appearance','product_id','purity','condition','spectrogram','test_time'
    ];
    
    public $timestamps = true;

    static function getTests($feilds=['id'], $where=[], $page = 1, $perPage = 15){
        return  self::where($where)
                ->orderBy('tests.updated_at', 'desc')
                ->leftJoin('products', 'tests.bncode', '=', 'products.bncode')
                ->get($feilds)
                ->forPage($page,$perPage);
    }
}
