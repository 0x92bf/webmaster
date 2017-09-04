<?php

namespace app\community\model;

use think\Db;
use think\Model;

class Role extends Model
{
    protected $pk = 'id';

    protected $table = 'cyan_auth_role';

    public static function getAllRoles(){
       /* $fileds = 'a.id roleid,c.id userid,
                    c.realname realname,c.loginname loginname,
                    a.name rolename,a.status,a.remark';

        return Db::table('cyan_auth_role')->alias('a')
            ->join('auth_role_user b','a.id = b.role_id')
            ->join('auth_user c','b.user_id=c.id')
            ->field($fileds)
            ->order(['a.listorder'=>'desc'])
            ->select();*/
       return Db::table('cyan_auth_role')->select();
    }



}
