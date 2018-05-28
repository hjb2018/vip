<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class evalController extends Controller
{
    public function index(Request $request)
    {
    	$res = DB::table('eval')->
        where('name','like','%'.$request->input('search').'%')->
        orderBy('id','asc')->
        paginate(3);

        $search = $request->input('search');

        return view('admin.eval.eval',[
        	'res'=>$res,
        	'search'=>$search
        ]);
    }


    public function ajax(Request $request)
    {
    	$id = $request->input('id');
    	$status = $request->input('status');
    	if ($status == '1') {
    		$status = 2;
    	}else if($status == '2'){
    		$status = 1;
    	}
	
		$res = DB::table('eval')->where('id',$id)->update(['status'=>$status]);
		

    	if ($res) {
    		echo 1;
    	} else {
    		echo 0;
    	}
    }

    public function pinglun($id,$gid)
    {
    	
    	$ping = DB::table('eval')->where('id',$id)->first();


    	$good = DB::table('goods')->where('gid',$gid)->first();
    	
    	
    	
    	return view('admin.eval.detail',[
    		'ping'=>$ping,
    		'good'=>$good
    	]);
    }

}
