<div class="dd" id="nestable2" style="text-align: left">
    <style>#nestable2 .dd-nodrag {
            color: #fff;
            padding: 5px 10px;
            display: block;
            width: 300px;
            margin: 5px 0;
            text-decoration: none;
            border: 1px solid #e7eaec;
            background: #f5f5f5;
            border-radius: 3px;
            box-sizing: border-box;
        }#nestable2 .dd-item > button{margin-top: 0px}</style>
    <?php if($member): ?>
        <?php $grade_ary = Common_Function::getRankName(); $user_id = Common_Function::user_id();if($member['pid']&&($user_id==0||$member['id']!=$user_id)){?>
            <div align="center" class="Register_a">
                <a href="javascript:void(-1)" member data-id="<?php echo $member['pid'] ; ?>"><input type="button" name="btnSearch" value="<?php echo T('上一层'); ?>" style="margin-bottom: 20px;" id="btnSearch" ></a>
            </div>
        <?php }?>
        <?php
        switch($member['rank']){
            case 0:$bg1="#8b8484";$bgcol="#8b8484";$bg2="#8b8484";break;
            case 1:$bg1="#009999";$bgcol="#009999";$bg2="#009999";break;
            case 2:$bg1="#8891ed";$bgcol="#8891ed";$bg2="#8891ed";break;
            case 3:$bg1="#ff6700";$bgcol="#ff6700";$bg2="#ff6700";break;
            case 4:$bg1="#aa3939";$bgcol="#aa3939";$bg2="#aa3939";break;
            case 5:$bg1="#336699";$bgcol="#336699";$bg2="#336699";break;
            case 6:$bg1="#FFCC00";$bgcol="#FFCC00";$bg2="#FFCC00";break;
            case 7:$bg1="#FF9900";$bgcol="#FF9900";$bg2="#FF9900";break;
        }
        ?>
        <ol class="dd-list">
            <li class="dd-item" data-id="<?php echo $member['id']; ?>">
                <div class="dd-nodrag" style="background-color: <?php echo $bgcol;?>">
                    <span class="label label-info"><i class="fa fa-user"></i></span><?php echo $member['user_name']; ?>
                </div>
                <?php function tuopu_tree($member_id,$dept,$dept1,$type){
                    $grade_ary = Common_Function::getRankName();
                    if ($dept>=$dept1) {$i=1;
                        $user_model = new Model_Users();
                        $members =  $user_model->getListByWhere(array('pid=?'=>array($member_id)));
                        $members[] = false;
                        $c_num = count($members);
                        foreach($members as $member){
                            ?>

                            <ol class="dd-list">
                                <?php
                                if($member){
                                    switch($member['rank']){
                                        case 0:$bgcol="#8b8484";break;
                                        case 1:$bgcol="#009999";break;
                                        case 2:$bgcol="#8891ed";break;
                                        case 3:$bgcol="#ff6700";break;
                                        case 4:$bgcol="#aa3939";break;
                                        case 5:$bgcol="#336699";break;
                                        case 6:$bgcol="#FFCC00";break;
                                        case 7:$bgcol="#FF9900";break;
                                    }
                                    ?>

                                    <li class="dd-item" data-id="<?php echo $member['id']; ?>">
                                        <div class="dd-nodrag" style="background-color: <?php echo $bgcol;?>">
                                            <span class="label label-info"><i class="fa fa-user"></i></span><a href="javascript:void(-1)" member data-id="<?php echo $member['id'] ; ?>" style="color: #fff"><?php echo $member['user_name']; ?></a>
                                        </div>
                                        <?php tuopu_tree($member['id'],$dept,$dept1+1,$type); ?>
                                    </li>

                                <?php  }else{?>
                                    <li class="dd-item">
                                        <div class="dd-nodrag">
                                            <span class="label label-info"><i class="fa fa-user"></i></span>  <a href="<?php echo $type=='user'?'?service=User.UserReg':'?service=User.UserReg','&user_pid=',$member_id;?>"><?php echo T('注册'); ?></a>
                                        </div>
                                    </li>

                                <?php   }?>
                            </ol>
                            <?php
                            $i++;}}?>

                <?php }tuopu_tree($member['id'],3,1,$type)?>
            </li>
        </ol>
    <?php endif; ?>
</div>

<script type="text/javascript" src="<?php echo Common_Function::GoodsPath('/js/plugins/nestable/jquery.nestable.js'); ?>"></script>
<script type="text/javascript">
    $(function () {
        $('#nestable2').nestable({group:0});
        $("#nestable-menu").on("click", function (e) {
            var target = $(e.target), action = target.data("action");
            if (action === "expand-all") {
                $(".dd").nestable("expandAll")
            }
            if (action === "collapse-all") {
                $(".dd").nestable("collapseAll")
            }
        })
    });
</script>
<div class="alert alert-info" style="margin-top: 30px">
    本网络图仅显示四层
</div>