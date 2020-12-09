<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:44
 */

namespace app\model;


class AdminModel extends BaseModel
{
    protected $table='admin';

    public function getLoginTimeAttr($value){
        if($value){
            return date('Y-m-d H:i:s',$value);
        }
        return '';
    }

    public function role(){
        return $this->belongsTo(RoleModel::class,'role_id');
    }
}