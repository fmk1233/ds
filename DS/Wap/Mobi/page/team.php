<div class="mui-scroll-wrapper" style="padding-bottom: 30px;">
    <div class="mui-scroll">
        <!--团队概要-->
        <ul class="mui-row ui-team-info">
            <li class="mui-col-xs-4 mui-col-sm-4">
                <div class="mui-table-view-cell">
                    <a href="#azfig" data-type="2"><i class="icon icon-jiangbei"></i>
                        <div class="mui-media-body">
                            直推人数<p class="ui-ellipsis">{{d.tj_num}}人</p>
                        </div>
                    </a>
                </div>
            </li>
            <li class="mui-col-xs-4 mui-col-sm-4">
                <div class="mui-table-view-cell">
                    <a href="#upgrade"><i class="icon icon-dengji"></i>
                        <div class="mui-media-body">
                            会员等级<p class="ui-ellipsis">{{d.rank_name}}</p>
                        </div>
                    </a>
                </div>
            </li>

            <li class="mui-col-xs-4 mui-col-sm-4">
                <div class="mui-table-view-cell">
                    <a href="#azfig" data-type="2"><i class="icon icon-tuandui"></i>
                        <div class="mui-media-body">
                            团队人数<p class="ui-ellipsis">{{d.team_num}}人</p>
                        </div>
                    </a>
                </div>
            </li>

        </ul>
        <div class="ui-list-title">基本管理</div>
        <ul class="mui-row mui-table-view mui-grid-view mui-grid-9">
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#upgrade">
                <span class="icon icon-sehngji ui-text-primary"></span>
                <div class="mui-media-body">会员升级</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3" v-if="d.user_can_bd"><a href="#userreg">
                <span class="icon icon-zhuce ui-text-success"></span>
                <div class="mui-media-body">申请会员</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#audit" data-info="0">
                <span class="icon icon-shenhe ui-text-danger"><span class="mui-badge">{{d.wait_member}}</span></span>
                <div class="mui-media-body">未审会员</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#audit" data-info="-10">
                <span class="icon icon-shenpi ui-text-warning"></span>
                <div class="mui-media-body">已审会员</div>
            </a></li>
        </ul>
        <div class="ui-list-title">团队操作</div>
        <ul class="mui-row mui-table-view mui-grid-view mui-grid-9">
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#azfig" data-type="1">
                <span class="icon icon-paixu ui-text-danger"></span>
                <div class="mui-media-body">安置图</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#azfig" data-type="2">
                <span class="icon icon-fenxiao ui-text-warning"></span>
                <div class="mui-media-body">推荐图</div>
            </a></li>
            <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3"><a href="#manager">
                <span class="icon icon-huangguan ui-text-primary"></span>
                <div class="mui-media-body">报单中心</div>
            </a></li>

        </ul>

    </div>
</div>
