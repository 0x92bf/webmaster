<?php

namespace app\community\model;

use think\Db;
use think\Model;

class RoleUser extends Model
{
    protected $table = "cyan_auth_role_user";

    protected static $tb = "cyan_auth_role_user";

    public static function del($userid){
        if(RoleUser::get(["user_id"=>$userid])){
            if(Db::table(self::$tb)->where("user_id","=",$userid)->delete()){
                return true;
            }
            return false;
        }
        return true;
    }

    public static function getAuthList($userid){
       $res = Db::table(self::$tb)->alias("a")
            ->field('c.node,c.id,c.pid')
            ->join('cyan_auth_access b','a.role_id=b.role_id')
            ->join('cyan_auth_node c','b.node_id=c.id')
            ->where('a.user_id','=',$userid)
            ->select();
       $arr = [];
       foreach ($res as $k => $v){
           $arr[$k]['action'] = strtolower($v['node']);
           $line = Db::table('cyan_auth_node')->where("id","=",$v['pid'])->find();
           $arr[$k]['controller'] = strtolower($line['node']);
       }
       return $arr;
    }
}
