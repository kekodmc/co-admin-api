<?php
/**
 * Created by PhpStorm.
 * User: kekodmc
 * Date: 2020/11/26
 * Time: 10:44
 */

namespace app\model;


use think\model\concern\SoftDelete;

class PowerModel extends BaseModel
{
    use SoftDelete;
    protected $table='power';
    protected $deleteTime = 'delete_time';
    protected $defaultSoftDelete = 0;

    public function children(){
        return $this->hasMany(PowerModel::class,'parent_id');
    }
}