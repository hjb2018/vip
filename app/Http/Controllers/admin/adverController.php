<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\FormRequest;
use App\Http\Requests\FormUpdate;


class adverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $res = DB::table('adver')->
        where('name','like','%'.$request->input('search').'%')->
        orderBy('id','asc')->
        paginate(3);

        $search = $request->input('search');

        return view('admin.adver.index',[
            'res'=>$res,
            'search'=>$search
        ]);

    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.adver.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->hasFile('pic')){

            //文件名
            $name = rand(1111,9999).'_'.time();

            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();

            $request->file('pic')->move('./goods/images/',$name.'.'.$suffix);

            
        }
        

        $res = $request->except('_token');

        $res['pic'] = '/goods/images/'.$name.'.'.$suffix;


        $data = DB::table('adver')->insert($res);

        if($data){
            return redirect('/admin/adver');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $res = DB::table('adver')->where('id',$id)->first();

        

        return view('admin.adver.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res = DB::table('adver')->where('id',$id)->first();

        $data = '@'.unlink('.'.$res->pic);

        if(!$data){

            return back();
        }

        if($request->hasFile('pic')){

            //文件名
            $name = rand(1111,9999).'_'.time();

            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();

            $request->file('pic')->move('./goods/images/',$name.'.'.$suffix);

            
        }
        

        $res = $request->except('_token','_method');

        $res['pic'] = '/goods/images/'.$name.'.'.$suffix;


        $data = DB::table('adver')->where('id',$id)->update($res);

        if($data){
            return redirect('/admin/adver');
        }else{
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $arr = [];
        $res = DB::table('adver')->where('id',$id)->delete();



        if($res)
        {
            return redirect('/admin/adver');
            // $arr['status'] = 1;
            // $arr['msg'] = '删除成功';
        }else{
            return back();
            // $arr['status'] = 0;
            // $arr['msg'] = '删除失败';
        }
        // return $arr;
    }
}
