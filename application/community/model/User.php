<?php

namespace app\community\model;

use think\Db;
use think\Model;

class User extends Model
{
    protected $table = "cyan_auth_user";

    protected static $tb = "cyan_auth_user";

    public static function getAllUser(){

        return Db::table(self::$tb)->alias('a')
            ->field('a.id,a.realname,a.loginname,a.phone,c.name rolename,a.status')
            ->join('cyan_auth_role_user b','a.id=b.user_id')
            ->join('cyan_auth_role c','b.role_id=c.id')
            ->select();
    }

    public static function getUserById($userid){
        return Db::table(self::$tb)->alias('a')
            ->field('a.id,a.realname,a.loginname,a.phone,c.name rolename,a.status')
            ->join('cyan_auth_role_user b','a.id=b.user_id')
            ->join('cyan_auth_role c','b.role_id=c.id')
            ->where('a.id','=',$userid)
            ->find();
    }
}
