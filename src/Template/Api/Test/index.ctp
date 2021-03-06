<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <title></title>
    <load href="/css/testIndex.css"/>
    <script src="/js/jquery.js"></script>
    <script type="text/javascript">
    <!--
        $(function(){
            $('select[name=action]').change(function() {
                $('.requireParam').html('');
                if ($(this).val() != '') {
                    $('select[name=function]').html('');
                    $.post('test/getFunction', 'con='+$(this).val(), function(json) {
                        console.log(json);
                        var str = '<option value="">请选择</option>';
                        for(var key in json.title) {
                            str += '<option value="'+key+'">'+json.title[key]+'</option>';
                        }
                        $('select[name=function]').html(str);
                    }, 'json');
                } else {
                    $('select[name=function]').html('<option value="">请选择</option>');
                }
            })

            $('select[name=function]').change(function() {

                if ($(this).val() != '') {
                    $.post('__URL__/getParam', 'con='+$('select[name=action]').val()+'&fun='+$(this).val(), function(json) {
                        var str = '';
                        for(var key in json) {
                            if (json[key]['required'] == 1) {
                                if (json[key]['type'] != 'file') {
                                    str += '<div class="require"><label>' + key + '：</label>' + '<input type="text" name="require['+key+']" value="'+json[key]['value']+'">';
                                    if (json[key]['sign']) {
                                        str += '<span class="sign">'+json[key]['sign']+'</span>';
                                    }
                                    str += '</div>';
                                }
                            }
                        }

                        $('.requireParam').html(str);
                    }, 'json');
                }
            })

            $('.now').click(function() {
                $('.right .str').html('');
                $('.right .obj').html('');
                $.post('__URL__/api', $('.left form').serialize(), function(json) {
                    $('.right .str').html(json.str);
                    $('.right .obj').html(json.obj);
                    $('.right .pre').html('加密前：' + json.param1 + '<hr>加密后发送：' + json.param2);
                }, 'json')
            });

            //右侧切换
            $('.right li').click(function(){
                $(this).addClass('on').siblings().removeClass('on');
                $('.news .show').eq($(this).index()).show().siblings().hide();
            }).eq(1).click();
        })
    //-->
    </script>
</head>
<body>
    <div class="left">
        <form>
            <div class="con">
                <label>类名：</label>
                <select name="action">
                    <option value="">--请选择--</option>
<?php
foreach ($controllerName as $value) {
    $opton = '<option value="'.$value.'" > '.$value.'</option>';
    echo $opton;
}?>
                </select>
            </div>
            <div class="fun">
                <label>方法名：</label>
                <select name="function">
                    <option value="">请选择</option>
                </select>
            </div>
            <div class="requireParam">

            </div>
            <div class="param">
                <label>参数：</label>
                <textarea rows="5" cols="30" name="param"></textarea>
                <p>
                    *非必填参数每行一个，以这样的样式填写</br>
                    例如：</br>
                    co_id=21</br>
                    a_id=1</br>
                </p>
            </div>
            <div class="submit">
                <input type="button" class="now" value="确定">
            </div>
        </form>

        <input type="hidden" name="fun" value="{$params.function}">
    </div>
    <div class="right">
        <ul>
            <li>发送数据</li>
            <li>树形列表</li>
            <li>返回数据</li>
        </ul>
        <div class="news">
            <div class="show pre"></div>
            <div class="show obj"></div>
            <div class="show str"></div>
        </div>
    </div>
</body>
</html>
