<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">{{title}}</h1>
</div>
<div class="mui-page-content">
    <div class="mui-scroll-wrapper">
        <div class="mui-scroll">
            <div class="ui-search">
                <div class="mui-input-row mui-search mui-row">
                    <div class="mui-col-xs-9"><input type="text"  id="search" class="mui-input-clear" placeholder="请输入会员编号"></div>
                    <div class="mui-col-xs-3" ><button type="button" @click="search" style="width: auto;" class="mui-btn mui-btn-primary ui-btn-block">搜索</button></div>
                </div>
            </div>
            <!--网络图-->
            <div class="ui-list-title">{{memo}}</div>
            <div class="ui-list-title">本网络图仅显示3层</div>
            <ul class="team-level" style="overflow: hidden">
                <li style="background: #8b8484;"  >未激活</li>
                <li :style="'background:'+d.rank_colors[parseInt(key)+1]" v-for="(rank ,key) in d.rank_names">{{rank}}</li>
            </ul>
            <div class="team-chart">
                <ul style="margin:0px;padding:0px;">
                    <li class="team-li">
                    </li>
                </ul>

            </div>


        </div>
    </div>
</div>