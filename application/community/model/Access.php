<?php

namespace app\community\model;

use think\Db;
use think\Model;

class Access extends Model
{
    protected $table = "cyan_auth_access";
    protected static $tb = "cyan_auth_access";

    public static function delByRoleid($roleId){
       return Db::table(self::$tb)->where("role_id",'=',$roleId)->delete();
    }

    public static function getRoleId($roleId){
       $res = Db::table(self::$tb)->where("role_id",'=',$roleId)->select();
       if($res){
           return array_column($res,"node_id");
       }else{
           return [];
       }
    }
}
