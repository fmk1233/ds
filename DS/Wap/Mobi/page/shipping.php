<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <a href="#shippingedit" class="mui-action-back mui-btn mui-btn-link mui-pull-right" :data-info="JSON.stringify(d)">编辑</a>
    <h1 class="mui-center mui-title">收货信息</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="ui-list-title">收货信息</div>
            <ul class="mui-table-view">
                <li class="mui-table-view-cell ui-on-back">
                    收货人<span class="mui-pull-right">{{d.realname}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    收货地址<span class="mui-pull-right">{{address(d)}}</span>
                </li>

                <li class="mui-table-view-cell ui-on-back">
                    详细地址<span class="mui-pull-right">{{d.address}}</span>
                </li>
                <li class="mui-table-view-cell ui-on-back">
                    手机号码<span class="mui-pull-right">{{d.mobile}}</span>
                </li>
            </ul>
        </div>
    </div>
</div>