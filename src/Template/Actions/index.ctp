<!-- content-header begin-->
<section class="content-header">
    <div class="row">
        <div class="col-xs-8 col-md-8">
            <h3>报警策略</h3>
        </div>
        <div class="col-xs-4 col-md-4 text-right" style="margin-top:20px;">
            <a href="alarm_strategy.html" class="btn btn-default btn-sm">返回</a>
        </div>
    </div>
</section>
<!-- content-header end-->
<!-- content begin-->
<section class="content user_center sever_inner">
    <!-- row begin-->
    <div class="row">
        <!-- col-md-12 begin-->
        <div class="col-xs-12 col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <?php $i = 0;foreach($acgtions_tab as $key => $tab):?>
                    <li <?php  if($i == 0){ echo ' class="active" '; }?> ><a href="#tab_<?= $key; ?>" data-toggle="tab" data-type="<?= $key?>" data-id="<?= $tab[1]?>"><?= $tab[0] ?></a></li>
                <?php $i++; endforeach;?>
                </ul>
                <div class="tab-content">
                <?php $n = 0;foreach($acgtions_tab as $key => $tab):?>
                    <div class="tab-pane <?php  if($n == 0){ echo ' active'; }?>" id="tab_<?= $key; ?>">
                        <!-- row begin-->
                        <div class="row">
                            <!-- col-md-12 begin-->
                            <div class="col-xs-12 col-md-12">
                                <div class="box-body">
                                    <form class="form-horizontal">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">延迟分钟</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="delay" class="form-control" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">重复次数</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="repeat" class="form-control" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3">
                                                    <label for="inputEmail3" class="col-sm-4 control-label">时间间隔</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" name="interval"  class="form-control" value="" />
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-3 text-right">
                                                    <label class="col-sm-8 control-label">
                                                        <input type="checkbox" value="1" checked name="is_repeat_to_relieve" /> 重复到报警解除为止
                                                    </label>
                                                    <a href="javascript:void(0);" class="btn btn-primary btn-xs add_msg">添加</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- 列表 begin-->
                                    <div class="table-responsive mailbox-messages">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?= __('SendTo')?></th>
                                                    <th><?= __('Actions') ?></th>
                                                </tr>
                                            </thead>
                                            <tbody class="dataList">
                                                
                                            </tbody>
                                        </table>
                                        <!-- /.table -->
                                    </div>
                                    <!-- 列表 end-->
                                </div>

                                <div class="box-footer text-center">
                                    <input type="hidden" name="strategy_id" value="<?= $strategy_id ?>">
                                    <button class="btn btn-primary btn-sm save" role="button">保存</button>
                                </div>
                            </div>
                            <!-- col-md-12 end-->
                        </div>
                        <!-- row end-->
                    </div>
                    <!-- /.tab-pane -->
                <?php $n++; endforeach;?>
                    
                <!-- /.tab-content -->
            </div>
        </div>
        <!-- col-md-12 end-->
    </div>
    <!-- row end-->
</section> 
<!-- content end-->


<!-- 遮罩层 begin-->
<div class="mask" id="mask">
    <div class="add_template col-xs-11 col-md-6">
       <!-- row begin-->
            <div class="row">
                <!-- col-md-12 begin-->
                <div class="col-xs-12 col-md-12">
                    <!-- box begin-->
                    <div class="box box-primary">
                        <!-- box-header begin-->
                        <div class="box-header with-border">
                            <h3 class="box-title pull-left">请输入：<span></span></h3>
                            <a href="#" class="pull-right glyphicon glyphicon-remove"></a>
                        </div>
                        <!-- box-header end-->

                        <!-- form begin-->
                        <form class="form-horizontal">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="sendto" value="">
                                    </div>
                                </div>
                            </div>
                            <!-- box-body end-->
                            <div class="box-footer text-center">
                                <input type="hidden" name="type" value="">
                                <input type="hidden" name="strategy_action_id" value="">
                                <button class="btn btn-primary btn-sm add" role="button">保存</button>
                            </div>
                            <!-- box-footer end-->
                        </form>
                        <!-- form end-->
                    </div>
                    <!-- box end-->
                </div>
                <!-- col-md-12 end-->
            </div>
            <!-- row end-->
    </div>
</div>
<!-- 遮罩层 end-->
<script type="text/javascript">
    $(function(){
        
        //弹窗内容
        $(".add_msg").on("click",function(){
            var _this = $(this).parents().parents().prev().find("li.active a").html();
            $(".box-header span").html(_this);
            $("input[name=type]").val($(this).parents().parents().prev().find("li.active a").attr('data-type'));
            $("input[name=strategy_action_id]").val($(this).parents().parents().prev().find("li.active a").attr('data-id'));
        });

        //提交表单
        $(".add").on("click", function(){ 
            var data = {
                'strategy_id': $("input[name=strategy_id]").val(),
                'sendto': $("input[name=sendto]").val(),
                'type': $("input[name=type]").val(),
                'strategy_action_id': $("input[name=strategy_action_id]").val()
            };
            
            $.post('/ActionDetails/add.json', data, function(json) {
                //alert(json.actionDetail.sendto);
                $("#mask").hide();
                var htm = '';
                htm += '<tr><td>0</td><td> '+ json.actionDetail.sendto +' </td><td><a href="#" class="btn btn-primary btn-xs">编辑</a> <a href="#" class="btn btn-default btn-xs btn_delect">删除</a></td></tr>';
                $('.dataList').prepend(htm);
            }, 'json');
            return false;
        });

        //保存数据
        $(".save").on("click", function(){ 
            var data = {
                'strategy_id': $("input[name=strategy_id]").val(),
                'delay': $("input[name=delay]").val(),
                'type': $("input[name=type]").val(),
                'repeat_num': $("input[name=repeat]").val(),
                'interval_time': $("input[name=interval]").val(),
                'is_repeat_to_relieve': $("input[name=is_repeat_to_relieve]").val()
            };
            
            $.post('/Actions/add.json', data, function(data) {
                console.log(data);

            });
            return false;
        });
        
        $("input[name=type]").val($('.nav-tabs>li.active a').attr('data-type'));
        //获取数据
        getLists($('.nav-tabs>li.active a').attr('data-type'));

        //切换tabs
        $('.nav-tabs>li a').click(function (e) {
            $("input[name=type]").val($(this).attr('data-type'));
            getLists($(this).attr('data-type'));
        });
    });

    //获取数据
    function getLists(id) {
        //loading();
        var data = {};
        data.strategy_id = $("input[name=strategy_id]").val();
        data.type = id || 1;

        $.ajax({
            type: "POST",
            url: '/api/ActionDetails/lists',
            data: data,
            dataType: 'json',
            success: function (response) {            
                var htm = '', data = response.data;
                if (data.length > 0) {
                    for (var i = 0; i < data.length; i++) {
                        htm += '<tr><td>'+ (i+1) +'</td><td> '+ data[i].sendto +' </td><td><a href="#" class="btn btn-primary btn-xs">编辑</a> <a href="#" class="btn btn-default btn-xs btn_delect">删除</a></td></tr>';
                    }               
                } else {
                    htm += '<tr class="text-center"><td colspan="3">暂无数据</td></tr>';
                }
                $('.dataList').html(htm);
            }
        });
    }
</script>
