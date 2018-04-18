<div class="mui-navbar-inner mui-bar mui-bar-nav">
    <button type="button" class="mui-left mui-action-back mui-btn mui-btn-link mui-btn-nav mui-pull-left">
        <span class="mui-icon mui-icon-left-nav"></span><!--返回-->
    </button>
    <h1 class="mui-center mui-title">收入数据</h1>
</div>
<div class="mui-page-content">

    <div id="slider-income" class="mui-slider">
        <div id="sliderSegmentedControl"
             class="mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
            <a class="mui-control-item mui-active"  href="#item1mobile">今日</a>
            <a class="mui-control-item"  href="#item2mobile">昨日</a>
            <a class="mui-control-item" href="#item3mobile">全部</a>
        </div>
        <!--<div id="sliderProgressBar" class="mui-slider-progress-bar mui-col-xs-4"></div>-->
        <div class="mui-slider-group income-slider-group">
            <div id="item1mobile" class="mui-slider-item mui-control-content mui-active" >
                <div id="scroll1" class="mui-scroll-wrapper">
                    <div class="mui-scroll">
                        <ul class="mui-table-view">
                            <li class="mui-table-view-cell ui-on-back" v-for="(key,name) in price">
                                {{name}}<span class="mui-pull-right ui-text-success">{{list[0][key]}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back" v-for="(key,name) in fee">
                                {{name}}<span class="mui-pull-right ui-text-success">-{{list[0][key]}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                合计<span class="mui-pull-right ui-text-danger">{{list[0]['money']}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="item2mobile" class="mui-slider-item mui-control-content">
                <div id="scroll2" class="mui-scroll-wrapper">
                    <div class="mui-scroll">
                        <ul class="mui-table-view">
                            <li class="mui-table-view-cell ui-on-back" v-for="(key,name) in price">
                                {{name}}<span class="mui-pull-right ui-text-success">{{list[1][key]}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back" v-for="(key,name) in fee">
                                {{name}}<span class="mui-pull-right ui-text-success">-{{list[1][key]}}</span>
                            </li>
                            <li class="mui-table-view-cell ui-on-back">
                                合计<span class="mui-pull-right ui-text-danger">{{list[1]['money']}}</span>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
            <div id="item3mobile" class="mui-slider-item mui-control-content">
                <div id="scroll3" class="mui-scroll-wrapper">
                    <div class="mui-scroll">
                        <li class="mui-table-view-cell ui-on-back" v-for="(key,name) in price">
                            {{name}}<span class="mui-pull-right ui-text-success">{{list[2][key]}}</span>
                        </li>
                        <li class="mui-table-view-cell ui-on-back" v-for="(key,name) in fee">
                            {{name}}<span class="mui-pull-right ui-text-success">-{{list[2][key]}}</span>
                        </li>
                        <li class="mui-table-view-cell ui-on-back">
                            合计<span class="mui-pull-right ui-text-danger">{{list[2]['money']}}</span>
                        </li>
                    </div>
                </div>

            </div>
        </div>
    </div>


</div>