@extends('layout.admin')

@section('content')

    <div class="widget am-cf">
    <div class="widget-head am-cf">
        <div class="widget-title am-fl">
            线条表单
        </div>
        
    </div>
    <div class="widget-body am-fr">

        <form class="am-form tpl-form-line-form" action="/admin/adver/{{$res->id}}" method="post" enctype='multipart/form-data'>
             {{ csrf_field() }}
             {{method_field('PUT')}}
            <div class="am-form-group">
                <label for="user-name" class="am-u-sm-4 am-form-label">
                    广告名称
                    <span class="tpl-form-line-small-title">
                        Name
                    </span>
                </label>
                <div class="am-u-sm-8">
                    <input type="text" name='name' value='{{$res->name}}' class="tpl-form-input" id="user-name" >
                    <small>
                        请填写名称文字1-20字左右。
                    </small>
                </div>
            </div>

            <div class="am-form-group">
                <label for="user-phone" class="am-u-sm-4 am-form-label">位置选择 <span class="tpl-form-line-small-title">Author</span></label>
                <div class="am-u-sm-8">
                <select data-am-selected="{searchBox: 1}" name='url'>
                    <option value="0" @if($res->url == 0) selected @endif>
                        
                        -The.CC
                    </option>
                    <option value="1" @if($res->url == 1) selected @endif>
                        夕风色
                    </option>
                    <option value="2" @if($res->url == 2) selected @endif>
                        
                        Orange
                    </option>
                </select>

                </div>
            </div>
           
          
            <div class="am-form-group">
                <label for="user-weibo" class="am-u-sm-4 am-form-label">
                    广告图片
                    <span class="tpl-form-line-small-title">
                          &nbsp; &nbsp; &nbsp; &nbsp;Pic
                    </span>
                </label>
                <div class="am-u-sm-8">
                    <img src="{{$res->pic}}" alt="">
                    <input type="file" name='pic' id="user-weibo" placeholder="请添加分类用点号隔开">
                    <div>
                    </div>
                </div>
            </div>
            

             <div class="am-form-group">
                <label for="user-weibo" class="am-u-sm-4 am-form-label">
                    广告状态
                    <span class="tpl-form-line-small-title">
                        &nbsp; &nbsp; &nbsp;Type
                    </span>
                </label>
                <div class="am-u-sm-8">
                    推送:<input type="radio" value="1" name='status' id="user-weibo" @if($res->status == 1) checked @endif >
                    禁用:<input type="radio" value="0" name='status' id="user-weibo" @if($res->status == 0) checked @endif>
                    <div>
                    </div>
                </div>
            </div>
            
            <div class="am-form-group">
                <div class="am-u-sm-9 am-u-sm-push-3">
                    <button  class="am-btn am-btn-primary tpl-btn-bg-color-success ">
                        提交
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection