<div class="mui-scroll-wrapper" style="padding-bottom:30px;">
    <div class="mui-scroll">
        <ul class="mui-table-view ui-home-info">
            <li class="mui-table-view-cell mui-media">
                <a class="mui-navigate-right" href="#user_view">
                    <img class="mui-media-object mui-pull-left" src="<?php echo URL_ROOT.'../DS/Wap/Mobi/'; ?>images/object.png">
                    <div class="mui-media-body">
                        {{d.true_name}}<span class="ui-grade">{{d.rank_name}}</span>
                        <p class="mui-ellipsis">编号：{{d.user_name}}</p>
                    </div>
                </a>
            </li>
        </ul>
        <ul class="mui-table-view">
            <li class="mui-table-view-cell"><a href="#shipping" class="mui-navigate-right">收货信息</a></li>
            <li class="mui-table-view-cell"><a href="#pwdedit" data-type="1" class="mui-navigate-right">登陆密码</a></li>
            <li class="mui-table-view-cell"><a href="#pwdedit" data-type="2" class="mui-navigate-right">安全密码</a></li>
        </ul>
        <ul class="mui-table-view">

            <li class="mui-table-view-cell"><a href="#orders" class="mui-navigate-right">我的订单</a></li>

        </ul>
        <ul class="mui-table-view">

            <li class="mui-table-view-cell"><a href="#announces" class="mui-navigate-right">新闻公告</a>
            </li>
            <li class="mui-table-view-cell"><a href="#mailbox" class="mui-navigate-right">留言信息</a></li>
        </ul>

        <ul class="mui-table-view">
            <li class="mui-table-view-cell">
                <a  id='confirmBtn' @tap="logout"  style="text-align: center;color: #FF3B30;">退出登录</a>
            </li>
        </ul>
    </div>
</div>