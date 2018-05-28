<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;

use foreachPrintfArr;

class GoodsController extends Controller
{
    // 列表
    public function list(Request $request,$cid)
    {

        // 继承模板
       // $req = $res = $request->except('_token');
        
        $ids = IndexController::getCateTree(0);
        $pids = new foreachPrintfArr($ids);
       //获取
        


        $data = DB::table('goods')->
        leftJoin('cates','goods.cid','=','cates.cid')->
        where([
                    ['goods.cid',$cid],
                    ['goods.level','0'],
                    
        ])->
        orWhere([
                    ['cates.pid',$cid],
                    ['goods.level','0']
                    
                ])->
         get();

       
        // 获取价格
        // $prices = DB::table('goods')->
        // whereBetween('price',$info)->get();
        // 何锦彬
        $links = DB::table('links')->where('status','1')->get();
        

        // 返回值
        return view('home.goods.list',[
            'pids'=>$pids,
            'ids'=>$ids,
            'data'=>$data,
            'cid'=>$cid,
            'links'=>$links
            // 'price'=>$price
            
       
        ]);
    }

    // 促销
    public function cuxiao($id)
    {
        $ids = IndexController::getCateTree(0);
        $pids = new foreachPrintfArr($ids);

        $level = DB::table('goods')->
        where('level',$id)->
        get();
        // $pirces = DB::table('goods')->
        // where('price',$price)->get();
         // 何锦彬
        $links = DB::table('links')->where('status','1')->get();
        return view('home.goods.cuxiao',[
            'links'=>$links,
            'id'=>$id,
            'level'=>$level,
            'pids'=>$pids,
            'ids'=>$ids
           
            ]); 
    }

    // 详情
    public function detail($gid)
    {

        // 何锦彬
        $links = DB::table('links')->where('status','1')->get();
        $ids = IndexController::getCateTree(0);
        $pids = new foreachPrintfArr($ids);

        $res = DB::table('goods')->
        where('gid',$gid)->
        first();

        return view('home.goods.detail',[
                    'links'=>$links,
                    'pids'=>$pids,
                    'ids'=>$ids,
                    'res'=>$res
            ]);
    }
    
   public function cartsAjax($gid)
   {
        //通过gid去购物车表中查是否有这条数据,如果有的话就不进行插入

        $carts = DB::table('carts')->where('gid',$gid)->first();
        if (!$carts) {
            $goods = DB::table('goods')->where('gid',$gid)->first();

            //等到存session了打开使用
            // $uid = session('orderuid');

             //定义$info数组
            $info = [];
            //遍历获取到的数据
            foreach ($goods as $k => $v) {
                $info['gname'] = $goods->gname;
                $info['price'] = $goods->price;
                $info['gid'] = $goods->gid;
                $info['uid'] = 2;
                $info['stock'] = $goods->stock;
                $info['gpic'] = $goods->gpic;
            }
            // dd($info);

            $res = DB::table('carts')->insert($info);

        
            if ($res) {
                
                return back()->with('msg','添加购物车成功');
            }
        }else{
            return back()->with('msg','购物车中已经有了这件商品');
        }
        

        
   }
}
