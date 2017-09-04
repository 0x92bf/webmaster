<?php
use think\Route;
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


Route::group('index',[
    'user/index'=>'User/index',//登录
    'index'=>'Index/index',//首页
    'user/loginout'=>'User/loginOut',//退出
]);
//@date:2017年2月17日 上午11:55:30 金州车开始

Route::rule([
    'index/bingOrder'=>'Index/listdata',  //金州车用户绑定订单
    'checkbing/:id'=>'Index/checkOrder',     //用户绑定订单详情
    'fzorder/index'=>'Fzorder/useroptList',  //金州车违章订单管理
    'jzorder'=>'Fzorder/jzjfOrder', //用户提交的多有违章订单
    'infoallorder/:transgressno'=>'Fzorder/orderInfo', //金州车违章订单详情
]);
 

//@date:2017年2月17日 上午11:55:41 金州车结束
 
//@date:2017年2月23日 下午4:45:07  千米汽车票开始

Route::rule([
    'tickets/index'=>'Tickets/index', //汽车票订单的查询
    'tickets/porder'=>'Tickets/porder',//
    'tickets/Carporder'=>'Tickets/Carporder',//查询汽车票
    'tickets/returninfo'=>'Tickets/ReturnInfo',
    'tickets/trainorder'=>'Tickets/TrainOrder',//火车票订单的查询
    'tickets/AirOrder'=>'Tickets/AirOrder',//飞机票订单的查询
    'tickets/editbank'=>'Tickets/editBank',//银行卡修改
    
    //@date:2017年3月1日 下午6:16:49 对接银企接口
    'bank/audit'=>'BankPort/audit',
    'bank/remitinfo'=>'BankPort/remitInfo',
    
    
]);
//@date:2017年2月23日 下午4:46:34   千米汽车票结束
Route::rule([
    'Return/anewticket'=>'ReturnTickets/anewTicket', //汽车票订单的查询 
    ]);
    
//手机充值
Route::group('index',[
//    'yjtelchargeindex'=>'YjTelcharge/index',//一家手机充值订单列表页
//    'yjtelcharge'=>'YjTelcharge/recharge',//一家手机失败订单充值
//    'iotelchargeindex'=>'IoTelcharge/index',//艾欧手机充值订单列表页
//    'iotelcharge'=>'IoTelcharge/recharge',//艾欧手机失败订单充值
    'phChargeIndex'=>'Phonecharge/index',//手机充值订单列表
    'phCharge'=>'Phonecharge/recharge',//手机失败订单充值
    'telchargeIndex'=>'Telcharge/index',//手机优惠价格设置列表页
    'editPrice'=>'Telcharge/editPrice',//编辑商品信息
    'savePrice'=>'Telcharge/savePrice',//保存商品价格信息
    'batchSavePrice'=>'Telcharge/batchSavePrice',//保存商品价格信息
    'cableIndex'=>'Cable/index',//利安有线电视订单列表页
    'cableHandel'=>'Cable/handel',//利安有线电视失败订单处理
    'waterIndex'=>'Water/index',//水费订单列表页
    'waterHandel'=>'Water/handel',//水费失败订单处理
    'electricIndex'=>'Electric/index',//电费订单列表页
    'electriChandel'=>'Electric/handel',//电费失败订单处理
]);


Route::rule([
    'page/index'=>'PageIndex/index',
    'page/getallpage'=>'PageIndex/getAllPage',
]);
// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],
//    'index/index'=>'index/index/index', //进入的首页
// ];


