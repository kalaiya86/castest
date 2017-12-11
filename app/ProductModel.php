<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    //
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bncode','cfnum','cas','product_ename','product_cname'
    ];
    
    public $timestamps = true;
    

    static function getProducts($feilds=['id'],$where=[], $page = 1, $perPage = 15){
        return  self::where($where)
                ->orderBy('updated_at', 'desc')
                //->unionAll('')
                ->get($feilds)
                ->forPage($page,$perPage);
    }


    static function getProductsbyGroup($feilds=['id'],$where=[],$groupby='bncode'){
        return  self::where($where)
                ->orderBy($groupby, 'asc')
                ->groupBy($groupby)
                ->get($feilds);
    }
}
