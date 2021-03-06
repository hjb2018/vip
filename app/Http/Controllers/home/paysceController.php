<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use foreachPrintfArr;
use Session;
class paysceController extends Controller
{



    public function paysce(Request $request)
    {
        $ids = IndexController::getCateTree(0);
        $pids = new foreachPrintfArr($ids);
        // 何锦彬
        $links = DB::table('links')->where('status','1')->get();


    	// // $stock = $request->only('stock');
     //    $gid = $request->only('gid');
 
     //    foreach ($gid['gid'] as $key => $value) {
        
     //    	$aa = DB::table('goods')->where('gid',$value)->first();
     //    	print_r($aa);
        	
     //    }
		
      
        
        
	    //合完项目需要修改session的获取
		$uid = session('orderuid');

		$addr = $request->except('gid','stock');


		$oid = $request->input('oid');

		// 生成订单
		$res = DB::table('orders')->insert($addr);
		
		//购物车表中商品如果买过的话就让jiesuan的状态为1没有购买的为0
		$ad = DB::table('carts')->where([
			['uid',$uid],
			['status',1]
		])->update(['jiesuan'=>1]);

		//定义$info数组
		$info = [];
		//从购物车中获取结算完成的数据
		$data = DB::table('carts')->where([
			['uid',$uid],
			['jiesuan',1]
		])->get();


	   foreach ($data as $key => $value) {
        
        	$aa = DB::table('goods')->where('gid',$value->gid)->first();
        	//print_r($aa);

        	$number = $aa->stock - $value->xiaoji;
        	if($number<=0){
                  die('number > 0');
        	}

        	// $value->gid;//

        	$ar = DB::table('goods')->where('gid',$value->gid)->update(['stock'=>$number]);

        	// echo $number."<br>";
        	
        }

       


		//把从购物车获取的数据进行遍历,赋值给$info(就是把获取的数据变成数组,不然无法往订单详情表里插入)
		foreach ($data as $k => $v) {
			$info[$k]['gname'] = $v->gname;
			$info[$k]['gpic'] = $v->gpic;
			$info[$k]['price'] = $v->price;
			$info[$k]['xiaoji'] = $v->xiaoji;
			$info[$k]['gid'] = $v->gid;
			$info[$k]['uid'] = $v->uid;
			$info[$k]['status'] = $v->status;
			$info[$k]['oid'] = $oid;
		}
		// 把$info插入到订单详情表中
		$pd = DB::table('orders_detail')->insert($info);
		
		// 在购物车中删除我购买过的数据
		DB::table('carts')->where('jiesuan',1)->delete();

	    return view('home.order.paysce',[
	    	'oid'=>$oid,
            'pids'=>$pids,
            'ids'=>$ids,
            'links'=>$links
	    ]);
    


    }



}
