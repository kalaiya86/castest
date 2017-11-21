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
    

    static function getProducts($feilds=['id'],$where=[]){
        return  self::where($where)
                ->orderBy('updated_at', 'desc')
                ->get($feilds);
    }
}
