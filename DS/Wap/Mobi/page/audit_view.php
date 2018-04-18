<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">查看用户资料</h1>
</div>

<div class="mui-page-content">
    <ul class="mui-table-view ui-home-info">
        <li class="mui-table-view-cell mui-media">
            <img class="mui-media-object mui-pull-left" src="<?php echo URL_ROOT.'../DS/Wap/Mobi/'; ?>images/object.png">
            <div class="mui-media-body">
                {{user.true_name}}<span class="ui-grade">{{user.rank_name}}</span>
                <p class="mui-ellipsis">编号：{{user.user_name}}</p>
            </div>
        </li>
    </ul>
    <div class="ui-foot-content">
        <div class="mui-row">
            <div class="mui-col-xs-6 mui-col-sm-6">
                <button type="button" @click="change(0)" class="mui-btn mui-btn-danger ui-btn-block">删除</button>
            </div>
            <div class="mui-col-xs-6 mui-col-sm-6">
                <button type="button" @click="change(1)" class="mui-btn mui-btn-primary ui-btn-block">确认激活</button>
            </div>
        </div>
    </div>
    <div id="sliderAuditBox" class="mui-slider">
        <div id="sliderAuditHd" class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
            <a class="mui-control-item mui-active" href="#slideraudit1" data-index="0">基本资料</a>
            <a class="mui-control-item" href="#slideraudit2" data-index="1">主要联系</a>
        </div>
        <div class="mui-slider-group income-slider-group">
            <div id="slideraudit1" class="mui-slider-item mui-control-content mui-active">
                <div id="scrollAudit1" class="mui-scroll-wrapper">
                    <div class="mui-scroll">
                        <ul class="mui-table-view">
                            <li class="mui-table-view-cell ui-on-back">
                                会员编号<span class="mui-pull-right">{{user.user_name}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                会员姓名<span class="mui-pull-right">{{user.true_name}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                会员等级<span class="mui-pull-right">{{user.rank_name}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                推荐人<span class="mui-pull-right">{{user.t_user_name}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back" v-if="user.is_pre">
                                接点人<span class="mui-pull-right">{{user.p_user_name}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back" v-if="user.is_pre">
                                市场位置<span class="mui-pull-right">{{user.pos_name}}</span></a>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                省市区<span class="mui-pull-right">{{address(user.province,user.city,user.area)}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                注册时间<span class="mui-pull-right">{{timer(user.reg_time ,true)}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="slideraudit2" class="mui-slider-item mui-control-content">
                <div id="scrollAudit2" class="mui-scroll-wrapper">
                    <div class="mui-scroll">
                        <ul class="mui-table-view">
                            <li class="mui-table-view-cell ui-on-back">
                                手机号码<span class="mui-pull-right">{{user.mobile}}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>