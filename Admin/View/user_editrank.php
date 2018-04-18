<div class="ibox actuser-box" style="margin-bottom: 0px">
    <div class="ibox-title">
        <h5>编辑会员等级</h5>
        <div class="ibox-tools">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
        </div>
    </div>
    <div class="ibox-content">
        <div class="alert alert-warning clearfix" style="margin-bottom: 0px;">
            <form class="form-horizontal col-md-12" method="post" action="" onsubmit="return false;">
                <input type="hidden" value="DUser.EditRank" name="service">
                <input type="hidden" value="post" name="action">
                <input type="hidden" value="<?php echo $user['id']; ?>" name="userid">

                <div class="form-group">
                    <label class="col-sm-3 control-label"><span class="text-danger"></span><i class="fa fa-money"></i>
                        会员等级</label>
                    <div class="col-sm-9">
                        <select name="rank" class="form-control">
                            <?php $rank_names = Common_Function::getRankName();
                            foreach ($rank_names as $key => $rank_name): ?>
                                <option value="<?php echo $key; ?>" <?php echo $user['rank'] == $key ? 'selected' : ''; ?> ><?php echo $rank_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label hidden-xs"></label>
                    <div class="col-sm-9">
                        <button class="btn btn-warning" type="submit"><i class="fa fa-check"></i> 确认</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
